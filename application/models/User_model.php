<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

  public function create_user($data)
  {
    return $this->db->insert('mst_users', $data);
  }

  // public function get_user_by_email($email)
  // {
  //   $this->db->where('email', $email);
  //   $query = $this->db->get('users');
  //   return $query->row();
  // }
  public function check_user($username)
  {
    $this->db->select('a.id, a.username, a.category, a.fullname, a.email, a.password, b.id as position_id, b.position_name, c.id as role_id, c.role_name, a.status');
    $this->db->from('mst_users a');
    $this->db->join('mst_user_position b', 'a.position = b.id', 'left');
    $this->db->join('mst_user_role c', 'a.role = c.id', 'left');
    $this->db->group_start();
    $this->db->where('a.username', $username);
    $this->db->or_where('a.nip', $username);
    $this->db->or_where('a.email', $username);
    $this->db->group_end();
    $this->db->limit(1);
    $user = $this->db->get()->row();
    return $user;
  }
}
