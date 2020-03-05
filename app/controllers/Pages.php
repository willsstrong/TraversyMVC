<?php

class Pages extends Controller{
  public function __construct(){
    $this->postModel = $this->model('Post');
  }

  public function index(){
    $data = [
      'title'=>'My Home Page'
    ];
    $this->view('pages/index', $data);
  }
  public function about(){
    $data = [
      'title'=>'About this Page'
    ];
    $this->view('pages/about', $data);
  }
}