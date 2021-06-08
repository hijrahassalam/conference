<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent:: __construct();
		//error_reporting(0);
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper('captcha');
		$this->load->model('account_model');
	}

	public function index()
	{
		$logged_in = $this->session->userdata('logged_in');
			$user_role = $this->session->userdata('user_role');
			
			if (!$logged_in) {

				$this->form_validation->set_message('required', '%s harus diisi');
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				//$this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_check_captcha');
				
				if ($this->form_validation->run() == FALSE)   {
					$word = $this->generateRandomString(4);
			          $vals = array(
			            'word'  => $word,
			            'font_path'     => './asset/Verdana.ttf',
			            'img_path' => './uploads/captcha/',
			            'img_url' => base_url('uploads/captcha').'/',
			            'img_width'     => '150',
			            'img_height'    => 40,
			            'expiration'    => 7200,
			            'colors'        => array(
			                'background' => array(255, 255, 255),
			                'border' => array(255, 255, 255),
			                'text' => array(0, 0, 0),
			                'grid' => array(255, 40, 40)
			            )
			          );
			            
			          /* Generate the captcha */
			          $data['captcha'] = create_captcha($vals);
			          
			          /* Store the captcha value (or 'word') in a session to retrieve later */
			          $this->session->set_userdata('captchaWord', $word);
					  $this->load->view('home/login', $data);
				} else   {
							$username = $this->input->post('username', TRUE);
							$password = $this->input->post('password', TRUE);
							$temp_account = $this->account_model->check_user_account($username, $password)->row_array();
							// check account
							$num_account = count($temp_account);
							
							if ($num_account > 0)
							{
								//$array_items = array( 'user_name' => $temp_account['username'], 'role' => $temp_account['role'], 'logged_in'=>'1');
								$this->session->set_userdata('user_name',$temp_account['username']);
								$this->session->set_userdata('role',$temp_account['role']);
								$this->session->set_userdata('logged_in','1');

								redirect(base_url('admin/dashboard'));
								//var_dump($this->session->userdata);
							} 
							else 
							{
								// kalau ga ada diredirect lagi ke halaman login
								$this->session->set_flashdata('msg', 'Username dan Password tidak cocok!');
							}
             		$this->session->unset_userdata('captchaWord');
					redirect(base_url('login'));
				}

			} else {
				redirect(base_url('index.php/admin/dashboard'));
			}
	}

	public function generateRandomString($length = 10) {
      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    public function check_captcha($a) {
      $word = $this->session->userdata('captchaWord');
      if (strcmp(strtoupper($a),strtoupper($word)) != 0) {
        $this->form_validation->set_message('check_captcha', 'Terdapat kesalahan pada captcha');
        return false;
      } else return true;
    }

    public function tes()
    {
    	$username="admin";
    	$password="sembio";
    	$temp_account = $this->account_model->check_user_account($username, $password)->row_array();
		// check account
		$num_account = count($temp_account);
		
		if ($num_account > 0)
		{
			//$array_items = array( 'user_name' => $temp_account['username'], 'role' => $temp_account['role'], 'logged_in'=>'1');
			$this->session->set_userdata('user_name',$temp_account['username']);
			$this->session->set_userdata('role',$temp_account['role']);
			$this->session->set_userdata('logged_in','1');
			//var_dump($this->session->userdata);
		} 
    	var_dump($this->session->userdata);
    }
}
