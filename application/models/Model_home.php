<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_home extends CI_Model
{

    public function total_pelanggan()
    {
        return $this->db->count_all('pelanggan');
    }


    public function total_produk()
    {
        return $this->db->count_all('produk');
    }


    public function pendapatanHarian($tanggal)
    {

        $this->db->select('SUM(order_detail.subtotal) as total_pendapatan');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.order_id = order_detail.order_id');
        $this->db->where('DATE(tanggal_order)', $tanggal);

        $query = $this->db->get();
        return $query->row_array()['total_pendapatan'] ?: 0;
    }

    public function pendapatanTahunan($tahun)
    {

        $this->db->select('SUM(order_detail.subtotal) as total_pendapatan_tahunan');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.order_id = order_detail.order_id');
        $this->db->where('YEAR(tanggal_order)', $tahun);


        $query = $this->db->get();


        return $query->row_array()['total_pendapatan_tahunan'] ?: 0;
    }


    public function pendapatanBulanan($tahun)
    {
        $this->db->select('MONTH(tanggal_order) as bulan, SUM(order_detail.subtotal) as total_pendapatan_bulan');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.order_id = order_detail.order_id');
        $this->db->where('YEAR(tanggal_order)', $tahun);
        $this->db->group_by('MONTH(tanggal_order)');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function pendapatanHarianChart($bulan, $tahun)
    {
        $this->db->select('DAY(tanggal_order) as hari, SUM(order_detail.subtotal) as total_pendapatan');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.order_id = order_detail.order_id');
        $this->db->where('MONTH(tanggal_order)', $bulan);
        $this->db->where('YEAR(tanggal_order)', $tahun);
        $this->db->group_by('DAY(tanggal_order)');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function orderList($tanggal, $limit)
    {
        $this->db->select('o.order_id AS no, pd.nama_produk AS produk, SUM(od.jumlah) AS jumlah, o.payment_type AS payment, o.status_code AS status, p.nama_pelanggan, o.tanggal_order, SUM(od.subtotal) AS total_harga');
        $this->db->from('orders o');
        $this->db->join('pelanggan p', 'o.id_pelanggan = p.id_pelanggan');
        $this->db->join('order_detail od', 'o.order_id = od.order_id');
        $this->db->join('produk pd', 'od.id_produk = pd.id_produk');
        $this->db->where('DATE(o.tanggal_order)', $tanggal);
        $this->db->group_by('o.order_id, pd.nama_produk');
        $this->db->order_by('o.order_id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result_array();
    }
}
