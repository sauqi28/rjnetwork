<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Public_model extends CI_Model
{



  public function get_data_by_token($token)
  {
    $this->db->select('*');
    $this->db->from('mst_users');
    $this->db->where('wa_token', $token);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  public function get_data_signature_by_token($token)
  {
    $this->db->select('*');
    $this->db->from('mst_users');
    $this->db->where('signature_token', $token);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  public function verify_user($user_id)
  {
    $this->load->library('encryption');
    $token = bin2hex($this->encryption->create_key(25));
    $data = array(
      'verified_wa' => 1,
      'verified_at' => date('Y-m-d H:i:s'),
      'wa_token' => $token
    );
    $this->db->where('id', $user_id);
    $this->db->update('mst_users', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function save_user_signature($user_id, $filename)
  {
    $this->load->library('encryption');
    $token = bin2hex($this->encryption->create_key(50));
    $data = array(
      'signature' => $filename,
      'signature_token' => $token
    );
    $this->db->where('id', $user_id);
    $this->db->update('mst_users', $data);
  }
}
