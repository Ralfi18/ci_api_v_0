<?php
class Book extends CI_Model {

  public function __construct()
  {
    // parent::__construct();
    // $this->load->database();
  }

  public function getBooks()
  {
    $query = $this->db->get('books');
    return $query->result();
  }

  public function addBook($data)
  {
    return $this->db->insert('books', $data);
  }
}
