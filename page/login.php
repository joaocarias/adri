<?php
session_start();
session_destroy();
session_start();

include_once '../app/view/LoginView.php';

$view = new LoginView();
echo $view->get();


