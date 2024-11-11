<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_produk');
        $this->load->library('upload');
        $this->load->library('pagination');
    }

    public function index()
    {
        // $data['produk'] = $this->Model_produk->getAllProduk();
        $data['kategori'] = $this->Model_produk->getAllKategori();
        $data['title'] = 'Produk';

        $total_rows = $this->Model_produk->countAllProduk();
        $per_page = 5;

        $config['base_url'] = base_url('produk/index');
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['num_links'] = 2;


        $config['full_tag_open'] = '<ul class="pagination hidden-xs pull-right">';
        $config['full_tag_close'] = '</ul>';

        $current_page = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $data['produk'] = $this->Model_produk->getAllProduk($config['per_page'], $data['start']);

        $data['pagination_links'] = $this->pagination->create_links();

        $data['total_rows'] = $total_rows;

        $data['current_page'] = $current_page + 1;

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/produk', $data);
        $this->load->view('template/footer');
    }

    public function tambah()
    {
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 8000;

        $this->upload->initialize($config);

        $data = [
            'nama_produk' => $this->input->post('nama_produk'),
            'id_kategori' => $this->input->post('id_kategori'),
            'harga' => $this->input->post('harga'),
        ];

        if ($this->upload->do_upload('foto_produk')) {
            $uploadData = $this->upload->data();
            $data['foto_produk'] = $uploadData['file_name'];

            if ($this->Model_produk->insertProduk($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan produk.');
            }
        } else {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
        }

        redirect('produk');
    }

    public function getProdukById($id)
    {
        $produk = $this->Model_produk->getProdukById($id);
        if ($produk) {
            echo json_encode(['status' => 'success', 'data' => $produk]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }
    }

    public function ubah()
    {
        $id_produk = $this->input->post('id_produk');
        $data = [
            'nama_produk' => $this->input->post('nama_produk'),
            'id_kategori' => $this->input->post('id_kategori'),
            'harga' => $this->input->post('harga'),
        ];


        if (!empty($_FILES['foto_produk']['name'])) {
            $config['upload_path'] = './assets/img/upload/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 8000;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('foto_produk')) {
                $uploadData = $this->upload->data();
                $data['foto_produk'] = $uploadData['file_name'];
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('produk');
                return;
            }
        }

        if ($this->Model_produk->updateProduk($id_produk, $data)) {
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui produk.');
        }

        redirect('produk');
    }

    public function hapus($id_produk)
    {
        if ($this->Model_produk->deleteProduk($id_produk)) {
            $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produk.');
        }

        redirect('produk');
    }
}
