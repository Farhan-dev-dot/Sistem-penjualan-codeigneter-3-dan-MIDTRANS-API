<?php

class Laporan_penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan', 'laporan_model');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['title'] = 'Laporan Penjualan';


        $data['start_date'] = $this->input->post('start_date') ?: $this->session->userdata('start_date');
        $data['end_date'] = $this->input->post('end_date') ?: $this->session->userdata('end_date');

        if ($this->input->post('submit')) {
            $this->session->set_userdata('start_date', $data['start_date']);
            $this->session->set_userdata('end_date', $data['end_date']);
        }

        $config['total_rows'] = $this->laporan_model->count_all_results($data['start_date'], $data['end_date']);
        $config['per_page'] = 3;

        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['laporan_penjualan'] = $this->laporan_model->get_penjualan($config['per_page'], $data['start'], $data['start_date'], $data['end_date']);

        // Load views
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('pegawai/laporan_penjualan', $data);
        $this->load->view('templates/footer');
    }
}
