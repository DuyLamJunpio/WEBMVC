<?php
class Controller{
    function model($model){
        require_once "./Models/".$model.".php";
        return new $model;
    }
    function view($view,$data=array()){
        require_once  "./Views/".$view.".php";
    }
}