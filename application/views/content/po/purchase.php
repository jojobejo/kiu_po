<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div style="display: flex; text-align: center;">
                <a href="<?= base_url('purchase') ?>">
                    <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                </a>
                <?php $this->load->view('content/po/modal/msuplier') ?>
                <?php foreach ($kode_suplier as $b) : ?>
                    <h3 class=""><?= $b->nama_suplier ?> </h3>
                    &nbsp;
                    <a href="#" class=" ml-3 btn btn-warning " data-toggle="modal" data-target="#editSuplier<?= $b->id_suplier ?>">
                        <i class="fa fa-solid fa-pencil-alt"></i>
                    </a>
            </div>
            <div class="row">
                <div class="col-md">
                    <a href="<?= base_url('purchase/listBarang/') . $b->kd_suplier ?>" class="btn btn-primary mb-2 mt-2 btn-block">
                        <i class="fas fa-folder-plus"></i> &nbsp; Tambah Barang
                    </a>
                </div>

                <div class="col-md">
                    <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#modalnotebarang">
                        <i class="fas fa-notes-medical"> </i>
                        Tambah Note Barang
                    </a>
                </div>
                <?php foreach ($taxpo as $tp) : ?>
                    <?php if ($tp->tot == '0') : ?>
                        <div class="col-md">
                            <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#taxsetts">
                                <i class="fas fa-percent"> </i>
                                Input Tax (%)
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-md">
                            <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#taxsett<?= $kdsuplier ?>">
                                <i class="fas fa-percent"> </i>
                                Input Tax (%)
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="col-md">
                    <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#modaldiskon">
                        <i class="fas fa-tags"> </i>
                        Tambah Diskon
                    </a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

    <form action="#">
        <div class="row mb-2">
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nomor PO" value="" name="po_isi" id="po_isi">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tgl_isi" id="tgl_isi">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Franko Pengiriman" value="" name="gdgpengiriman" id="gdgpengiriman">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tempo Pembayaran" value="" name="tmpo" id="tmpo">
                </div>
            </div>

            <div class="col-md" hidden>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                    </div>
                    <input type="number" class="form-control" id="taxisi_in" name="taxisi_in" value="<?= $tax ?>" readonly hidden>
                </div>
            </div>

            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tanggal Transaksi" value="<?= $kdpo ?>" name="kd_po_isi" id="kd_po_isi" readonly>
                </div>
            </div>
        </div>

        <?php $this->load->view('content/po/modalpo') ?>

        <table id="" class="table table-striped">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Satuan</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Harga Diskon</td>
                    <td>Total Harga</td>
                    <td>Total Harga Setelah Diskon</td>
                    <td>Disc</td>
                    <td>#</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalHargaSetelahDiskon = 0;
                foreach ($tmp as $t) :
                    $isBonus = isset($t->is_bonus) && (int) $t->is_bonus === 1;
                    $diskonPerSatuan = 0;
                    if (!$isBonus) {
                        foreach ($tmpdiskon as $diskon) {
                            $prefixDiskonNominal = $t->nama_barang . ' - ';
                            $prefixDiskonPersen = 'Diskon Barang - ' . $t->nama_barang . ' ';

                            if (strpos($diskon->nama_diskon, $prefixDiskonNominal) === 0) {
                                $diskonPerSatuan += $diskon->nominal;
                            } elseif (strpos($diskon->nama_diskon, $prefixDiskonPersen) === 0 && $t->qty > 0) {
                                $diskonPerSatuan += $diskon->nominal / $t->qty;
                            }
                        }
                    }

                    $hargaDiskon = $isBonus ? 0 : max($t->harga_satuan - $diskonPerSatuan, 0);
                    $totalSetelahDiskon = $hargaDiskon * $t->qty;
                    $totalHargaSetelahDiskon += $totalSetelahDiskon;
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <?= $t->nama_barang ?>
                            <?php if ($isBonus) : ?>
                                <span class="badge badge-primary ml-1">BONUS</span>
                                <?php if (!empty($t->keterangan_bonus)) : ?>
                                    <div><small><?= $t->keterangan_bonus ?></small></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= $t->satuan ?></td>
                        <td><?= $t->qty ?></td>
                        <td>Rp. <?= number_format($t->harga_satuan, 2) ?></td>
                        <td>Rp. <?= number_format($hargaDiskon, 2) ?></td>
                        <td>Rp. <?= number_format($t->total_harga, 2) ?></td>
                        <td>Rp. <?= number_format($totalSetelahDiskon, 2) ?></td>
                        <td>
                            <?php if (!$isBonus) : ?>
                                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#diskonbarangs<?= $t->id_tmp ?>" title="Tambah Diskon">
                                    <i class="fas fa-percent"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                        <td><a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#modalEdit<?= $t->id_tmp ?>">
                                <i class="fa fa-solid fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusChart<?= $t->id_tmp ?>">
                                <i class="fa fa-solid fa-trash-alt"></i>
                            </a>
                            <?php if (!$isBonus) : ?>
                                <a class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#diskonbarang<?= $t->id_tmp ?>">
                                    <i class="fas fa-tags"></i>
                                    Diskon(%)Barang
                                </a>
                            <?php endif; ?>
                            <input type="text" class="form-control" id="kdsuplier" name="kdsuplier" value="<?= $t->kode_suplier ?>" hidden readonly>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php foreach ($total as $tot) : ?>
                    <tr>
                        <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                        <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tot->total_harga, 2) ?>
                            <input type="number" class="form-control" id="jmlitem" name="jmlitem" value="<?= $tot->total_item ?>" readonly hidden>
                            <input type="number" class="form-control" id="jmlharga" name="jmlharga" value="<?= $tot->total_harga ?>" readonly hidden>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon</td>
                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($totalHargaSetelahDiskon, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Tax </td>
                    <td colspan="2" style="font-weight: bold;"> <?= $tax ?> (%)</td>
                </tr>
            </tbody>
        </table>
        <table id="" class="table table-striped mt-2">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td colspan="3" style="text-align: center;">LIST DISKON</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Deskripsi Diskon</td>
                    <td style="text-align: center;">Nominal Diskon</td>
                    <td style="text-align: center;"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $listDiskonDisplay = array();
                foreach ($tmpdiskon as $d) {
                    $listDiskonDisplay[] = array(
                        'nama_diskon' => $d->nama_diskon,
                        'nominal' => $d->nominal,
                        'id_tmp_diskon' => $d->id_tmp_diskon,
                        'is_bonus_item' => false,
                    );
                }
                foreach ($tmp as $t) {
                    if (isset($t->is_bonus) && (int) $t->is_bonus === 1) {
                        $listDiskonDisplay[] = array(
                            'nama_diskon' => $t->nama_barang . ' - ' . (!empty($t->keterangan_bonus) ? $t->keterangan_bonus : 'Bonus'),
                            'nominal' => 0,
                            'id_tmp_diskon' => null,
                            'is_bonus_item' => true,
                        );
                    }
                }
                ?>
                <?php foreach ($listDiskonDisplay as $d) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $d['nama_diskon'] ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($d['nominal']) ?></td>
                        <td style="text-align: center;">
                            <?php if (!$d['is_bonus_item']) : ?>
                                <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#editdiskon<?= $d['id_tmp_diskon'] ?>">
                                    <i class="fa fa-solid fa-pencil-alt"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusdiskon<?= $d['id_tmp_diskon'] ?>">
                                    <i class="fa fa-solid fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table id="" class="table table-striped mt-2">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td style="text-align: center;">LIST Note Barang</td>
                </tr>
                <tr>
                    <td>Deskripsi Note</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tmpnote as $n) : ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <?= $n->isi_note ?>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#editnote<?= $n->id_nt_tmp_barang ?>">
                                        <i class="fa fa-solid fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusnote<?= $n->id_nt_tmp_barang ?>">
                                        <i class="fa fa-solid fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="btnBawah">
            <button class="btn btn-warning mr-2" type="reset">Reset</button>
            <button type="button" id="selesai" class="btn btn-primary">
                <i class="fa fa-print pr-1"></i>Rekam Order
            </button>
        </div>
    </div>

    </form>

</div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->
</div>
