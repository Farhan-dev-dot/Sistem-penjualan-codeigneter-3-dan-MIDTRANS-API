<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_home');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'My Dashboard';
		$data['total_pelanggan'] = $this->Model_home->total_pelanggan();
		$data['total_produk'] = $this->Model_home->total_produk();

		$tanggal = $this->input->post('tanggal') ?: date('Y-m-d');

		$bulan = date('m', strtotime($tanggal));

		$tahun = date('Y', strtotime($tanggal));

		$data['pendapatan_harian'] = $this->Model_home->pendapatanHarian($tanggal);

		$data['tanggal'] = $tanggal;

		$data['pendapatan_tahunan'] = $this->Model_home->pendapatanTahunan($tahun);


		$data['pendapatan_bulanan'] = $this->Model_home->pendapatanBulanan($tahun);


		$data['pendapatan_harian_chart'] = $this->Model_home->pendapatanHarianChart($bulan, $tahun);


		$limit = 5;
		$data['order_list'] = $this->Model_home->orderList($tanggal, $limit);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('pegawai/dashboard', $data);
		$this->load->view('templates/footer');
	}
}
