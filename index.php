<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Lấy controller và action từ GET, với giá trị mặc định
$controller = isset($_GET['controller']) 
    ? ucfirst(preg_replace('/[^a-zA-Z]/', '', $_GET['controller'])) 
    : 'Default';
$action = isset($_GET['action']) 
    ? preg_replace('/[^a-zA-Z]/', '', $_GET['action']) 
    : 'index';

// Đường dẫn đến file controller
$controllerFile = "app/controllers/" . $controller . "Controller.php";

// Kiểm tra file controller tồn tại
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = $controller . "Controller";
    if (class_exists($className)) {
        $controllerObj = new $className();
        if (method_exists($controllerObj, $action)) {
            // Lấy các tham số còn lại trong GET
            $params = array_diff_key($_GET, array_flip(['controller', 'action']));
            $reflection = new ReflectionMethod($controllerObj, $action);
            $requiredParams = $reflection->getNumberOfRequiredParameters();
            if ($requiredParams > 0) {
                $args = [];
                foreach ($reflection->getParameters() as $param) {
                    $paramName = $param->getName();
                    if (isset($params[$paramName])) {
                        $args[] = $params[$paramName];
                    } elseif ($param->isOptional()) {
                        $args[] = $param->getDefaultValue();
                    } else {
                        http_response_code(400);
                        echo "400 - Bad Request: Thiếu tham số `$paramName`.";
                        exit;
                    }
                }
                call_user_func_array([$controllerObj, $action], $args);
            } else {
                $controllerObj->$action();
            }
        } else {
            http_response_code(404);
            echo "404 - Page not found: Action không tồn tại.";
        }
    } else {
        http_response_code(500);
        echo "500 - Server Error: Controller class không tồn tại.";
    }
} else {
    http_response_code(404);
    echo "404 - Page not found: Controller không tồn tại.";
}
?>
