<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan_marketplace_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
    $this->load->library('Wa_api');
  }

  public function get_penerimaan_marketplace_view($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('data_penerimaan_marketplace');
      return $query->result_array();
    }

    $this->db->select('a.*,b.fullname, 
                       DATE_FORMAT(a.tug3_unsigned_upload_time, "%d %M %Y | %H:%i:%s WIB") AS tug3_unsigned_upload_time_formatted, 
                       DATE_FORMAT(a.tug3_karantina_unsigned_upload_time, "%d %M %Y | %H:%i:%s WIB") AS tug3_karantina_unsigned_upload_time_formatted, 
                       DATE_FORMAT(a.tug4_unsigned_upload_time, "%d %M %Y | %H:%i:%s WIB") AS tug4_unsigned_upload_time_formatted, 
                       DATE_FORMAT(a.tug_unsigned_locked_update, "%d %M %Y | %H:%i:%s WIB") AS tug_unsigned_locked_update_formatted,');
    $this->db->from('data_penerimaan_marketplace a');
    $this->db->join('mst_users b', 'a.user_locked_update = b.id', 'left');
    $this->db->where('a.key', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }


  public function get_sign_data($key, $id_form)
  {
    $this->db->select('b.*, c.fullname, DATE_FORMAT(b.request_at, "%e %M %Y %H:%i:%s") as formatted_request_at, DATE_FORMAT(b.approved_time, "%e %M %Y %H:%i:%s") as formatted_approved_time');
    $this->db->from('data_process_sign a');
    $this->db->join('data_queue_sign b', 'a.id_process = b.id_process_reference', 'inner');
    $this->db->join('mst_users c', 'b.users_id = c.id', 'inner');
    $this->db->where('a.key_reference', $key);
    $this->db->where('a.form_id', $id_form);
    $this->db->order_by('b.sequence', 'ASC');

    $query = $this->db->get();
    return $query->result_array();
  }


  public function get_form_approval($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('data_penerimaan_marketplace');
      return $query->result_array();
    }

    $this->db->select('a.*, 
                       u1.fullname AS u_sign_1_fullname, 
                       u2.fullname AS u_sign_2_fullname, 
                       u3.fullname AS u_sign_3_fullname, 
                       u4.fullname AS u_sign_4_fullname, 
                       u5.fullname AS u_sign_5_fullname, 
                       u6.fullname AS u_sign_6_fullname, 
                       u7.fullname AS u_sign_7_fullname, 
                       u8.fullname AS u_sign_8_fullname, 
                       u9.fullname AS u_sign_9_fullname, 
                       u10.fullname AS u_sign_10_fullname');
    $this->db->from('mst_sign_positions a');
    $this->db->join('mst_users u1', 'a.u_sign_1 = u1.id', 'left');
    $this->db->join('mst_users u2', 'a.u_sign_2 = u2.id', 'left');
    $this->db->join('mst_users u3', 'a.u_sign_3 = u3.id', 'left');
    $this->db->join('mst_users u4', 'a.u_sign_4 = u4.id', 'left');
    $this->db->join('mst_users u5', 'a.u_sign_5 = u5.id', 'left');
    $this->db->join('mst_users u6', 'a.u_sign_6 = u6.id', 'left');
    $this->db->join('mst_users u7', 'a.u_sign_7 = u7.id', 'left');
    $this->db->join('mst_users u8', 'a.u_sign_8 = u8.id', 'left');
    $this->db->join('mst_users u9', 'a.u_sign_9 = u9.id', 'left');
    $this->db->join('mst_users u10', 'a.u_sign_10 = u10.id', 'left');
    $this->db->where('a.id', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }




  public function get_penerimaan_marketplace($limit, $start, $search = NULL)
  {
    $this->db->select('a.*, CONCAT(DATE_FORMAT(a.tgl_penerimaan, "%d"), " ", CASE MONTH(a.tgl_penerimaan) 
    WHEN 1 THEN "Januari" WHEN 2 THEN "Februari" WHEN 3 THEN "Maret" WHEN 4 THEN "April" WHEN 5 THEN "Mei" 
    WHEN 6 THEN "Juni" WHEN 7 THEN "Juli" WHEN 8 THEN "Agustus" WHEN 9 THEN "September" WHEN 10 THEN "Oktober" 
    WHEN 11 THEN "November" WHEN 12 THEN "Desember" END, " ", DATE_FORMAT(a.tgl_penerimaan, "%Y")) AS tgl_penerimaan_formatted', FALSE);
    $this->db->from('data_penerimaan_marketplace a');
    if ($search) {
      $this->db->group_start();
      $this->db->like('a.key', $search);
      $this->db->or_like('a.id', $search);
      $this->db->or_like('a.spk_number', $search);
      $this->db->or_like('a.pabrikan', $search);
      $this->db->or_like('a.material', $search);
      $this->db->or_where("DATE_FORMAT(a.tgl_penerimaan, '%M') LIKE '%{$search}%'");
      $this->db->group_end();
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    $result = $query->result_array();

    foreach ($result as &$row) {
      $row['tgl_penerimaan'] = $row['tgl_penerimaan_formatted'];
      unset($row['tgl_penerimaan_formatted']);
    }

    return $result;
  }


  public function get_pdf_file($filename, $type)
  {
    $this->db->select('folder_name');
    if ($type == 'tug4') {
      $this->db->select('tug4_unsigned_file');
    } elseif ($type == 'tug3k') {
      $this->db->select('tug3_karantina_unsigned_file');
    } elseif ($type == 'tug3') {
      $this->db->select('tug3_unsigned_file');
    }
    $this->db->from('data_penerimaan_marketplace');
    $this->db->where('key', $filename);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
      $result = $query->row_array();
      if ($type == 'tug4') {
        return $result['folder_name'] . '/' . $result['tug4_unsigned_file'];
      } elseif ($type == 'tug3k') {
        return $result['folder_name'] . '/' . $result['tug3_karantina_unsigned_file'];
      } elseif ($type == 'tug3') {
        return $result['folder_name'] . '/' . $result['tug3_unsigned_file'];
      }
    } else {
      return false;
    }
  }





  public function get_penerimaan_marketplace_count($search)
  {
    $this->db->select('a.*');
    $this->db->from('data_penerimaan_marketplace a');
    if ($search) {
      $this->db->like('a.key', $search);
      $this->db->or_like('a.id', $search);
      $this->db->or_like('a.spk_number', $search);
      $this->db->or_like('a.pabrikan', $search);
      $this->db->or_like('a.material', $search);
    }
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_penerimaan_marketplace_count_nonaktif($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_users a');
    $this->db->join('mst_user_position b', 'a.position = b.id', 'left');
    $this->db->join('mst_user_role c', 'a.role = c.id', 'left');
    $this->db->join('mst_user_category cat', 'a.category = cat.id', 'left');
    if ($search) {
      $this->db->like('a.fullname', $search);
      $this->db->or_like('a.email', $search);
      $this->db->or_like('a.username', $search);
      $this->db->or_like('a.nip', $search);
      $this->db->or_like('b.position_name', $search);
      $this->db->or_like('c.role_name', $search);
      $this->db->or_like('cat.category_name', $search);
    }
    $this->db->where('a.status', "inactive");
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function create_penerimaan()
  {
    $tgl_penerimaan = $this->input->post('tgl_penerimaan');
    $tgl_penerimaan_parts = explode('/', $tgl_penerimaan);
    $tgl_penerimaan_sql = $tgl_penerimaan_parts[2] . '-' . $tgl_penerimaan_parts[1] . '-' . $tgl_penerimaan_parts[0];
    // var_dump($tgl_penerimaan);
    // var_dump($tgl_penerimaan_sql);
    // exit(0);
    $data = array(
      'key' => uniqid(),
      'spk_number' => trim($this->input->post('spk_number')),
      'pabrikan' => trim($this->input->post('pabrikan')),
      'material' => $this->input->post('material'),
      'tgl_penerimaan' => $tgl_penerimaan_sql,
      'created_at' => date('Y-m-d H:i:s')
    );
    return $this->db->insert('data_penerimaan_marketplace', $data);
  }



  public function save_file_tug4($id, $filename, $folder_path)
  {

    $data = array(
      'tug4_unsigned_file' => $filename,
      'folder_name' => $folder_path,
      'tug4_unsigned_upload_time' => date('Y-m-d H:i:s'),
    );
    $this->db->where('key', $id);
    $this->db->update('data_penerimaan_marketplace', $data);
  }

  public function verify_document($key, $token)
  {

    $data = array(
      'tug_unsigned_locked' => 1,
      'tug_unsigned_locked_update' => date('Y-m-d H:i:s'),
      'user_locked_update' => $this->session->userdata('user_id'),

    );
    $this->db->where('key', $key);
    $this->db->update('data_penerimaan_marketplace', $data);
  }

  public function update_data_queue_sign($token)
  {

    $data = array(
      'request_status' => 2,
      'request_at' => date('Y-m-d H:i:s'),

    );
    $this->db->where('token', $token);
    $this->db->update('data_queue_sign', $data);
  }


  public function sign_update($key)
  {
    $data = array(
      'tug_signed_request' => 1,
      'tug_signed_request_time' => date('Y-m-d H:i:s'),
      'user_signed_request' => $this->session->userdata('user_id'),
    );
    $this->db->where('key', $key);
    $this->db->update('data_penerimaan_marketplace', $data);
  }


  public function process_sign($key, $token, $formid, $note)
  {
    $this->db->where('id', $formid);
    $query = $this->db->get('mst_sign_positions');
    $sign_position = $query->row_array();

    $this->db->where('key', $key);
    $query = $this->db->get('data_penerimaan_marketplace');
    $marketplace = $query->row_array();

    $data = array(
      'id_process' => $token,
      'form_id' => $formid,
      'form_name' => $sign_position['form_name'],
      'key_reference' => $key,
      'request_time' => date('Y-m-d H:i:s'),
      'count_sign' => $sign_position['sign_count'],
      'current_count_sign' => 0,
      'title' => $note,
      'desc' => $marketplace['spk_number'] . " - " . $marketplace['pabrikan'],
      // 1 = aktif, 0 = reject / batal
      'status' => 1,
      // 'user_signed_request' => $this->session->userdata('user_id'),
    );
    $this->db->where('key', $key);
    $this->db->insert('data_process_sign', $data);

    // insert ke status queue ttd
    // Looping sebanyak sign_count
    for ($i = 1; $i <= $sign_position['sign_count']; $i++) {
      // Menentukan nilai request_status berdasarkan formid dan iterasi loop
      $request_status = 0;
      if ($formid == 1 && $i >= 1 && $i <= 7) {
        $request_status = 1;
      } elseif ($formid == 2 && $i <= 2) {
        $request_status = 1;
      } elseif ($formid == 3 && $i <= 2) {
        $request_status = 1;
      }

      $data = array(
        'id_process_reference' => $token,
        'users_id' => $sign_position['u_sign_' . $i],
        'sequence' => $i,
        'generate_at' => date('Y-m-d H:i:s'),
        'token' => $this->generate_token(15),
        'form_name' => $sign_position['form_name'],
        'x_sign' => $sign_position['x_sign_' . $i],
        'y_sign' => $sign_position['y_sign_' . $i],
        'keterangan' => $sign_position['desc_sign_' . $i],
        'uri' => '/digitalsign/publicmp/',
        'title' => $note,
        'request_status' => $request_status,
        'desc' => $marketplace['spk_number'] . " - " . $marketplace['pabrikan'],
      );
      $this->db->insert('data_queue_sign', $data);
    }
  }

  function generate_token($a)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < $a; $i++) {
      $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $token;
  }



  public function save_file_tug3($id, $filename, $folder_path)
  {

    $data = array(
      'tug3_unsigned_file' => $filename,
      'folder_name' => $folder_path,
      'tug3_unsigned_upload_time' => date('Y-m-d H:i:s'),
    );
    $this->db->where('key', $id);
    $this->db->update('data_penerimaan_marketplace', $data);
  }

  public function save_file_tug3k($id, $filename, $folder_path)
  {

    $data = array(
      'tug3_karantina_unsigned_file' => $filename,
      'folder_name' => $folder_path,
      'tug3_karantina_unsigned_upload_time' => date('Y-m-d H:i:s'),
    );
    $this->db->where('key', $id);
    $this->db->update('data_penerimaan_marketplace', $data);
  }




  public function update_user($id)
  {
    $new_no_wa = $this->input->post('no_wa');

    // Ambil no_wa yang ada saat ini di database
    $this->db->select('no_wa');
    $this->db->where('id', $id);
    $current_no_wa = $this->db->get('mst_users')->row()->no_wa;

    $data = array(
      'nip' => trim($this->input->post('nip')),
      'username' => trim($this->input->post('username')),
      'fullname' => $this->input->post('fullname'),
      'position' => $this->input->post('position'),
      'email' => trim($this->input->post('email')),
      'role' => $this->input->post('role'),
      'no_wa' => $new_no_wa,
      'category' => $this->input->post('kategori'),
      'vendor' => ($this->input->post('pilihvendor')) ? $this->input->post('pilihvendor') : 0
    );

    // Jika no_wa baru berbeda dengan yang ada di database, set verified_wa menjadi 0
    if ($new_no_wa != $current_no_wa) {
      $data['verified_wa'] = 0;
    }

    if (!empty($this->input->post('password'))) {
      $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
    }

    $this->db->where('id', $id);
    return $this->db->update('mst_users', $data);
  }

  public function get_vendor_options()
  {
    $vendor_options = $this->db->select('id, vendor_name as name')->from('mst_vendors')->get()->result_array();
    return $vendor_options;
  }


  public function update_status($id, $status)
  {
    $data = array(
      'status' => $status
    );
    $this->db->where('id', $id);
    return $this->db->update('mst_users', $data);
  }

  public function get_data_queue_sign($token)
  {
    $this->db->select('a.*, b.fullname, b.no_wa');
    $this->db->from('data_queue_sign a');
    $this->db->join('mst_users b', 'a.users_id = b.id');
    $this->db->where('a.token', $token);
    $query = $this->db->get();
    $result = $query->row();
    return $result;
  }




  public function get_all_positions()
  {
    $query = $this->db->get('mst_user_position');
    return $query->result();
  }
  public function get_all_category()
  {
    $query = $this->db->get('mst_user_category');
    return $query->result();
  }

  public function get_all_roles()
  {
    $query = $this->db->get('mst_user_role');
    return $query->result();
  }
}
