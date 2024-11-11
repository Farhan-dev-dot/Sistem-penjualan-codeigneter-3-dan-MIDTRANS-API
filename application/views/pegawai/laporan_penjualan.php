<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading card-header d-flex justify-content-between align-items-center">
                    <h4 class="title mb-0">Laporan <span class="font-weight-bold">Transaksi</span></h4>
                    <form action="<?= base_url('Laporan_penjualan'); ?>" method="post" class="d-flex align-items-center">
                        <input type="date" name="start_date" value="<?= isset($start_date) ? $start_date : ''; ?>" class="form-control mr-2" required>
                        <input type="date" name="end_date" value="<?= isset($end_date) ? $end_date : ''; ?>" class="form-control mr-2" required>
                        <input type="submit" class="btn btn-light" name="submit" value="Filter">
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>NO</th>
                                    <th>Order ID</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Produk</th>
                                    <th>Tanggal</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($laporan_penjualan)) : ?>
                                    <?php foreach ($laporan_penjualan as $t) : ?>
                                        <tr class="text-center">
                                            <td><?= ++$start; ?></td>
                                            <td><span class="badge badge-info">#<?= $t['order_id']; ?></span></td>
                                            <td><?= $t['pelanggan']; ?></td>
                                            <td><?= $t['jumlah']; ?></td>
                                            <td>Rp <?= number_format($t['total'], 0, ',', '.'); ?></td>
                                            <td><?= $t['produk']; ?></td>
                                            <td><?= date('d-m-Y', strtotime($t['tanggal'])); ?></td>
                                            <td><?= $t['payment']; ?></td>
                                            <td>
                                                <?= $t['status'] == "pending" ? '<span class="badge badge-danger">Pending</span>' : ''; ?>
                                                <?php if ($t['status'] == "settlement") : ?>
                                                    <span class="badge badge-success">Success</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data ditemukan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>