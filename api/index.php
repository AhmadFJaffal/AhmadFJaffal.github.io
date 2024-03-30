<?php 
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$email = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
}

// If the URI does not have the necessary segments, return a 404 response.
if (!isset($uri[3]) || !isset($uri[4])) {
    
    header("HTTP/1.1 404 Not Found");
    exit();
}

$controllerName = ucfirst($uri[3]) . "Controller"; // Convert 'user' to 'UserController' or 'intern' to 'InternController'
$methodName = $uri[4] . 'Action';  // e.g. loginAction or addAction

// Ensure the controller file exists
if (!file_exists(PROJECT_ROOT_PATH . "/controller/" . $controllerName . ".php")) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . "/controller/" . $controllerName . ".php";

$controllerObj = new $controllerName();

// Check if the method exists in the controller
if (!method_exists($controllerObj, $methodName)) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$response = $controllerObj->{$methodName}($email, $password);
echo json_encode($response);



?>