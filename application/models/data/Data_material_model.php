<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_material_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_material_view($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('mst_materials');
      return $query->result_array();
    }

    $this->db->select('a.*');
    $this->db->from('mst_materials a');
    $this->db->where('a.id', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }


  public function get_materials($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_materials a');
    // $this->db->join('mst_material_category b', 'a.material_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.material_number', $search);
      $this->db->or_like('a.material_description', $search);
      $this->db->or_like('a.company_code', $search);
      $this->db->or_like('a.plant', $search);
      $this->db->or_like('a.storage_location', $search);
      $this->db->or_like('a.material_type', $search);
      $this->db->or_like('a.material_group', $search);
      $this->db->or_like('a.base_unit_of_measure', $search);
      $this->db->or_like('a.valuation_type', $search);
      $this->db->or_like('a.valuation_class', $search);
      // $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.category_name di tabel mst_material_category
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }



  public function get_category($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_material_category a');

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
    $query = $this->db->get('mst_material_category');
    return $query->result();
  }


  public function get_materials_temp($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_materials_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.material_description', $search);
      $this->db->or_like('a.material_number', $search);
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }




  public function get_materials_count($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_materials a');
    // $this->db->join('mst_material_category b', 'a.material_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.material_number', $search);
      $this->db->or_like('a.material_description', $search);
      $this->db->or_like('a.company_code', $search);
      $this->db->or_like('a.plant', $search);
      $this->db->or_like('a.storage_location', $search);
      $this->db->or_like('a.material_type', $search);
      $this->db->or_like('a.material_group', $search);
      $this->db->or_like('a.base_unit_of_measure', $search);
      $this->db->or_like('a.valuation_type', $search);
      $this->db->or_like('a.valuation_class', $search);
      // $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.category_name di tabel mst_material_category
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function get_materials_count_temp($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_materials_temp a');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.material_description', $search);
      $this->db->or_like('a.material_number', $search);
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function copy_table()
  {
    // Copy tabel dari mst_materials_temp ke mst_materials
    $this->db->query("INSERT INTO mst_materials (material_number, material_description, company_code, plant, storage_location,material_type,material_group,base_unit_of_measure,valuation_type,valuation_class,unrestricted_use_stock,quality_inspection_stock,blocked_stock,in_transit_stock)
                      SELECT material_number, material_description, company_code, plant, storage_location,material_type,material_group,base_unit_of_measure,valuation_type,valuation_class,unrestricted_use_stock,quality_inspection_stock,blocked_stock,in_transit_stock FROM mst_materials_temp");

    // Kosongkan isi tabel mst_materials_temp
    $this->db->empty_table('mst_materials_temp');
  }
  public function reset_tabel_temp()
  {
    // Kosongkan isi tabel mst_materials_temp
    $this->db->empty_table('mst_materials_temp');
  }


  public function is_mst_materials_temp_empty()
  {
    $query = $this->db->get('mst_materials_temp');
    return $query->num_rows() == 0;
  }


  public function update_material($id)
  {
    $data = array(
      'material_number' => trim($this->input->post('material_number')),
      'material_description' => trim($this->input->post('material_description')),
      'company_code' => trim($this->input->post('company_code')),
      'plant' => trim($this->input->post('plant')),
      'storage_location' => trim($this->input->post('storage_location')),
      'material_type' => trim($this->input->post('material_type')),
      'material_group' => trim($this->input->post('material_group')),
      'base_unit_of_measure' => trim($this->input->post('base_unit_of_measure')),
      'valuation_type' => trim($this->input->post('valuation_type')),
      'valuation_class' => trim($this->input->post('valuation_class')),
      'unrestricted_use_stock' => trim($this->input->post('unrestricted_use_stock')),
      'quality_inspection_stock' => trim($this->input->post('quality_inspection_stock')),
      'blocked_stock' => trim($this->input->post('blocked_stock')),
      'in_transit_stock' => trim($this->input->post('in_transit_stock'))
    );

    $this->db->where('id', $id);
    return $this->db->update('mst_materials', $data);
  }

  public function create_material()
  {
    $data = array(
      'material_number' => trim($this->input->post('material_number')),
      'material_description' => trim($this->input->post('material_description')),
      'company_code' => trim($this->input->post('company_code')),
      'plant' => trim($this->input->post('material_catplantegory')),
      'storage_location' => trim($this->input->post('storage_location')),
      'material_type' => trim($this->input->post('material_type')),
      'material_group' => trim($this->input->post('material_group')),
      'base_unit_of_measure' => trim($this->input->post('base_unit_of_measure')),
      'valuation_type' => trim($this->input->post('valuation_type')),
      'valuation_class' => trim($this->input->post('valuation_class')),
      'unrestricted_use_stock' => trim($this->input->post('unrestricted_use_stock')),
      'quality_inspection_stock' => trim($this->input->post('quality_inspection_stock')),
      'blocked_stock' => trim($this->input->post('blocked_stock')),
      'in_transit_stock' => trim($this->input->post('in_transit_stock'))
    );

    return $this->db->insert('mst_materials', $data);
  }

  public function insert($data)
  {
    $this->db->insert_batch('mst_materials_temp', $data);
  }




  public function get_vendor_options()
  {
    $vendor_options = $this->db->select('id, material_name as name')->from('mst_materials')->get()->result_array();
    return $vendor_options;
  }
}
