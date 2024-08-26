<?php foreach ($item as $i) : ?>
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
                        <div class="col-sm-0">
                            <h1 class="m-0 mb-2">Stock Tersedia : <b style="text-transform:uppercase"><?= $i->qty_ready ?></b></h1>
                        </div><!-- /.col -->
                        <table class="table table-bordered">
                            <thead style="background-color: #212529; color:white;">
                                <tr>
                                    <td style="text-align: center;">Kode Transaksi</td>
                                    <td style="text-align: center;">Kode Akun</td>
                                    <td style="text-align: center;">Tanggal Transaksi</td>
                                    <td style="text-align: center;">Departemen</td>
                                    <td style="text-align: center;">PIC</td>
                                    <td style="text-align: center;">Qty</td>
                                    <td style="text-align: center;">Satuan</td>
                                    <td style="text-align: center;">#</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stock as $s) :
                                    $nm_satuan = "";
                                    $dep    = "";
                                    $qs = "";
                                    $btn = "";
                                    $txt = "";
                                    // USER
                                    if ($s->nm_1 == '0') {
                                        $nm_satuan = $s->nm_2;
                                    } elseif ($s->nm_2 == '0') {
                                        $nm_satuan = $s->nm_1;
                                    }
                                    // DEPARTEMEN
                                    if ($s->dep_1 == '0') {
                                        $dep    = $s->dep_2;
                                    } elseif ($s->dep_2 == '0') {
                                        $dep    = $s->dep_1;
                                    }
                                    // KODE AKUN
                                    if ($s->kd_akun == '11512') {
                                        $qs     = "-";
                                        $btn    = "btn btn-block btn-warning btn-sm";
                                        $txt    = 'Pengurangan Barang';
                                    } else {
                                        $qs     = "";
                                        $btn    = "btn btn-block btn-success btn-sm";
                                        $txt    = 'Persedian Barang';
                                    }
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $s->kd_transaksi ?></td>
                                        <td>
                                            <a href="#" class="<?= $btn ?>"><b style="text-transform:uppercase"><?= $txt ?></b></a>
                                        </td>
                                        <td style="text-align: center;"><?= format_indo($s->tgl_transaksi) ?></td>
                                        <td style="text-align: center;"><?= $dep ?></td>
                                        <td style="text-align: center;"><?= $nm_satuan ?></td>
                                        <td style="text-align: center;"><?= $qs . $s->qty ?></td>
                                        <td style="text-align: center;"><?= $s->nm_satuan ?></td>
                                        <td><a href="<?= base_url('revisitr/' . $s->kd_akun . '/' . $s->kd_transaksi . '/' . $s->kd_barang) ?>" class="btn btn-block btn-primary btn-sm"><i class="fa fa-solid fa-eye"></i></a></td>
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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