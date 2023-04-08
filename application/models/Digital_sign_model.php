<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digital_sign_model extends CI_Model
{



  public function get_data_by_token($token)
  {
    $this->db->select('a.id as id_sign, a.users_id, a.sequence, a.generate_at, a.request_at, a.token, a.form_name, a.x_sign, a.y_sign, a.request_status, a.title, a.desc, a.keterangan, b.fullname, b.no_wa, b.status, b.signature, c.form_id, c.key_reference, c.count_sign, c.current_count_sign, c.status as status_process, c.finished, c.finished_time, d.spk_number, d.pabrikan, d.material, DATE_FORMAT(d.tgl_penerimaan, "%e %M %Y") AS tgl_penerimaan_formatted, d.folder_name, d.tug4_unsigned_file, d.tug3_unsigned_file, d.tug3_karantina_unsigned_file');
    $this->db->from('data_queue_sign a');
    $this->db->join('mst_users b', 'a.users_id = b.id');
    $this->db->join('data_process_sign c', 'a.id_process_reference = c.id_process AND a.form_name = c.form_name');
    $this->db->join('data_penerimaan_marketplace d', 'c.key_reference = d.key');
    $this->db->where('a.token', $token);

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
