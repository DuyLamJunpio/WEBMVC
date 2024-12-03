<?php
class App
{
    protected $controller = 'HomeController'; // Controller mặc định
    protected $action = 'index';              // Action mặc định
    protected $param = [];                    // Tham số mặc định

    function __construct()
    {
        // Kiểm tra nếu có tham số "url"
        if (isset($_GET["url"])) {
            $arr = $this->urlprocess();

            // Xác định controller
            if (file_exists("./Controllers/" . $arr[0] . ".php")) {
                $this->controller = $arr[0];
            }
            require_once "./Controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller();
            unset($arr[0]);

            // Xác định action
            if (isset($arr[1])) {
                if (method_exists($this->controller, $arr[1])) {
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }

            // Lấy các tham số còn lại
            $this->param = $arr ? array_values($arr) : [];
        } else {
            // Không có tham số "url", gọi controller và action mặc định
            require_once "./Controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller();
        }

        // Gọi controller và action
        call_user_func_array([$this->controller, $this->action], $this->param);
    }

    function urlprocess()
    {
        $url = explode("/", filter_var(trim($_GET["url"], "/"), FILTER_SANITIZE_URL));
        // Hiển thị URL để kiểm tra
        // echo "Processed URL: ";
        // print_r($url);
        return $url;
    }
}
