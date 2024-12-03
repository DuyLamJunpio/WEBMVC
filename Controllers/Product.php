<?php
class Product extends Controller {
    public function getShow(){
        $obj = $this->model("AdProductModel");
        $data=$obj -> getProduct();
        $this -> view("Home_View",["page"=>"ProductListView"]);
    }
}