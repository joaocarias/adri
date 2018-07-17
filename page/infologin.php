<?php
session_start();
session_destroy();
session_start();

include_once '../app/view/InfoLoginView.php';

$view = new InfoLoginView();
echo $view->get();


