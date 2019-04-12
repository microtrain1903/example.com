<?php
require '../../core/db_connect.php';

$stmt = $pdo->query("SELECT * FROM posts");

$meta=[];
$meta['title']="My Blog";

$content="<h1>My Blog</h1>";

while($row = $stmt->fetch()){
    $content.="<a href=\"view.php?slug={$row['slug']}\">"
        . "{$row['title']}</a>";
}

require '../../core/layout.php';
