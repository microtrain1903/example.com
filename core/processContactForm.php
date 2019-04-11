<?php
require '../core/About/src/Validation/Validate.php';
//Declare namespaces
use About\Validation;

$valid = new About\Validation\Validate();

$args = [
  'name'=>FILTER_SANITIZE_STRING,
  'subject'=>FILTER_SANITIZE_STRING,
  'message'=>FILTER_SANITIZE_STRING,
  'email'=>FILTER_SANITIZE_EMAIL,
];

$input = filter_input_array(INPUT_POST, $args);

$message=null;
if(!empty($input)){

    $valid->validation = [
        'email'=>[[
                'rule'=>'email',
                'message'=>'Please enter a valid email'
            ],[
                'rule'=>'notEmpty',
                'message'=>'Please enter an email'
        ]],
        'name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter your first name'
        ]],
        'message'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please add a message'
        ]],
    ];

    $valid->check($input);

    if(empty($valid->errors)){
        require '../core/mailgun.php';
        $message = "<div class=\"alert alert-success\">Your form has been submitted!</div>";
        //header('Location: thanks.php');
    }else{
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }
}