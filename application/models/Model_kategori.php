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

    public function getKategoriById($id)
    {
        return $this->db->get_where('kategori_produk', ['id_kategori' => $id])->row_array();
    }


    public function updateKategori($id_kategori, $data)
    {
        $this->db->where('id_kategori', $id_kategori);
        return $this->db->update('kategori_produk', $data);
    }

    public function deletekategori($id_kategori)
    {
        $this->db->delete('kategori_produk', ['id_kategori' => $id_kategori]);
        return $this->db->affected_rows();
    }
}
