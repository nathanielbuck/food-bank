<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index()
	{
		//$this->load->view('login');
        echo 'DENNIS';
        $users = User::all();
        print_r($users);
	}
}
?>
