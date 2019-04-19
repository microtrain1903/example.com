<?php
require '../../core/bootstrap.php';
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

$adminLinks=null;
if(!empty($_SESSION['user']['id'])){
$adminLinks=<<<EOT
<hr>
<div>
    <a class="btn btn-primary" href="/posts/add.php">
        <i class="fa fa-plus" aria-hidden="true"></i>
        Add
    </a>
</div>
EOT;
}
$content=<<<EOT
<h1>My Blog</h1>
<div class=\"list-group\">{$items}</div>
{$adminLinks}
EOT;

require '../../core/layout.php';
