<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digital_sign_model extends CI_Model
{



  public function get_data_by_token($token)
  {
    $this->db->select('a.id as id_sign, a.users_id, c.form_id, a.approved, a.approved_time, a.sequence, a.generate_at, a.request_at, a.token, a.form_name, a.x_sign, a.y_sign, a.request_status, a.title, a.desc, a.keterangan, b.fullname, b.no_wa, b.status, b.signature, c.form_id, c.key_reference, c.count_sign, c.current_count_sign, c.status as status_process, c.finished, c.finished_time, d.spk_number, d.pabrikan, d.material, DATE_FORMAT(d.tgl_penerimaan, "%e %M %Y") AS tgl_penerimaan_formatted, d.folder_name, d.tug4_unsigned_file, d.tug3_unsigned_file, d.tug3_karantina_unsigned_file');
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
  public function update_current_count_sign($token)
  {
    // Mengambil id_process_reference berdasarkan token
    $this->db->select('id_process_reference');
    $this->db->where('token', $token);
    $query = $this->db->get('data_queue_sign');

    if ($query->num_rows() > 0) {
      $id_process_reference = $query->row()->id_process_reference;

      // Menghitung jumlah kolom approval berdasarkan id_process_reference
      $this->db->select_sum('approved');
      $this->db->where('id_process_reference', $id_process_reference);
      $query = $this->db->get('data_queue_sign');
      $approval_sum = $query->row()->approved;

      // Update kolom current_count_sign pada tabel data_process_sign
      $this->db->where('id_process', $id_process_reference);
      $this->db->update('data_process_sign', array('current_count_sign' => $approval_sum));

      return $approval_sum;
    } else {
      return FALSE;
    }
  }

  public function send_manager($token)
  {
    $this->db->select('id_process_reference');
    $this->db->where('token', $token);
    $query = $this->db->get('data_queue_sign');

    if ($query->num_rows() > 0) {
      $id_process_reference = $query->row()->id_process_reference;

      $data = array(
        'request_status' => 1
      );

      $this->db->where('id_process_reference', $id_process_reference);
      $this->db->where('request_status', 0); // Tambahkan kondisi WHERE request_status = 0
      $this->db->where('sequence', 8);
      $this->db->update('data_queue_sign', $data);
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

  function approve_signature($id_sign, $token)
  {
    // Mendapatkan waktu saat ini
    $approved_time = date('Y-m-d H:i:s');

    // Mengubah nilai kolom approved menjadi 1 dan approved_time menjadi waktu saat ini
    $this->db->set('approved', 1);
    $this->db->set('approved_time', $approved_time);
    $this->db->where('id', $id_sign);
    $this->db->where('token', $token);
    $this->db->update('data_queue_sign');

    // Mengembalikan pesan 'Success' jika update berhasil atau 'Error' jika gagal
    if ($this->db->affected_rows() > 0) {
      return 'Success';
    } else {
      return 'Error';
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
