<?php
include '../../core/db_connect.php';

$args = [
    'id'=>FILTER_SANITIZE_STRING
];
$input = filter_input_array(INPUT_GET, $args);


$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(['id'=>$input['id']]);

$row = $stmt->fetch();

$meta=[];
$meta['title']="{$row['first_name']} {$row['last_name']}";

$content=<<<EOT
<h1>{$meta['title']}</h1>
{$row['email']}

<hr>
<div>
    <a class="btn btn-primary" href="/users/edit.php?id={$row['id']}">
        <i class="fa fa-pencil" aria-hidden="true"></i> Edit
    </a>
</div>
EOT;



require '../../core/layout.php';



