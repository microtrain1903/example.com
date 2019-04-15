<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

use About\Validation;

$valid = new About\Validation\Validate();

$message=null;

$args = [
    'title'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_description'=>FILTER_SANITIZE_STRING, //strips HMTL
    'meta_keywords'=>FILTER_SANITIZE_STRING, //strips HMTL
    'body'=>FILTER_UNSAFE_RAW  //NULL FILTER
];

$input = filter_input_array(INPUT_POST, $args);

//1. First validate
if(!empty($input)){

    $valid->validation = [
        'title'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a title'
        ]]
    ];

    $valid->check($input);

    if(empty($valid->errors)){
        //2. Only process if we pass validation

        //Strip white space, begining and end
        $input = array_map('trim', $input);
    
        //Allow only whitelisted HTML
        $input['body'] = cleanHTML($input['body']);
    
        //Create the slug
        $slug = slug($input['title']);
    
        //Sanitiezed insert
        $sql = 'INSERT INTO posts SET id=uuid(), title=:title, slug=:slug, body=:body';
    
        if($pdo->prepare($sql)->execute([
            'title'=>$input['title'],
            'slug'=>$slug,
            'body'=>$input['body']
        ])){
            header('LOCATION:/posts');
        }else{
            $message = 'Something bad happened';
        }

    }else{
        //3. If validation fails create a message, DO NOT forget to add the validation 
        //methods to the form.
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }
}

$meta=[];
$meta['title']='Add a new post';


$content = <<<EOT
<h1>Add a New Post</h1>
{$message}
<form method="post">

<div class="form-group">
    <label for="title">Title</label>
    <input id="title" name="title" type="text" class="form-control" value="{$valid->userInput('title')}">
    <div class="text-danger">{$valid->error('title')}</div>
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea id="body" name="body" rows="8" class="form-control">{$valid->userInput('body')}</textarea>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label for="meta_description">Description</label>
        <textarea id="meta_description" name="meta_description" rows="2" class="form-control">{$valid->userInput('meta_description')}</textarea>
    </div>

    <div class="form-group col-md-6">
        <label for="meta_keywords">Keywords</label>
        <textarea id="meta_keywords" name="meta_keywords" rows="2" class="form-control">{$valid->userInput('meta_keywords')}</textarea>
    </div>
</div>

<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';