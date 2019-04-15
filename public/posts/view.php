<?php
include '../../core/db_connect.php';

$args = [
    'slug'=>FILTER_SANITIZE_STRING
];
$input = filter_input_array(INPUT_GET, $args);
$slug = preg_replace("/[^a-z0-9-]+/", "", $input['slug']);


$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = ?');
$stmt->execute([$slug]);

$row = $stmt->fetch();

$content=<<<EOT
<h1>{$row['title']}</h1>
{$row['body']}

<hr>
<div>
    <a href="/posts/edit.php?id={$row['id']}">Edit</a>
</div>
EOT;



require '../../core/layout.php';



