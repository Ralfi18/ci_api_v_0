<?php
class User_model extends CI_Model {

  public function __construct()
  {
    // parent::__construct();
    // $this->load->database();
  }

  public function getUser($username = null, $password = null)
  {
    if (!$username && !$password || (!$username || !$password)) {
      return false;
    }
    $query = $query = $this->db->get_where('users', [
      'username' => $username,
      'password' => md5($password),
    ]);
    return $query->row();
  }

  public function setToken($id = null, $token = null)
  {
    $this->db->set('token', $token);
    $this->db->set('isAuth', true);
    $this->db->where('id', $id);
    $this->db->update('users');

    $this->db->select('id, username, token, isAuth');
    $query = $this->db->get_where('users', [
      'id' => $id,
    ]);
    return $query->row();
  }
}
