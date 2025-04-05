<?php  
require 'config/database.php';
require 'controllers/LoginController.php';

$loginController = new LoginController($db);

$loginController->logout();