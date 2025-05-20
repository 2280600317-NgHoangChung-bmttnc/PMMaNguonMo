<?php
// Hiển thị lỗi để debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL (chỉ cần thiết nếu bạn dùng trong index, nếu không có thể bỏ)
require_once 'app/config/database.php';

// Lấy thông tin route từ URL
if (isset($_GET['url'])) {
    $url = explode('/', trim($_GET['url'], '/'));
    $controller = !empty($url[0]) ? ucfirst($url[0]) : 'Product';
    $action = isset($url[1]) ? $url[1] : 'index';
    $id = isset($url[2]) ? $url[2] : null;
} else {
    $controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Product';
    $action = $_GET['action'] ?? 'index';
    $id = $_GET['id'] ?? null;
}

// Đường dẫn đến controller
$controllerFile = "app/controllers/{$controller}Controller.php";

// Kiểm tra tồn tại controller
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerName = $controller . 'Controller';

    if (class_exists($controllerName)) {
        $controllerObject = new $controllerName();

        if (method_exists($controllerObject, $action)) {
            if ($id !== null) {
                $controllerObject->$action($id);
            } else {
                $controllerObject->$action();
            }
        } else {
            echo "Không tìm thấy phương thức '$action' trong controller '$controllerName'.";
        }
    } else {
        echo "Không tìm thấy class '$controllerName'.";
    }
} else {
    echo "Không tìm thấy file controller: $controllerFile";
}