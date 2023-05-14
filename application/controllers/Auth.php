<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  //TEST GIT
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation', 'session');
    $this->load->model('User_model');
  }

  public function index()
  {
    if ($this->is_logged_in()) {
      redirect('monitor/users');
    }
    // $this->session->sess_destroy();
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('captcha', 'Captcha', 'required');

    if ($this->form_validation->run() === FALSE) {
      $cap = $this->create_captcha();
      $data['captcha'] = $cap['image'];
      $this->load->view('login', $data);
    } else {
      $captcha_input = $this->input->post('captcha');
      $captcha_word = $this->session->userdata('captcha_word');

      if ($captcha_input == $captcha_word) {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->check_user($email);
        // var_dump($user);
        // exit();
        if ($user) {
          // // Dump informasi user di sini
          // echo "<pre>";
          // var_dump($user);
          // echo "</pre>";
          // exit; // Hentikan eksekusi lebih lanjut setelah menampilkan informasi user

          if (password_verify($password, $user->password)) {
            $userdata = array(
              'user_id' => $user->id,
              'username' => $user->username,
              'fullname' => $user->fullname,
              'email' => $user->email,
              'role' => $user->role_name,
              'position' => $user->position_name,
              'category' => $user->category,
              'logged_in' => TRUE
            );

            $this->session->set_userdata($userdata);
            // $this->session->set_flashdata('hapus', 'Berhasil dihapus');

            // var_dump($this->session->flashdata());
            // var_dump($this->session->userdata());
            // exit();

            //var_dump($this->session->userdata('email'));
            redirect(base_url('dashboard'));
          } else {
            $this->session->set_flashdata('error', 'Invalid Password');
            redirect('auth/login');
          }
        } else {
          $this->session->set_flashdata('error', 'Invalid Email');
          redirect('auth/login');
        }
      } else {
        $this->session->set_flashdata('error', 'Captcha tidak cocok');
        redirect('auth/login');
      }
    }
  }

  public function register()
  {
    $this->load->helper('form');

    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[mst_users.username]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mst_users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');
    $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,user]');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('register');
    } else {
      $data = array(
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'role' => $this->input->post('role'),
      );
      $this->User_model->create_user($data);
      redirect('auth/login');
    }
  }


  public function login()
  {
    if ($this->is_logged_in()) {
      redirect('dashboard');
    }
    // $this->session->sess_destroy();
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('captcha', 'Captcha', 'required');

    if ($this->form_validation->run() === FALSE) {
      $cap = $this->create_captcha();
      $data['captcha'] = $cap['image'];
      $this->load->view('login', $data);
    } else {
      $captcha_input = $this->input->post('captcha');
      $captcha_word = $this->session->userdata('captcha_word');

      if ($captcha_input == $captcha_word) {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->check_user($email);
        // var_dump($user);
        // exit();
        if ($user) {
          // // Dump informasi user di sini
          // echo "<pre>";
          // var_dump($user);
          // echo "</pre>";
          // exit; // Hentikan eksekusi lebih lanjut setelah menampilkan informasi user

          if (password_verify($password, $user->password)) {
            $userdata = array(
              'user_id' => $user->id,
              'username' => $user->username,
              'fullname' => $user->fullname,
              'email' => $user->email,
              'role' => $user->role_name,
              'position' => $user->position_name,
              'category' => $user->category,
              'logged_in' => TRUE
            );

            $this->session->set_userdata($userdata);
            // $this->session->set_flashdata('hapus', 'Berhasil dihapus');

            // var_dump($this->session->flashdata());
            // var_dump($this->session->userdata());
            // exit();

            //var_dump($this->session->userdata('email'));
            redirect(base_url('dashboard'));
          } else {
            $this->session->set_flashdata('error', 'Invalid Password');
            redirect('auth/login');
          }
        } else {
          $this->session->set_flashdata('error', 'Invalid Email');
          redirect('auth/login');
        }
      } else {
        $this->session->set_flashdata('error', 'Captcha tidak cocok');
        redirect('auth/login');
      }
    }
  }





  public function logout()
  {
    $this->session->unset_userdata(array('user_id', 'username', 'email', 'role', 'logged_in'));
    // $this->session->unset_userdata('captcha_word');
    $this->session->sess_destroy();
    setcookie('ci_session', '', time() - 3600, '/');
    redirect('auth/login');
  }



  private function create_captcha()
  {
    $this->load->helper('captcha');
    $this->load->helper('string');

    // Pastikan folder captcha_images ada dan memiliki izin yang tepat
    $captcha_folder = './captcha_images/';
    if (!file_exists($captcha_folder)) {
      mkdir($captcha_folder, 0755, true);
    }

    $vals = array(
      // 'word' => random_string('alnum', 3),
      'word' => rand(103, 999),
      'img_path' => $captcha_folder,
      'img_url' => base_url() . 'captcha_images/',
      'font_path' => FCPATH . 'system/fonts/texb.ttf',
      'img_width' => '170',
      'img_height' => 35,
      'expiration' => 7200
    );

    $cap = create_captcha($vals);

    // Jika gambar captcha berhasil dibuat
    if ($cap) {
      // simpan kata captcha ke session
      $this->session->set_userdata('captcha_word', $cap['word']);
    } else {
      // Jika terjadi kesalahan, atur $cap ke NULL
      $cap = NULL;
    }

    return $cap;
  }

  private function is_logged_in()
  {
    return $this->session->userdata('logged_in');
  }
}
