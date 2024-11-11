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
                            <h4 class="title">Data <span>kategori</span></h4>

                        </div>
                        <div class="col-sm-9 col-xs-12 text-right">
                            <div class="btn_group">
                                <button type="button" class="btn btn-default" title="Tambah Data Kategori" id="btnTambah"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($kategori as $p) : ?>
                                <tr>
                                    <td>1</td>
                                    <!-- <td><?= ++$start; ?></td> -->
                                    <td><?= $p['nama_kategori']; ?></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="#" data-tip="edit" onclick="edit(<?= $p['id_kategori'] ?>)"><i class="fa fa-edit"></i></a></li>
                                            <li><a href="<?= base_url('kategori/hapus/' . $p['id_kategori']) ?>" data-tip="delete" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus kategori ini?')"><i class="fa fa-trash"></i></a></li>
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
                            <!-- Jumlah Data <b><?= $total_rows ?></b> -->
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <!-- <?= $pagination_links;
                                    ?> -->
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


<div class="modal fade" id="modalkategori" tabindex="-1" role="dialog" aria-labelledby="modalkategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formkategori" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalkategoriLabel">Tambah kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <div class="form-group">
                        <label for="nama_kategori">Nama kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>