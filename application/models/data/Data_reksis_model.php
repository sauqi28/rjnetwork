<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_reksis_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_reksis_view($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('data_reksis_detail');
      return $query->result_array();
    }

    $this->db->select('a.*');
    $this->db->from('data_reksis_detail a');
    $this->db->where('a.id', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }


  public function get_reksiss($limit, $start, $search = NULL)
  {
    $this->db->select('a.*, b.customer_name');
    $this->db->from('data_reksis_desc a');
    $this->db->join('mst_customers b', 'a.customer = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.gardu_type', $search);
      $this->db->or_like('a.gi_penyulang', $search);
      $this->db->or_like('a.customer', $search);
      $this->db->or_like('a.pb_pd', $search);
      $this->db->or_like('a.status', $search);
      $this->db->or_like('b.customer_name', $search);
      $this->db->or_like('b.customer_address', $search);
      // $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.category_name di tabel mst_reksis_category
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }



  public function get_category($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_reksis_category a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.category_name', $search);
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_all_category()
  {
    $query = $this->db->get('mst_reksis_category');
    return $query->result();
  }


  public function get_reksiss_temp($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_reksiss_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.reksis_description', $search);
      $this->db->or_like('a.reksis_number', $search);
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }




  public function get_reksiss_count($search)
  {
    $this->db->select('a.*, b.customer_name');
    $this->db->from('data_reksis_desc a');
    $this->db->join('mst_customers b', 'a.customer = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.gardu_type', $search);
      $this->db->or_like('a.gi_penyulang', $search);
      $this->db->or_like('a.customer', $search);
      $this->db->or_like('a.pb_pd', $search);
      $this->db->or_like('a.status', $search);
      $this->db->or_like('b.customer_name', $search);
      $this->db->or_like('b.customer_address', $search);
      // $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.category_name di tabel mst_reksis_category
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function get_reksiss_count_temp($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_reksiss_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.reksis_description', $search);
      $this->db->or_like('a.reksis_number', $search);
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function copy_table()
  {
    // Copy tabel dari mst_reksiss_temp ke mst_reksiss
    $this->db->query("INSERT INTO mst_reksiss (reksis_number, reksis_description, company_code, plant, storage_location,reksis_type,reksis_group,base_unit_of_measure,valuation_type,valuation_class,unrestricted_use_stock,quality_inspection_stock,blocked_stock,in_transit_stock)
                      SELECT reksis_number, reksis_description, company_code, plant, storage_location,reksis_type,reksis_group,base_unit_of_measure,valuation_type,valuation_class,unrestricted_use_stock,quality_inspection_stock,blocked_stock,in_transit_stock FROM mst_reksiss_temp");

    // Kosongkan isi tabel mst_reksiss_temp
    $this->db->empty_table('mst_reksiss_temp');
  }
  public function reset_tabel_temp()
  {
    // Kosongkan isi tabel mst_reksiss_temp
    $this->db->empty_table('mst_reksiss_temp');
  }


  public function is_mst_reksiss_temp_empty()
  {
    $query = $this->db->get('mst_reksiss_temp');
    return $query->num_rows() == 0;
  }


  public function update_reksis($id)
  {
    $data = array(
      'reksis_number' => trim($this->input->post('reksis_number')),
      'reksis_description' => trim($this->input->post('reksis_description')),
      'company_code' => trim($this->input->post('company_code')),
      'plant' => trim($this->input->post('plant')),
      'storage_location' => trim($this->input->post('storage_location')),
      'reksis_type' => trim($this->input->post('reksis_type')),
      'reksis_group' => trim($this->input->post('reksis_group')),
      'base_unit_of_measure' => trim($this->input->post('base_unit_of_measure')),
      'valuation_type' => trim($this->input->post('valuation_type')),
      'valuation_class' => trim($this->input->post('valuation_class')),
      'unrestricted_use_stock' => trim($this->input->post('unrestricted_use_stock')),
      'quality_inspection_stock' => trim($this->input->post('quality_inspection_stock')),
      'blocked_stock' => trim($this->input->post('blocked_stock')),
      'in_transit_stock' => trim($this->input->post('in_transit_stock'))
    );

    $this->db->where('id', $id);
    return $this->db->update('mst_reksiss', $data);
  }

  public function create_reksis()
  {
    $data = array(
      'reksis_number' => trim($this->input->post('reksis_number')),
      'reksis_description' => trim($this->input->post('reksis_description')),
      'company_code' => trim($this->input->post('company_code')),
      'plant' => trim($this->input->post('reksis_catplantegory')),
      'storage_location' => trim($this->input->post('storage_location')),
      'reksis_type' => trim($this->input->post('reksis_type')),
      'reksis_group' => trim($this->input->post('reksis_group')),
      'base_unit_of_measure' => trim($this->input->post('base_unit_of_measure')),
      'valuation_type' => trim($this->input->post('valuation_type')),
      'valuation_class' => trim($this->input->post('valuation_class')),
      'unrestricted_use_stock' => trim($this->input->post('unrestricted_use_stock')),
      'quality_inspection_stock' => trim($this->input->post('quality_inspection_stock')),
      'blocked_stock' => trim($this->input->post('blocked_stock')),
      'in_transit_stock' => trim($this->input->post('in_transit_stock'))
    );

    return $this->db->insert('mst_reksiss', $data);
  }

  public function insert($data)
  {
    $this->db->insert_batch('mst_reksiss_temp', $data);
  }




  public function get_vendor_options()
  {
    $vendor_options = $this->db->select('id, reksis_name as name')->from('mst_reksiss')->get()->result_array();
    return $vendor_options;
  }
}
