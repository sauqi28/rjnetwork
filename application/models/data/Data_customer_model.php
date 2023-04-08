<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_customer_model extends CI_Model
{
  public function __construct()
  {
    $this->load->database();
  }

  public function get_customer_view($id = NULL)
  {
    if ($id === NULL) {
      $query = $this->db->get('mst_customers');
      return $query->result_array();
    }

    $this->db->select('a.*');
    $this->db->from('mst_customers a');
    $this->db->where('a.id', $id);
    $query = $this->db->get();
    $user_additional_info = $query->row_array();

    return $user_additional_info;
  }


  public function get_users($limit, $start, $search = NULL)
  {
    $this->db->select('a.*, b.category_name');
    $this->db->from('mst_customers a');
    $this->db->join('mst_customer_category b', 'a.customer_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.customer_name', $search);
      $this->db->or_like('a.customer_address', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.name di tabel mst_customer_category
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }


  public function get_category($limit, $start, $search = NULL)
  {
    $this->db->select('a.*');
    $this->db->from('mst_customer_category a');

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
    $query = $this->db->get('mst_customer_category');
    return $query->result();
  }


  public function get_users_temp($limit, $start, $search = NULL)
  {
    $this->db->select('a.*, b.category_name');
    $this->db->from('mst_customers_temp a');
    $this->db->join('mst_customer_category b', 'a.customer_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.customer_name', $search);
      $this->db->or_like('a.customer_address', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->or_like('b.category_name', $search); // tambahkan kondisi pencarian pada kolom b.name di tabel mst_customer_category
      $this->db->group_end();
    }

    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result_array();
  }




  public function get_users_count($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_customers a');
    $this->db->join('mst_customer_category b', 'a.customer_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.customer_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->or_like('b.category_name', $search);
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function get_users_count_temp($search)
  {
    $this->db->select('a.*');
    $this->db->from('mst_customers_temp a');
    $this->db->join('mst_customer_category b', 'a.customer_category = b.id', 'left');

    if ($search) {
      $this->db->group_start();
      $this->db->like('a.id', $search);
      $this->db->or_like('a.customer_name', $search);
      $this->db->or_like('a.telp', $search);
      $this->db->or_like('b.category_name', $search);
      $this->db->group_end();
    }

    $query = $this->db->get();
    return $query->num_rows();
  }


  public function copy_table()
  {
    // Copy tabel dari mst_customers_temp ke mst_customers
    $this->db->query("INSERT INTO mst_customers (customer_name, customer_address, telp, customer_category)
                      SELECT customer_name, customer_address, telp, customer_category FROM mst_customers_temp");

    // Kosongkan isi tabel mst_customers_temp
    $this->db->empty_table('mst_customers_temp');
  }
  public function reset_tabel_temp()
  {
    // Kosongkan isi tabel mst_customers_temp
    $this->db->empty_table('mst_customers_temp');
  }


  public function is_mst_customers_temp_empty()
  {
    $query = $this->db->get('mst_customers_temp');
    return $query->num_rows() == 0;
  }


  public function update_customer($id)
  {
    $data = array(
      'customer_name' => $this->input->post('customer_name'),
      'telp' => $this->input->post('telp'),
      'customer_address' => $this->input->post('customer_address'),
      'customer_category' => $this->input->post('customer_category')
    );

    $this->db->where('id', $id);
    return $this->db->update('mst_customers', $data);
  }

  public function create_customer()
  {
    $data = array(
      'customer_name' => trim($this->input->post('customer_name')),
      'telp' => trim($this->input->post('telp')),
      'customer_address' => trim($this->input->post('customer_address')),
      'customer_category' => trim($this->input->post('customer_category'))
    );

    return $this->db->insert('mst_customers', $data);
  }

  public function insert($data)
  {
    $this->db->insert_batch('mst_customers_temp', $data);
  }




  public function get_vendor_options()
  {
    $vendor_options = $this->db->select('id, customer_name as name')->from('mst_customers')->get()->result_array();
    return $vendor_options;
  }
}
