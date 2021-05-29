<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['M_Welcome']);
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function details_package()
	{
		$this->load->view('details_package');
	}

	public function order_list()
	{
		$data['trx'] = $this->M_Welcome->get_transaction();
		$this->load->view('order_list', $data);
	}
}
