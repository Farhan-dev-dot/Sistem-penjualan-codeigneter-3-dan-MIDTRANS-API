<?php

class Model_laporan extends CI_Model
{
    public function get_penjualan($limit, $start, $start_date = null, $end_date = null)
    {
        $this->db->select('dt.order_detail_id AS order_detail_id,
            t.order_id AS order_id,
            t.tanggal_order AS tanggal, 
            dt.subtotal AS total,
            pr.nama_produk AS produk,
            dt.jumlah AS jumlah,
            pr.harga AS harga,
            p.nama_pelanggan AS pelanggan,
            t.payment_type AS payment, 
            t.bank AS bank,
            t.status_code AS status');

        $this->db->from('order_detail dt');
        $this->db->join('orders t', 'dt.order_id = t.order_id');
        $this->db->join('pelanggan p', 't.id_pelanggan = p.id_pelanggan');
        $this->db->join('produk pr', 'dt.id_produk = pr.id_produk');

        if ($start_date && $end_date) {
            $this->db->where("t.tanggal_order BETWEEN '$start_date' AND '$end_date'");
        }

        $this->db->order_by('dt.order_detail_id', 'ASC');
        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }

    public function count_all_results($start_date = null, $end_date = null)
    {
        $this->db->from('order_detail dt');
        $this->db->join('orders t', 'dt.order_id = t.order_id');
        $this->db->join('pelanggan p', 't.id_pelanggan = p.id_pelanggan');
        $this->db->join('produk pr', 'dt.id_produk = pr.id_produk');


        if ($start_date && $end_date) {
            $this->db->where("t.tanggal_order BETWEEN '$start_date' AND '$end_date'");
        }

        return $this->db->count_all_results();
    }
}
