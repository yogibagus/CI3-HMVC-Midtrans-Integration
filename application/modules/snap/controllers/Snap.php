<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends MX_Controller
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
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model(['M_Snap']);
	}

	public function index()
	{
		redirect('');
	}

	public function token()
	{

		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$package_name = $this->input->post('package_name');
		$package_price = $this->input->post('package_price');
		$package_id = $this->input->post('package_id');

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $package_price, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => $package_id,
			'price' => $package_price,
			'quantity' => 1,
			'name' => $package_name,
		);

		// // Optional
		// $item2_details = array(
		// 	'id' => 'a2',
		// 	'price' => 20000,
		// 	'quantity' => 2,
		// 	'name' => "Orange"
		// );

		// Optional
		$item_details = array($item1_details);

		// // Optional
		// $billing_address = array(
		// 	'first_name'    => "Andri",
		// 	'last_name'     => "Litani",
		// 	'address'       => "Mangga 20",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16602",
		// 	'phone'         => "081122334455",
		// 	'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		// 	'first_name'    => "Obet",
		// 	'last_name'     => "Supriadi",
		// 	'address'       => "Manggis 90",
		// 	'city'          => "Jakarta",
		// 	'postal_code'   => "16601",
		// 	'phone'         => "08113366345",
		// 	'country_code'  => 'IDN'
		// );

		// Optional
		$customer_details = array(
			'first_name'    => $name,
			// 'last_name'     => "Litani",
			'email'         => $email,
			// 'phone'         => "081122334455",
			// 'billing_address'  => $billing_address,
			// 'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		// $custom_expiry = array(
		// 	'start_time' => date("Y-m-d H:i:s O", $time),
		// 	'unit' => 'day',
		// 	'duration'  => 1
		// );

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			// 'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);
		$type = $result['payment_type'];
		if ($type == 'bank_transfer') {
			$this->bank_transfer($result);
		} else if ($type == 'gopay') {
			$this->gopay($result);
		} else if ($type == 'qris') {
			$this->qris($result);
		} else if ($type == 'cstore') {
			$this->cstore($result);
		}

		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>';
		echo $this->massage;
	}

	public function bank_transfer($result)
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $name,
			'customer_email'           => $email,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			'bank'               => $result['va_numbers'][0]['bank'],
			'va_numbers'          => $result['va_numbers'][0]['va_number'],
			'status_message'     => $result['status_message'],
			'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url']
		];
		$save = $this->M_Snap->save_transaction($data);
		if ($save == true) {
			$this->massage = "Success";
			// redirect('welcome/order_list');
		} else {
			$this->massage = "Error";
		}
	}

	public function gopay($result)
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $name,
			'customer_email'           => $email,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			// 'bank'               => $result['va_numbers'][0]['bank'],
			// 'va_numbers'          => $result['va_numbers'][0]['va_number'],
			'status_message'     => $result['status_message'],
			// 'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			// add
			'transaction_id' => $result['transaction_id']
		];
		$save = $this->M_Snap->save_transaction($data);
		if ($save == true) {
			$this->massage = "Success";
			// redirect('welcome/order_list');
		} else {
			$this->massage = "Error";
		}
	}

	public function qris($result)
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $name,
			'customer_email'           => $email,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			// 'bank'               => $result['va_numbers'][0]['bank'],
			// 'va_numbers'          => $result['va_numbers'][0]['va_number'],
			'status_message'     => $result['status_message'],
			// 'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			// add
			'transaction_id' => $result['transaction_id']
		];
		$save = $this->M_Snap->save_transaction($data);
		if ($save == true) {
			$this->massage = "Success";
			// redirect('welcome/order_list');
		} else {
			$this->massage = "Error";
		}
	}

	public function cstore($result)
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$data = [
			'order_id'	  		 => $result['order_id'],
			'customer_name'           => $name,
			'customer_email'           => $email,
			'gross_amount'		 => $result['gross_amount'],
			'payment_type' 		 => $result['payment_type'],
			'transaction_time'   => $result['transaction_time'],
			// 'bank'               => $result['va_numbers'][0]['bank'],
			// 'va_numbers'          => $result['va_numbers'][0]['va_number'],
			'status_message'     => $result['status_message'],
			'pdf_url'            => $result['pdf_url'],
			'transaction_status' => $result['transaction_status'],
			'status_code' => $result['status_code'],
			'finish_redirect_url' => $result['finish_redirect_url'],
			//add
			'payment_code' => $result['payment_code']
		];
		$save = $this->M_Snap->save_transaction($data);
		if ($save == true) {
			$this->massage = "Success";
			// redirect('welcome/order_list');
		} else {
			$this->massage = "Error";
		}
	}
}
