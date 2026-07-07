<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="m-0">Master Barang Komersil</h1>
                </div>
            </div>

            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>
                <table class="table table-bordered table-striped" id="list_mbarangkomersil" data-ajax-url="<?= base_url('masterbarangkomersil/data') ?>" data-detail-url="<?= base_url('masterbarangkomersil/detail/') ?>">
                    <thead style="background-color: #212529; color:white;">
                        <tr>
                            <td>Kode Barang</td>
                            <td>Nama Barang</td>
                            <td>Bahan Aktif</td>
                            <td>Satuan</td>
                            <td>Supplier</td>
                            <td>Panjang</td>
                            <td>Lebar</td>
                            <td>Tinggi</td>
                            <td>Stock Min</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
