<?php foreach ($item as $i) : ?>
    <?php $this->load->view('content/stock/nonkomersil/modal/modalstock.php') ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 ml-2">
                    <div class="col-sm-0">
                        <h1 class="m-0">Detail Stock Item : <b style="text-transform:uppercase"><?= $i->nama_barang ?> (<?= $i->satuan ?>) (<?= $i->kode_barang ?>)</b></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-0 ml-2">
                        <a href="<?= base_url('stocknonkomersil') ?>" class="btn btn-sm btn-block btn-success mt-1"><i class="fas fa-undo-alt"></i></a>
                    </div>
                </div><!-- /.row -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-0">
                                <h1 class="m-0 mb-2">Stock Tersedia : <b style="text-transform:uppercase"><?= $i->qty_ready ?></b></h1>
                            </div><!-- /.col -->
                            <div class="col-sm-0">
                                <a class="btn btn-sm btn-block btn-success mt-1 ml-3" data-toggle="modal" data-target="#adjustmentqty<?= $i->kode_sistem ?>"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead style="background-color: #212529; color:white;">
                                <tr>
                                    <td style="text-align: center;">Kode Transaksi</td>
                                    <td style="text-align: center; width: 5%;">Tanggal Transaksi</td>
                                    <td style="text-align: center;">Kode Akun</td>
                                    <td style="text-align: center;">Keterangan</td>
                                    <td style="text-align: center;">Departemen</td>
                                    <td style="text-align: center;">PIC</td>
                                    <td style="text-align: center;">Qty</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stock as $s) :
                                    $qs = "";
                                    $btn = "";
                                    $txt = "";
                                    // KODE AKUN
                                    if ($s->kd_akun == '11512') {
                                        $qs     = "-";
                                        $btn    = "btn btn-block bg-cstm1 btn-sm color-palette";
                                        $txt    = 'Pengurangan Barang';
                                    } elseif ($s->kd_akun == '11511') {
                                        $qs     = '';
                                        $btn    = "btn btn-block btn-sm bg-cstm2 color-palette";
                                        $txt    = 'Penambahan Barang';
                                    } elseif ($s->kd_akun == '11513') {
                                        $qs     = '';
                                        $btn    = "btn btn-block btn-sm bg-cstm3 color-palette";
                                        $txt    = 'adjustmen stock(+)';
                                    } elseif ($s->kd_akun == '11514') {
                                        $qs     = '-';
                                        $btn    = "btn btn-block btn-sm bg-cstm4 color-palette";
                                        $txt    = 'adjustmen stock(-)';
                                    }
                                ?>
                                    <tr>
                                        <td style="text-align: center; width: 5%;"><?= $s->kd_transaksi ?></td>
                                        <td style="text-align: center;"><?= shortdate_indo($s->tgl_transaksi) ?></td>
                                        <td>
                                            <a href="#" class="<?= $btn ?>"><b style="text-transform:uppercase; color: #212529;"><?= $txt ?></b></a>
                                        </td>
                                        <td style="text-align: center;"><?= $s->ket ?></td>
                                        <?php if ($s->lvusr == "") : ?>
                                            <td style="text-align: center;">ADMIN</td>
                                            <td style="text-align: center;"><?= $s->inpt ?></td>
                                        <?php else : ?>
                                            <td style="text-align: center;"><?= $s->dep ?></td>
                                            <td style="text-align: center;"><?= $s->nmreq ?></td>
                                        <?php endif; ?>
                                        <td style="text-align: center;"><?= $qs . $s->qty . " " . "(" . $s->nm_satuan . ")" ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mr-2">
                    <div class="col-md-8">
                        <h1><b style="text-transform:uppercase">Stock Tracking</b></h1>
                        <div class="noteDirektur">
                            <table class="table table-bordered table-stripeds">
                                <thead style="background-color: #212529; color:white;">
                                    <tr>
                                        <td class="tdnote">ISI NOTE</td>
                                        <td class="tduser">USER</td>
                                        <td style="text-align: center;">TANGGAL</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($note as $n) : ?>
                                        <tr>
                                            <td><?= $n->isi_note ?></td>
                                            <td><?= $n->nama_user ?></td>
                                            <td><?= $n->create_at ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
<?php endforeach; ?>