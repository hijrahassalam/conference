<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core extends CI_Controller {
  
  public function __construct() {
    parent::__construct();
  }


  public function set_bahasa($data = null) {
    $this->session->set_userdata('bahasa',$data);
  }

  public function clear_project() {
    $this->session->unset_userdata('tahun');
    $this->session->unset_userdata('kegiatan');
    $this->session->unset_userdata('jenis');
    $this->session->unset_userdata('found');
    redirect(base_url('dashboard'));
  }
}
?>