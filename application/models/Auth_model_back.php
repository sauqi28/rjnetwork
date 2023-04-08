<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{

  public function check_user($username, $password)
  {
    $this->db->group_start();
    $this->db->where('username', $username);
    $this->db->or_where('nip', $username);
    $this->db->or_where('email', $username);
    $this->db->group_end();
    $user = $this->db->get('tb_users')->row_array();

    if ($user) {
      return password_verify($password, $user['password']);
    } else {
      return false;
    }
  }

  public function register_user($username, $password)
  {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $data = array(
      'username' => $username,
      'password' => $hashed_password
    );
    $this->db->insert('users', $data);
  }
}
