<?php
class Admin extends Controller{
    function getShow(){
        $this->view("Manager_View",["page"=>"Admin"]);
    }
}