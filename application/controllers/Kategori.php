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
            $this->load->view('admin/kategori', $data);
        } else {
            $this->Model_kategori->insertkategori($data);
            redirect('kategori');
        }
    }

    public function getKategoriById($id)
    {
        $kategori = $this->Model_kategori->getKategoriById($id);
        if ($kategori) {
            echo json_encode(['status' => 'success', 'data' => $kategori]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
        }
    }

    public function ubah()
    {
        $id_kategori = $this->input->post('id_kategori');
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];

        if ($this->Model_kategori->updateKategori($id_kategori, $data)) {
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui Kategori.');
        }

        redirect('kategori');
    }
    public function hapus($id)
    {
        if ($this->Model_kategori->deleteKategori($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus Kategori.');
        }

        redirect('kategori');
    }
}
