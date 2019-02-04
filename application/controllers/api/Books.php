<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Content-Type: application/json; charset=UTF-8");
  }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
  public function index()
  {
    // Display all books
    if ($this->book->getBooks() && count($this->book->getBooks()) > 0 ) {
      $books = $this->book->getBooks();
      // echo(json_encode($books, JSON_UNESCAPED_UNICODE));
      echo(json_encode($books));
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
