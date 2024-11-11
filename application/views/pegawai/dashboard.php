<link rel="stylesheet" href="<?= base_url(); ?>/assets/css/dashcard.css">
<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-md-6 col-sm-12">
            <h1>My Dashboard</h1>
        </div>
        <div class="col-md-6 col-sm-12 justify-content-md-end justify-content-sm-end d-flex">
            <form method="post">
                <div class="form-group input-date">
                    <input type="date" name="tanggal" id="tanggal" value="<?= $tanggal; ?>" required>
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fa fa-filter"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class=" container-fluid">
    <div class="row mt-3">
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">PRODUK </h6>
                    <p class="card-text"><?= $total_produk; ?></p>
                    <a href="#" class="btn btn-seccondary">Detail<i class="fa fa-chevron-circle-info"></i></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">PELANGGAN </h6>
                    <p class="card-text"><?= $total_pelanggan; ?></p>
                    <a href="#" class="btn btn-seccondary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">PENDAPATAN TAHUNAN</h6>
                    </h6>
                    <p class="card-text"><?= number_format($pendapatan_harian, 0, ',', '.'); ?></p>
                    <a href="#" class="btn btn-secondary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">PENDAPATAN BULANAN </h6>
                    <p class="card-text"><?= number_format($pendapatan_tahunan, 0, ',', '.'); ?></p>
                    <a href="#" class="btn btn-secondary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-chart">
                    <h5 class="mb-0">Pendapatan Bulanan (Rp)</h5>
                </div>
                <div class="card-body card-body-chart">
                    <canvas id="pendapatanPerBulan"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-chart">
                    <h5 class="mb-0">Pendapatan Harian (Rp)</h5>
                </div>
                <div class="card-body card-body-chart">
                    <canvas id="pendapatanPerHari"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-table shadow-sm">
                <div class="card-header">
                    <h6 class="text-left mb-0">Order List</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-hover table-bordered">
                        <thead class="thead-secondary">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">nama_produk</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">jumlah</th>
                                <th scope="col">Metode Pembayaran</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_list as $order) : ?>
                                <tr>
                                    <th scope="row">#<?= $order['no']; ?></th>
                                    <td><?= $order['produk']; ?></td>
                                    <td><?= $order['nama_pelanggan']; ?></td>
                                    <td><?= $order['jumlah']; ?></td>
                                    <td><?= $order['payment']; ?></td>
                                    <td><?= $order['total_harga']; ?></td>
                                    <td>
                                        <?php if ($order['status'] == 'pending'): ?>
                                            <span class="badge badge-warning">Pending</span>
                                        <?php elseif ($order['status'] == 'settlement'): ?>
                                            <span class="badge badge-success">Sukses</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?= $order['status']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<input type="hidden" id="bulananLabels" value='<?= json_encode($pendapatan_bulanan); ?>'>
<input type="hidden" id="harianLabels" value='<?= json_encode($pendapatan_harian_chart); ?>'>