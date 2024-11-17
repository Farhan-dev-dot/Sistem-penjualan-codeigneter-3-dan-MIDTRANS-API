<h1 class="title"><?= $title; ?></h1>
<ul class="breadcrumbs">
    <li><a href="#">Master</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active"><?= $title; ?></a></li>
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
                            <h4 class="title">Data <span><?= $title; ?></span></h4>
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
                                <th>Nama kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kategori as $p) : ?>
                                <tr>
                                    <td>1</td>
                                    <td><?= $p['nama_kategori'] ?></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="#" data-tip="edit" onclick="edit(<?= $p['id_kategori'] ?>)"><i class="fa fa-edit"></i></a></li>
                                            <li><a href="<?= site_url('kategori/hapus/' . $p['id_kategori']) ?>" data-tip="delete" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus Kategori ini?')"><i class="fa fa-trash"></i></a></li>
                                        </ul>
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
</section>


<div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="modalKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="fromKategori" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_kategori" id="id_kategori">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
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
        $('#fromKategori')[0].reset();
        $('#id_kategori').val('');
        $('#modalKategoriLabel').text('Tambah Kategori');
        $('#modalKategori').modal('show');
    });


    function edit(id) {
        $.ajax({
            url: 'http://localhost/garchik/kategori/getKategoriById/' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                    $('#id_kategori').val(response.data.id_kategori);
                    $('#nama_kategori').val(response.data.nama_kategori);
                    $('#modalKategoriLabel').text('Edit Kategori');
                    $('#modalKategori').modal('show');
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
                    text: 'Gagal mendapatkan data Kategori.',
                });
            }
        });
    }


    $('#fromKategori').on('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const actionUrl = $('#id_kategori').val() ? '<?= site_url('kategori/ubah') ?>' : '<?= site_url('kategori/tambah') ?>';

        $.ajax({
            url: actionUrl,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: $('#id_kategori').val() ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.',
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal menyimpan Kategori.',
                });
            }
        });
    });
</script>
