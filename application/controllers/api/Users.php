<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Content-Type: application/json; charset=UTF-8");
  }

  public function index()
  {
  	$post = json_decode(file_get_contents('php://input'));
  	$username = $post->username;
  	$password = $post->password;
  	$token = md5(uniqid($password, true));
  	$dbUsers = $this->user_model->getUser($username, $password);
  	$data = $this->user_model->setToken($dbUsers->id, $token);
  	if ($data) {
  		print_r(json_encode($data));
  	} else {
  		header('HTTP/1.0 403 Forbidden');
  	}

  }

  public function insertUser(){
    $post = json_decode(file_get_contents('php://input'));
    $title = $post->title;
    if ($title) {
      $data = array(
        'title' =>  $title,
        'author' => 'Rali Dimitrov',
        'price' => '10'
      );
      $this->book->addBook($data);
    }
    print_r($title);
  }
}
