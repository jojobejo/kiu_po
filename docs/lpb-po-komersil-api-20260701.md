# API LPB PO Komersil untuk KarismaERP

Tanggal: 2026-07-01

## Endpoint

```text
GET /kiu_po/api/lpb-po-komersil
```

Alias route:

```text
GET /kiu_po/get_lpb_po_komersil_erp
GET /kiu_po/get_data_lpb_po_komersil_erp
```

## Tujuan

Endpoint ini dipakai KarismaERP untuk mengambil data PO komersil yang akan dibuat menjadi LPB (Laporan Penerimaan Barang).

Data yang dikirim adalah header PO, supplier, dan detail barang. Data harga tidak dikirim.

## Query parameter

| Parameter | Default | Keterangan |
| --- | --- | --- |
| `limit` | `500` | Maksimal data detail yang dikirim. Batas maksimal `1000`. |
| `status` | `DONE` | Filter status PO. Pakai `ALL` untuk semua status. |
| `kd_po` | kosong | Filter kode PO internal KIU PO. |
| `no_po` | kosong | Filter nomor PO supplier/internal yang tercetak. |
| `kd_suplier` | kosong | Filter kode supplier. |
| `date_from` | kosong | Filter tanggal PO mulai dari `YYYY-MM-DD`. |
| `date_to` | kosong | Filter tanggal PO sampai `YYYY-MM-DD`. |
| `updated_since` | kosong | Filter data yang berubah sejak timestamp `YYYY-MM-DD HH:MM:SS`. |

## Contoh request

```bash
curl "http://localhost/kiu_po/api/lpb-po-komersil?limit=2&status=DONE"
```

## Contoh response

```json
{
  "status": true,
  "message": "success",
  "source": "po_komersil",
  "total_data": 1,
  "data": [
    {
      "sumber_data": "PO_KOMERSIL",
      "kode_sync": "SKPO010726WAHAN010001-7875",
      "kode_faktur": "SKPO010726WAHAN010001",
      "kd_po": "SKPO010726WAHAN010001",
      "nomor_po": "kkiupo88090",
      "nomor_invoice": null,
      "tanggal_po": "2026-07-01",
      "status": "DONE",
      "kode_suplier": "WAHAN01",
      "nama_suplier": " PT.Wahana Pundhi Karsa Abadi",
      "id_detail_source": "7875",
      "kode_barang": "QEVER05",
      "nama_barang": "Ever Green Asam Amino 40 X 250 ml",
      "satuan": "Box",
      "qty": "25",
      "isi": "1.00",
      "kemasan": "1.00",
      "qty_kecil": "25.0000",
      "is_bonus": "0",
      "keterangan_bonus": "",
      "kode_user_input": "KEU01",
      "detail_updated_at": "2026-07-01 20:37:23",
      "po_updated_at": "2026-07-01 20:59:49"
    }
  ]
}
```

## Definisi field

| Field | Sumber | Keterangan |
| --- | --- | --- |
| `sumber_data` | API | Selalu `PO_KOMERSIL`. |
| `kode_sync` | API | Kunci unik detail untuk sinkronisasi ERP: `kd_po-id_detail_source`. |
| `kode_faktur` | `tb_po.kd_po` | Kode dokumen sumber karena PO komersil belum punya kolom faktur khusus. |
| `kd_po` | `tb_po.kd_po` | Kode PO internal KIU PO. |
| `nomor_po` | `tb_po.no_po` | Nomor PO. |
| `nomor_invoice` | API | Saat ini `null`, diisi di ERP saat LPB/invoice diterima. |
| `tanggal_po` | `tb_po.tgl_transaksi` | Tanggal PO. |
| `status` | `tb_po.status` | Status PO. |
| `kode_suplier` | `tb_po.kd_suplier` | Kode supplier. |
| `nama_suplier` | `tb_suplier.nama_suplier` | Nama supplier. |
| `id_detail_source` | `tb_detail_po.id_det_po` | ID detail asal. |
| `kode_barang` | `tb_detail_po.kd_barang` | Kode barang PO. |
| `nama_barang` | `tb_detail_po.nama_barang` | Nama barang snapshot dari PO. |
| `satuan` | `tb_detail_po.satuan` | Satuan PO. |
| `qty` | `tb_detail_po.qty` | Qty sesuai satuan PO. |
| `isi` | `tb_detail_po.isi` | Konversi isi. |
| `kemasan` | `tb_detail_po.kemasan` | Konversi kemasan. |
| `qty_kecil` | `tb_detail_po.qty_kecil` | Qty satuan kecil. |
| `is_bonus` | `tb_detail_po.is_bonus` | Penanda barang bonus. |
| `keterangan_bonus` | `tb_detail_po.keterangan_bonus` | Catatan bonus jika ada. |
| `kode_user_input` | `tb_detail_po.kd_user` | User pembuat/input detail. |
| `detail_updated_at` | `tb_detail_po.create_at` | Timestamp detail terakhir berubah. |
| `po_updated_at` | `tb_po.create_at` | Timestamp header terakhir berubah. |

## Sinkronisasi ERP

ERP disarankan menyimpan `kode_sync` sebagai unique key. Jika endpoint dipanggil ulang, ERP melakukan upsert berdasarkan `kode_sync`.

Untuk incremental sync, panggil:

```text
GET /kiu_po/api/lpb-po-komersil?updated_since=2026-07-01 00:00:00
```
