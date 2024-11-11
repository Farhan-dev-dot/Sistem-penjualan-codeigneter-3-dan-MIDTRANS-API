<?php

class Model_kategori extends CI_Model
{


    public function getallkategori()
    {
        return $this->db->get('kategori_produk')->result_array();
    }

    public function insertkategori($data)
    {
        $this->db->insert('kategori_produk', $data);
    }

    public function getkategoriById($id)
    {
        return $this->db->get_where('kategori_produk', ['id_kategori' => $id])->row_array();
    }
}
