<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_produk extends CI_Model
{

    public function getAllProduk($limit, $start)
    {
        $this->db->select('p.*, k.nama_kategori');
        $this->db->from('produk p');
        $this->db->join('kategori_produk k', 'p.id_kategori = k.id_kategori');
        $this->db->limit($limit, $start);


        return $this->db->get()->result_array();
    }


    public function getAllKategori()
    {
        return $this->db->get('kategori_produk')->result_array();
    }


    public function insertProduk($data)
    {
        return $this->db->insert('produk', $data);
    }


    public function getProdukById($id_produk)
    {
        return $this->db->get_where('produk', ['id_produk' => $id_produk])->row_array();
    }


    public function updateProduk($id_produk, $data)
    {
        $this->db->where('id_produk', $id_produk);
        return $this->db->update('produk', $data);
    }


    public function deleteProduk($id_produk)
    {
        return $this->db->delete('produk', ['id_produk' => $id_produk]);
    }

    public function countAllProduk()
    {
        return $this->db->get('produk')->num_rows();
    }
}
