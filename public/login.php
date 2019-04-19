<?php
require '../bootstrap.php';
require '../core/db_connect.php';

$input = filter_input_array(INPUT_POST,[
    'email'=>FILTER_SANITIZE_EMAIL,
    'password'=>FILTER_UNSAFE_RAW
]);

if(!empty($input)){

    $input = array_map('trim', $input);
    $sql='SELECT id, hash FROM users WHERE email=:email';

    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'email'=>$input['email']
    ]);

    $row=$stmt->fetch();

    if($row){
        $match = password_verify($input['password'], $row['hash']);
        if($match){
            $_SESSION['user'] = [];
            $_SESSION['user']['id']=$row['id'];
            header('LOCATION: ' . $_POST['goto']);
        }
    }
}




$meta=[];
$meta['title']="Login";
$goto=!empty($_GET['goto'])?$_GET['goto']:'/';

$content=<<<EOT
<h1>{$meta['title']}</h1>
<form method="post" autocomplete="off">

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
        <label for="password">Password</label>
        <input 
            class="form-control" 
            id="password" 
            name="password" 
            type="password"
        >
    </div>

    <input name="goto" value="{$goto}" type="hidden">
    <input type="submit" class="btn btn-primary">
</form>
EOT;

require '../core/layout.php';


