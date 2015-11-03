<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class foods extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->model('food');
       }
	
	public function index()
	{
		$this->load->view('index');
	}
	public function main()
	{
		$this->load->view('main');
	}
	public function no()
	{
		$this->load->view('/partials/restaurants');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */