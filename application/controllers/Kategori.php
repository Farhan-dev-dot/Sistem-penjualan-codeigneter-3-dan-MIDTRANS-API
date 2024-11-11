<?php

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kategori');
    }

    public function index()
    {
        $data['kategori'] = $this->Model_kategori->getallkategori();
        $data['title'] = 'Kategori';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kategori', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {

        $data = [
            'id_kategori' => $this->input->post('id_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori')

        ];

        if ($this->input->post('submit')) {
            $this->load->view('admin/tambah_kategori', $data);
        } else {
            $this->Model_kategori->insertkategori($data);
            redirect('kategori');
        }
    }

    public function getkategoriById($id)
    {
        $data = $this->Model_kategori->getkategoriById($id);
        echo json_encode($data);
    }
}
