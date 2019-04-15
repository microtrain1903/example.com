<?php
require '../../core/db_connect.php';

$stmt = $pdo->query("SELECT * FROM posts");

$meta=[];
$meta['title']="My Blog";

$items=null;

while($row = $stmt->fetch()){
    $items.=
        "<a href=\"view.php?slug={$row['slug']}\" class=\"list-group-item\">".
        "{$row['title']}</a>";
}

$content=<<<EOT
<h1>My Blog</h1>
<div class=\"list-group\">{$items}</div>
<hr>
<div>
    <a class="btn btn-primary" href="/posts/add.php">
        <i class="fa fa-plus" aria-hidden="true"></i>
        Add
    </a>
</div>
EOT;

require '../../core/layout.php';
