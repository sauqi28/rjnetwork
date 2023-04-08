<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_vendor_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_vendor_view($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('mst_vendors');
      return $query->result_array();
    }

    $this->db->select('a.*');
    $this->db->from('mst_vendors a');
    $this->db->where('a.id', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }


  public function get_users($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_vendors a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.vendor_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->group_end();
    }
    // $this->db->where('a.status', "active");
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_users_temp($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_vendors_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.vendor_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->group_end();
    }
    // $this->db->where('a.status', "active");
    $this->db->limit($limit, $start);
    $this->db->where('status', 0);
    $this->db->where('users_id', $this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->result_array();
  }




  public function get_users_count($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_vendors a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.vendor_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->group_end();
    }
    // $this->db->where('a.status', "active");
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function get_users_count_temp($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_vendors_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.vendor_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->group_end();
    }
    // $this->db->where('a.status', "active");
    $this->db->where('status', 0);
    $this->db->where('users_id', $this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function copy_table()
  {
    // Copy tabel dari mst_vendors_temp ke mst_vendors
    $this->db->query("INSERT INTO mst_vendors (vendor_name, vendor_address, telp)
                      SELECT vendor_name, vendor_address, telp FROM mst_vendors_temp");

    // Kosongkan isi tabel mst_vendors_temp
    $this->db->empty_table('mst_vendors_temp');
  }
  public function reset_tabel_temp()
  {
    // Kosongkan isi tabel mst_vendors_temp
    $this->db->empty_table('mst_vendors_temp');
  }


  public function is_mst_vendors_temp_empty()
  {
    $query = $this->db->get('mst_vendors_temp');
    return $query->num_rows() == 0;
  }


  public function update_vendor($id)
  {
    $data = array(
      'vendor_name' => $this->input->post('vendor_name'),
      'telp' => $this->input->post('telp'),
      'vendor_address' => $this->input->post('vendor_address')
    );

    $this->db->where('id', $id);
    return $this->db->update('mst_vendors', $data);
  }

  public function create_vendor()
  {
    $data = array(
      'vendor_name' => trim($this->input->post('vendor_name')),
      'telp' => trim($this->input->post('telp')),
      'vendor_address' => trim($this->input->post('vendor_address'))
    );

    return $this->db->insert('mst_vendors', $data);
  }

  public function insert($data)
  {
    $this->db->insert_batch('mst_vendors_temp', $data);
  }




  public function get_vendor_options()
  {
    $vendor_options = $this->db->select('id, vendor_name as name')->from('mst_vendors')->get()->result_array();
    return $vendor_options;
  }
}
