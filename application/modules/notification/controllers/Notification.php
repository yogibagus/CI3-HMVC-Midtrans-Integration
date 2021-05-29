<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MX_Controller
{

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
		parent::__construct();
		$params = array('server_key' => 'your_server_key', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model(['M_Notification']);
	}

	public function index()
	{
		echo 'test notification handler';
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result, 'true');
		$status_code = $result['status_code'];
		$order_id = $result['order_id'];

		$data = [
			'status_code' => $result['status_code'],
			'status_message' => $result['status_message'],
			'settlement_time' => $result['settlement_time'],
			'transaction_status' => $result['transaction_status']
		];

		if ($status_code == 200) {
			$this->M_Notification->update_transaction($order_id, $data);
		} else if ($status_code == 202) {
			$this->M_Notification->update_transaction($order_id, $data);
		} else if ($status_code == 201) {
			// todo
		} else {
			$this->M_Notification->update_transaction($order_id, $data);
		}
	}
}
