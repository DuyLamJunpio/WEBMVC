<?php

class HomeController extends Controller
{

    public function index()
    {
        $this->view("LayoutHome",["User"=>"Home/HomeView"]);
    }
}