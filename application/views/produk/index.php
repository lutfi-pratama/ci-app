<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <?php unset($_SESSION['message']); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newProdukModal">Add New Product</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($produk as $pd) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td>Cek</td>
                            <td><?= $pd['jenis']; ?></td>
                            <td><?= $pd['kategori']; ?></td>
                            <td><?= $pd['produk']; ?></td>
                            <td><?= $pd['harga']; ?></td>
                            <td>
                                <a href="" class=" badge badge-success" data-toggle="modal" data-target="#updateProdukModal<?= $pd['id']; ?> ">edit</a>
                                <a href="<?= base_url('Produk/delete/'); ?><?= $pd['id']; ?>" class=" badge badge-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data?');">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->

<div class="modal fade" id="newProdukModal" tabindex="-1" role="dialog" aria-labelledby="newProdukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProdukModalLabel">Add New Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('produk'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="">Select Jenis Produk</option>
                            <?php foreach ($jenis as $j) : ?>
                                <option value="<?= $j['jenis']; ?>"><?= $j['jenis']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kategori" id="kategori" class="form-control">
                            <option value="">Select Kategori Produk</option>
                            <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['kategori']; ?>"><?= $k['kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="produk" name="produk" placeholder="Tambahkan Nama Produk">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Tambahkan Harga Produk" min="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>