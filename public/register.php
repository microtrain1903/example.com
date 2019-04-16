<?php
require '../core/session.php';
require '../core/db_connect.php';

$input = filter_input_array(INPUT_POST,[
    'first_name'=>FILTER_SANITIZE_STRING,
    'last_name'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL,
    'password'=>FILTER_UNSAFE_RAW
]);

if(!empty($input)){

    $hash = password_hash($input['password'], PASSWORD_DEFAULT); 

    $sql='INSERT INTO 
        users 
    SET 
        id=UUID(),
        email=:email,
        first_name=:first_name,
        last_name=:last_name,
        hash=:hash
    ';

    $stmt=$pdo->prepare($sql);
    if($stmt->execute([
        'email'=>$input['email'],
        'first_name'=>$input['first_name'],
        'last_name'=>$input['last_name'],
        'hash'=>$hash
    ])){
        header('LOCATION: /login.php');
    }
    
}
$meta=[];
$meta['title']="Register";

$content=<<<EOT
<h1>{$meta['title']}</h1>
<form method="post">

    <div class="form-group">
        <label for="email">Email</label>
        <input 
            class="form-control" 
            id="email" 
            name="email" 
            type="email"
        >
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input 
            class="form-control" 
            id="first_name" 
            name="first_name" 
        >
    </div>


    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input 
            class="form-control" 
            id="last_name" 
            name="last_name" 
        >
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input 
            class="form-control" 
            id="password" 
            name="password" 
            type="password"
        >
    </div>

    <input type="submit" class="btn btn-primary">

</form>
EOT;

require '../core/layout.php';


