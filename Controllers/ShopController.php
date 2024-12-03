<?php

class ShopController extends Controller
{

    public function index()
    {
        $obj2 = $this->model("AdProductModel");
        $products = $obj2->getshow();
        $this->view("LayoutHome",["User"=>"Shop/ShopView", "products" => $products]);
    }

    public function cart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }
        $obj = $this->model("CartModel");
        $cartData = $obj->getDataCart($user_id);
        $this->view("LayoutHome",["User"=>"Shop/CartView" , "cartData" => $cartData]);
    }

    public function detailProduct($masp)
    {
        $obj = $this->model("AdProductModel");
        $detail_product = $obj->getProductByID($masp);
        $this->view("LayoutHome",["User"=>"Shop/DetailProductView", "detail_product" => $detail_product]);
    }

    public function addProductToCart($masp)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }

        $so_luong = isset($_POST["so_luong"]) ? $_POST["so_luong"] : 1;
        $obj = $this->model("CartModel");
        
        $product = $obj->checkProductInCart($masp);
        
        if ($product) {
            $so_luong_moi = $product['so_luong'] + $so_luong;
            $obj->updateCart($product['id'], $so_luong_moi);
            $_SESSION['messageType'] = 'Thêm vào giỏ hàng thành công.';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $obj->insertCart($masp, $user_id, $so_luong);
            $_SESSION['messageType'] = 'Thêm vào giỏ hàng thành công.';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    public function delete($id)
    {
        $obj = $this->model("CartModel");
        $obj->deleteAdInCart($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}