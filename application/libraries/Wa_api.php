<?php defined('BASEPATH') or exit('No direct script access allowed');

class Wa_api
{


  private $CI;
  private $url;
  private $key;

  public function __construct()
  {
    $this->CI = &get_instance();
    $this->CI->load->config('woowa_config');
    $this->url = $this->CI->config->item('woowa_url');
    $this->key = $this->CI->config->item('woowa_key');
  }

  public function send_message($phone_no, $message, $skip_link = false)
  {
    $data = array(
      'phone_no' => $phone_no,
      'key' => $this->key,
      'message' => $message,
      'skip_link' => "False"
    );
    $data_string = json_encode($data);
    $ch = curl_init($this->url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 360);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($data_string)
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
  }
}
