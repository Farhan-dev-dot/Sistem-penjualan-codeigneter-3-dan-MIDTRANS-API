<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
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

		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: PUT, GET, POST");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");



		$params = array('server_key' => 'SB-Mid-server-wVDWKYsEpkKSXe4JeMFwOTOD', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('Model_snap');
		$this->load->model('Model_produk');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}

	public function pembayaran()
	{
		$data['produk'] = $this->Model_snap->getAllProduk();
		$data['kategori'] = $this->Model_produk->getAllKategori();
		$data['title'] = 'Pembayaran';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pegawai/pembayaran', $data);
		$this->load->view('templates/footer');
	}

	public function token()
	{

		$nama = $this->input->post('fullName');
		$total = $this->input->post('total');
		$id_pelanggan = $this->input->post('id_pelanggan');


		$cartItems = $this->input->post('cartItems');

		// var_dump($cartItems);
		// die;




		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $total,
		);

		$item_details = [];
		foreach ($cartItems as $item) {
			$item_details[] = [
				'id' => $item['id'],
				'id_pelanggan' => $item['id_pelanggan'],
				'price' => $item['price'],
				'quantity' => $item['quantity'],
				'name' => $item['name']
			];
		}


		// Optional


		// Optional
		// $item_details = array();

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
			'id_pelanggan' => $id_pelanggan,
			'first_name'    => $nama,
			// 'billing_address'  => $billing_address,
			// 'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 1
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true);


		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>';
		// die;

		$id_pelanggan = $this->input->post('id_pelanggan');
		$nama = $this->input->post('fullName');

		// var_dump($id_pelanggan);
		// die;

		$data =
			[
				'id_pelanggan' => $id_pelanggan,
				'nama_pelanggan' => $nama,
			];

		$this->Model_snap->insertpelanggan($data);

		$id = $this->Model_snap->getByidpelanggan($id_pelanggan);
		// var_dump($id);
		// die;



		$data = [
			'order_id' => $result['order_id'],
			'id_pelanggan' => $id['id_pelanggan'],
			'payment_type' => $result['payment_type'],
			'tanggal_order' => $result['transaction_time'],
			'bank' =>  $result['va_numbers'][0]['bank'],
			'va_number' =>  $result['va_numbers'][0]['va_number'],
			'status_code' => $result['transaction_status'],
		];

		$data['transaksi'] = $this->Model_snap->inserTransaksi($data);
		// echo 'RESULT <br><pre>';
		// var_dump($data['transaksi']);
		// echo '</pre>';
		// die;


		$cartItems = json_decode($this->input->post('cart_data'), true);


		$detailData = [];
		foreach ($cartItems as $item) {
			$detailData[] = [
				'order_id' => $result['order_id'],
				'id_produk' => $item['id'],
				'subtotal' => $item['subtotal'],
				'jumlah' => $item['quantity'],
			];
		}
		$this->Model_snap->insertdetail($detailData);

		if ($result['status_code'] == 'settlement') {
			$this->session->set_flashdata('success', 'Transaksi Berhasil');
			redirect('transaksi');
		} else {
			$this->session->set_flashdata('error', 'Transaksi Gagal');
			redirect('snap/pembayaran');
		}
	}
}
