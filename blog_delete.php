<?php

require_once './blog.php';


$blog = new Blog();
$blog->delete($_GET['id']);
