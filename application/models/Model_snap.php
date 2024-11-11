<?php

class Model_snap extends CI_Model
{

    public function inserTransaksi($data)
    {
        $this->db->insert('orders', $data);
    }

    public function getbytransaksi()
    {
        $this->db->order_by('tanggal_order', 'DESC');
        $query = $this->db->get('orders', 1);
        return $query->row_array();
    }


    public function insertdetail($detailData)
    {
        $this->db->insert_batch('order_detail', $detailData);
    }

    public function getByidpelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('pelanggan');
        return $query->row_array();
    }


    public function insertpelanggan($data)
    {
        $this->db->insert('pelanggan', $data);
    }

    public function getAllProduk()
    {
        return $this->db->get('produk')->result_array();
    }
}
