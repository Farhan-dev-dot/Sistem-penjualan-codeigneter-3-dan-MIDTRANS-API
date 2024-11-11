<h1 class="title">PRODUK</h1>
<ul class="breadcrumbs">
    <li><a href="#">Master</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Produk</a></li>
</ul>

<div class="container-fluid">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-offset-1 col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col col-sm-3 col-xs-12">
                            <h4 class="title">Data <span>Produk</span></h4>

                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <button type="button" class="btn btn-default" id="btnTambah"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produk as $p) : ?>
                                <tr>
                                    <td><?= ++$start; ?></td>
                                    <td><?= $p['nama_produk']; ?></td>
                                    <td><?= $p['nama_kategori'] ?></td>
                                    <td><?= number_format($p['harga'], 0, ',', '.') ?></td>
                                    <td><img src="<?= base_url('assets/img/upload/' . $p['foto_produk']) ?>" width="100" /></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="#" data-tip="edit" onclick="edit(<?= $p['id_produk'] ?>)"><i class="fa fa-edit"></i></a></li>
                                            <li><a href="<?= site_url('produk/hapus/' . $p['id_produk']) ?>" data-tip="delete" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus produk ini?')"><i class="fa fa-trash"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col col-sm-6 col-xs-6">
                            Jumlah Data <b><?= $total_rows ?></b>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <?= $pagination_links;
                            ?>
                            <ul class="pagination visible-xs pull-right">
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</section>


<div class="modal fade" id="modalProduk" tabindex="-1" role="dialog" aria-labelledby="modalProdukLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formProduk" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdukLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" id="nama_produk" required>
                    </div>
                    <div class="form-group">
                        <label for="id_kategori">Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_produk">Foto Produk (optional)</label>
                        <input type="file" class="form-control" name="foto_produk" id="foto_produk">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#btnTambah').on('click', function() {
        $('#formProduk')[0].reset();
        $('#id_produk').val('');
        $('#modalProdukLabel').text('Tambah Produk');
        $('#modalProduk').modal('show');
    });


    function edit(id) {
        $.ajax({
            url: '<?= site_url('produk/getProdukById/') ?>' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#id_produk').val(response.data.id_produk);
                    $('#nama_produk').val(response.data.nama_produk);
                    $('#id_kategori').val(response.data.id_kategori);
                    $('#harga').val(response.data.harga);
                    $('#modalProdukLabel').text('Edit Produk');
                    $('#modalProduk').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal mendapatkan data produk.',
                });
            }
        });
    }


    $('#formProduk').on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const actionUrl = $('#id_produk').val() ? '<?= site_url('produk/ubah') ?>' : '<?= site_url('produk/tambah') ?>';

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: $('#id_produk').val() ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.',
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal menyimpan produk.',
                });
            }
        });
    });
</script>