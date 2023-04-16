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

  public function background_approve($token)
  {
    $data = array(
      'python_exec_request' => 1,
      'approved' => 5,
      'python_exec_request_time' => date('Y-m-d H:i:s', time() + rand(5, 45))
    );

    $this->db->where('token', $token);
    $this->db->update('data_queue_sign', $data);
    if ($this->db->affected_rows() > 0) {
      return 'Success';
    } else {
      return 'Error';
    }
  }



  public function get_queue_sign($token)
  {
    $this->db->select('*');
    $this->db->from('data_queue_sign');
    $this->db->where('token', $token);
    $query = $this->db->get();

    return $query->result();
  }

  public function get_queue_sign_by_users_id($users_id)
  {
    $this->db->select('*');
    $this->db->from('data_queue_sign');
    $this->db->where('users_id', $users_id);
    $this->db->group_start();
    $this->db->where('request_status', 2);
    $this->db->or_where('request_status', 1);
    // $this->db->or_where('request_status', 1);
    $this->db->group_end();
    $this->db->group_start();
    $this->db->where('approved', null);
    $this->db->or_where('approved', 0);
    $this->db->group_end();
    $this->db->order_by('request_at', 'ASC');
    $query = $this->db->get();

    return $query->result();
  }

  public function get_queue_sign_by_users_id_stag($users_id)
  {
    $this->db->select('*');
    $this->db->from('data_queue_sign');
    $this->db->where('users_id', $users_id);
    $this->db->group_start();
    $this->db->where('request_status', 0);
    // $this->db->or_where('request_status', 1);
    $this->db->group_end();
    $this->db->group_start();
    $this->db->where('approved', null);
    $this->db->or_where('approved', 0);
    $this->db->group_end();
    $this->db->order_by('request_at', 'ASC');
    $query = $this->db->get();

    return $query->result();
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
