<?php
  class Pages extends Controller {
    public function __construct(){

    }
    
    public function index(){

      $data = [
        'title' => 'Welcom'
      ];

      
      $this->view('pages/index',$data);
    }

    public function about(){
      $data = [
        'title' => 'About Us'
      ];

      $this->view('pages/about',$data);
    }

    public function login(){
      $data = [
        'title' => 'login'
      ];

      $this->view('pages/login',$data);
    }

    public function register(){
      $data = [
        'title' => 'register'
      ];

      $this->view('pages/register',$data);
    }

    public function authorD(){
      $data = [
        'title' => 'authorD'
      ];

      $this->view('pages/authorD',$data);
    }

    public function adminD(){
      $data = [
        'title' => 'adminD'
      ];

      $this->view('pages/adminD',$data);
    }
    
  }