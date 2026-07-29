<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">Laporan Cost PO NK Per PIC</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?php if (!empty($tanggal_error)) : ?>
                <div class="alert alert-warning">
                    <?= html_escape($tanggal_error) ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <form method="get" action="<?= base_url('lap_nonkomersil') ?>">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tanggal Start :</label>
                                    <input type="date" class="form-control" name="tglstart" id="tglstart" value="<?= html_escape($tglstart) ?>">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tanggal End :</label>
                                    <input type="date" class="form-control" name="tglend" id="tglend" value="<?= html_escape($tglend) ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Nama PIC :</label>
                                    <select class="form-control" name="kdpic" id="kdpic">
                                        <option value="">Semua PIC</option>
                                        <?php foreach ($pic_options as $pic) : ?>
                                            <option value="<?= html_escape($pic->kd_user) ?>" <?= ($kdpic === $pic->kd_user) ? 'selected' : '' ?>>
                                                <?= html_escape($pic->nama_user) ?> - <?= html_escape($pic->departement) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i>
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    $export_params = array(
                        'tglstart' => $tglstart,
                        'tglend' => $tglend
                    );

                    if ($kdpic !== '') {
                        $export_params['kdpic'] = $kdpic;
                    }
                    ?>
                    <a class="btn btn-success btn-block mt-2" href="<?= base_url('export_cost_pic_ponk') . '?' . http_build_query($export_params) ?>">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-wallet"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Cost</span>
                            <span class="info-box-number">Rp. <?= number_format($grand_total_cost) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-file-invoice"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total PO</span>
                            <span class="info-box-number"><?= number_format($grand_total_po) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-boxes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Item</span>
                            <span class="info-box-number"><?= number_format($grand_total_item) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Ringkasan Cost PIC : <?= shortdate_indo($tglstart) ?> - <?= shortdate_indo($tglend) ?> | <?= html_escape($selected_pic_label) ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-cost-pic-summary" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-gray color-palette">
                                    <th>No</th>
                                    <th>PIC</th>
                                    <th>Departemen</th>
                                    <th>Total PO</th>
                                    <th>Total Item</th>
                                    <th>Total Qty</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($summary_cost_pic as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= html_escape($row->nama_user) ?></td>
                                        <td><?= html_escape($row->departement) ?></td>
                                        <td><?= number_format($row->total_po) ?></td>
                                        <td><?= number_format($row->total_item) ?></td>
                                        <td><?= number_format($row->total_qty) ?></td>
                                        <td>Rp. <?= number_format($row->total_cost) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Detail Cost PO NK Per PIC</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-cost-pic-detail" class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-gray color-palette">
                                    <th>No</th>
                                    <th>NOPO</th>
                                    <th>Tanggal</th>
                                    <th>PIC</th>
                                    <th>Departemen</th>
                                    <th>Tujuan Pembelian</th>
                                    <th>Nama Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Qty</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($detail_cost_pic as $row) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= html_escape($row->nopo) ?></td>
                                        <td><?= shortdate_indo($row->tgl_transaksi) ?></td>
                                        <td><?= html_escape($row->nama_user) ?></td>
                                        <td><?= html_escape($row->departement) ?></td>
                                        <td><?= html_escape($row->tj_pembelian) ?></td>
                                        <td><?= html_escape($row->nama_barang) ?></td>
                                        <td><?= html_escape($row->deskripsi) ?></td>
                                        <td><?= number_format($row->qty) ?></td>
                                        <td>Rp. <?= number_format($row->hrg_satuan) ?></td>
                                        <td>Rp. <?= number_format($row->total_harga) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!window.jQuery || !jQuery.fn.DataTable) {
            return;
        }

        jQuery('#table-cost-pic-summary').DataTable({
            pageLength: 25,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],
            ordering: true,
            responsive: true,
            language: {
                emptyTable: 'Data tidak ditemukan pada rentang tanggal ini.'
            }
        });

        jQuery('#table-cost-pic-detail').DataTable({
            pageLength: 25,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, 'All']
            ],
            ordering: true,
            responsive: true,
            language: {
                emptyTable: 'Data tidak ditemukan pada rentang tanggal ini.'
            }
        });
    });
</script>
