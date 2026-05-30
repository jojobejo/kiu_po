<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <style>
                .po-table-wrap {
                    overflow-x: auto;
                }

                .po-input-table {
                    font-size: 14px;
                    min-width: 1280px;
                }

                .po-input-table td {
                    padding: .5rem .6rem;
                    vertical-align: middle;
                    white-space: nowrap;
                }

                .po-input-table thead td {
                    font-weight: 600;
                    text-align: center;
                }

                .po-input-table .col-item {
                    max-width: 380px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .po-input-table .text-number {
                    text-align: right;
                }

                .po-input-table tbody td:first-child,
                .po-input-table tbody td:nth-child(3),
                .po-input-table tbody td:last-child {
                    text-align: center;
                }

                .po-input-table .action-cell {
                    display: flex;
                    gap: .25rem;
                    align-items: center;
                    justify-content: center;
                }

                .po-input-table .btn-icon {
                    align-items: center;
                    display: inline-flex;
                    height: 32px;
                    justify-content: center;
                    padding: 0;
                    width: 32px;
                }
            </style>
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

        <div class="table-responsive po-table-wrap">
        <table id="table_form_input_po" class="table table-sm table-striped po-input-table">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Satuan</td>
                    <td>Qty</td>
                    <td>Qty Kecil</td>
                    <td>Harga</td>
                    <td>Harga Satuan Kecil</td>
                    <td>Harga Diskon</td>
                    <td>Total Harga</td>
                    <td>Total Harga Setelah Diskon</td>
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
                    $qtyKecil = isset($t->qty_kecil) && (float) $t->qty_kecil > 0 ? $t->qty_kecil : $t->qty;
                    $qtyKecilDisplay = ceil((float) $qtyKecil);
                    $hargaSatuanKecil = isset($t->harga_satuan_kecil) && ((float) $t->harga_satuan_kecil > 0 || $isBonus) ? $t->harga_satuan_kecil : $t->harga_satuan;
                    if (!$isBonus) {
                        foreach ($tmpdiskon as $diskon) {
                            $diskonRowTmp = null;
                            if (preg_match('/\[ROW_TMP:(\d+)\]/', $diskon->nama_diskon, $rowMatch)) {
                                $diskonRowTmp = (int) $rowMatch[1];
                            }
                            if ($diskonRowTmp !== null && $diskonRowTmp !== (int) $t->id_tmp) {
                                continue;
                            }

                            $prefixDiskonNominal = $t->nama_barang . ' - ';
                            $prefixDiskonPersen = 'Diskon Barang - ' . $t->nama_barang . ' ';

                            if (strpos($diskon->nama_diskon, $prefixDiskonNominal) === 0) {
                                $diskonPerSatuan += $diskon->nominal;
                            } elseif (strpos($diskon->nama_diskon, $prefixDiskonPersen) === 0) {
                                if (preg_match('/\(([0-9.,]+)%\)/', $diskon->nama_diskon, $match)) {
                                    $persenDiskon = (float) str_replace(',', '.', $match[1]);
                                    $diskonPerSatuan += ((float) $hargaSatuanKecil * $persenDiskon) / 100;
                                } elseif ($t->qty > 0) {
                                    $diskonPerSatuan += $diskon->nominal / $t->qty;
                                }
                            }
                        }
                    }

                    $hargaDiskon = $isBonus ? 0 : max($hargaSatuanKecil - $diskonPerSatuan, 0);
                    $totalSetelahDiskon = $hargaDiskon * $qtyKecil;
                    $totalHargaSetelahDiskon += $totalSetelahDiskon;
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="col-item" title="<?= htmlspecialchars($t->nama_barang, ENT_QUOTES, 'UTF-8') ?>">
                            <?= $t->nama_barang ?>
                            <?php if ($isBonus) : ?>
                                <span class="badge badge-primary ml-1">BONUS</span>
                                <?php if (!empty($t->keterangan_bonus)) : ?>
                                    <div><small><?= $t->keterangan_bonus ?></small></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= $t->satuan ?></td>
                        <td class="text-number"><?= $t->qty ?></td>
                        <td class="text-number"><?= number_format($qtyKecilDisplay, 0, ',', '.') ?></td>
                        <td class="text-number">Rp. <?= number_format($t->harga_satuan, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format((float) $hargaSatuanKecil, 2, ',', '.') ?></td>
                        <td class="text-number">Rp. <?= number_format($hargaDiskon, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($t->total_harga, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($totalSetelahDiskon, 2) ?></td>
                        <td>
                            <div class="action-cell">
                            <a href="#" class="btn btn-warning btn-sm btn-icon" data-toggle="modal" data-target="#modalEdit<?= $t->id_tmp ?>" title="Edit">
                                <i class="fa fa-solid fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm btn-icon" data-toggle="modal" data-target="#hapusChart<?= $t->id_tmp ?>" title="Hapus">
                                <i class="fa fa-solid fa-trash-alt"></i>
                            </a>
                            <?php if (!$isBonus) : ?>
                                <a class="btn btn-sm btn-info btn-icon" data-toggle="modal" data-target="#diskonbarangs<?= $t->id_tmp ?>" title="Tambah Diskon">
                                    <i class="fas fa-percent"></i>
                                </a>
                                <a class="btn btn-sm bg-lightblue btn-icon" data-toggle="modal" data-target="#diskonbarang<?= $t->id_tmp ?>" title="Diskon Barang">
                                    <i class="fas fa-tags"></i>
                                </a>
                            <?php endif; ?>
                            </div>
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
                    <td></td>
                </tr>
                <?php foreach ($total as $tot) : ?>
                    <tr>
                        <td colspan="9" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                        <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tot->total_harga, 2) ?>
                            <input type="number" class="form-control" id="jmlitem" name="jmlitem" value="<?= $tot->total_item ?>" readonly hidden>
                            <input type="number" class="form-control" id="jmlharga" name="jmlharga" value="<?= $tot->total_harga ?>" readonly hidden>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="9" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon</td>
                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($totalHargaSetelahDiskon, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="9" style="text-align: end; padding-right:3%; font-weight: bold;">Tax </td>
                    <td colspan="2" style="font-weight: bold;"> <?= $tax ?> (%)</td>
                </tr>
            </tbody>
        </table>
        </div>
        <table id="" class="table table-striped mt-2">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td colspan="4" style="text-align: center;">LIST DISKON</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Deskripsi Diskon</td>
                    <td style="text-align: center;">Nominal Diskon</td>
                    <td style="text-align: center;">Value</td>
                    <td style="text-align: center;"></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $listDiskonDisplay = array();
                $tmpQtyKecilById = array();
                $totalQtyKecilPesanan = 0;

                foreach ($tmp as $t) {
                    $qtyKecilPesanan = isset($t->qty_kecil) && (float) $t->qty_kecil > 0 ? (float) $t->qty_kecil : (float) $t->qty;
                    $tmpQtyKecilById[(int) $t->id_tmp] = $qtyKecilPesanan;
                    $totalQtyKecilPesanan += $qtyKecilPesanan;
                }

                foreach ($tmpdiskon as $d) {
                    $qtyKecilDiskon = 0;
                    if (preg_match('/\[ROW_TMP:(\d+)\]/', $d->nama_diskon, $rowMatch)) {
                        $rowTmpId = (int) $rowMatch[1];
                        if (isset($tmpQtyKecilById[$rowTmpId])) {
                            $qtyKecilDiskon = $tmpQtyKecilById[$rowTmpId];
                        }
                    }

                    if ($qtyKecilDiskon <= 0) {
                        foreach ($tmp as $t) {
                            $prefixDiskonNominal = $t->nama_barang . ' - ';
                            $prefixDiskonPersen = 'Diskon Barang - ' . $t->nama_barang . ' ';
                            if (strpos($d->nama_diskon, $prefixDiskonNominal) === 0 || strpos($d->nama_diskon, $prefixDiskonPersen) === 0) {
                                $qtyKecilDiskon = isset($t->qty_kecil) && (float) $t->qty_kecil > 0 ? (float) $t->qty_kecil : (float) $t->qty;
                                break;
                            }
                        }
                    }

                    if ($qtyKecilDiskon <= 0) {
                        $qtyKecilDiskon = $totalQtyKecilPesanan;
                    }

                    $listDiskonDisplay[] = array(
                        'nama_diskon' => $d->nama_diskon,
                        'nominal' => $d->nominal,
                        'value' => (float) $d->nominal * $qtyKecilDiskon,
                        'id_tmp_diskon' => $d->id_tmp_diskon,
                        'is_bonus_item' => false,
                    );
                }
                foreach ($tmp as $t) {
                    if (isset($t->is_bonus) && (int) $t->is_bonus === 1) {
                        $listDiskonDisplay[] = array(
                            'nama_diskon' => $t->nama_barang . ' - ' . (!empty($t->keterangan_bonus) ? $t->keterangan_bonus : 'Bonus'),
                            'nominal' => 0,
                            'value' => 0,
                            'id_tmp_diskon' => null,
                            'is_bonus_item' => true,
                        );
                    }
                }
                ?>
                <?php foreach ($listDiskonDisplay as $d) : ?>
                    <tr>
                        <td style="text-align: center;"><?= preg_replace('/\s*\[ROW_(TMP|DET):\d+\]/', '', $d['nama_diskon']) ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($d['nominal']) ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($d['value'], 2) ?></td>
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
