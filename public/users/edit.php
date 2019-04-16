<?php
require '../../core/session.php';
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';
require '../../core/About/src/Validation/Validate.php';

checkSession();

use About\Validation;

$valid = new About\Validation\Validate();

$message=null;

$args = [
    'id'=>FILTER_SANITIZE_STRING, //strips HMTL
    'email'=>FILTER_SANITIZE_EMAIL,
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'last_name'=>FILTER_SANITIZE_STRING, //strips HMTL
];

$input = filter_input_array(INPUT_POST, $args);

//1. First validate

if(!empty($input)){

    $valid->validation = [

        'email'=>[[
            'rule'=>'email',
            'message'=>'Please enter a valid email'
        ],[
            'rule'=>'notEmpty',
            'message'=>'Please enter a email'
        ]],

        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a first name'
        ]],

        'last_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a last name'
        ]]

    ];

    $valid->check($input);

    if(empty($valid->errors)){

        $input = array_map('trim', $input);
        $sql = 'UPDATE users SET email=:email, first_name=:first_name, last_name=:last_name WHERE id=:id';

        if($pdo->prepare($sql)->execute([
            'id'=>$input['id'],
            'email'=>$input['email'],
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name']
        ])){
            header('LOCATION:/users');
        }else{
            $message = 'Something bad happened';
        }

    }else{

        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";

    }

}


$args = [
    'id'=>FILTER_SANITIZE_STRING
];

$params = filter_input_array(INPUT_GET, $args);
$sql = 'SELECT * FROM users WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->execute([

    'id'=>$params['id']

]);

$row = $stmt->fetch();

$fields=[];
$fields['id']=$row['id'];
$fields['email']=$row['email'];
$fields['first_name']=$row['first_name'];
$fields['last_name']=$row['last_name'];

if(!empty($input)){
    $fields['email']=$valid->userInput('email');
    $fields['first_name']=$valid->userInput('first_name');
    $fields['last_name']=$valid->userInput('last_name');
}


$meta=[];
$meta['title']="Edit: {$fields['email']}";

$content = <<<EOT

<h1>{$meta['title']}</h1>
{$message}
<form method="post">
    <input name="id" type="hidden" value="{$fields['id']}">
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="text" class="form-control" value="{$fields['email']}">
        <div class="text-danger">{$valid->error('email')}</div>
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input id="first_name" name="first_name" type="text" class="form-control" value="{$fields['first_name']}">
        <div class="text-danger">{$valid->error('first_name')}</div>
    </div>


    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input id="last_name" name="last_name" type="text" class="form-control" value="{$fields['last_name']}">
        <div class="text-danger">{$valid->error('last_name')}</div>
    </div>

    <div class="form-group">
        <input type="submit" value="Submit" class="btn btn-primary">
    </div>

</form>

<hr>

<div>
    <a
        class="text.danger"
        onclick="return confirm('Are you sure?')"
        href="/users/delete.php?id={$fields['id']}">
        Delete
    </a>
</div>

EOT;

include '../../core/layout.php';