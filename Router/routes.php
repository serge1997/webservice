<?php
$router->get('/', 'app/Controllers/index.php');
$router->get('/dashboard', 'app/Controllers/dashboard.php');
$router->post('/dashboard', 'app/Controllers/dashboard.php');