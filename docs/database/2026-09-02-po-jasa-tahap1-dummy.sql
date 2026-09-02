START TRANSACTION;

DELETE FROM `tbpo_jasa_note`
WHERE `kd_po_jasa` IN (
  'PJASA0209260001',
  'PJASA0209260002',
  'PJASA0209260003',
  'PJASA0209260004',
  'PJASA0209260005'
);

DELETE FROM `tbpo_jasa_request_detail`
WHERE `kd_po_jasa` IN (
  'PJASA0209260001',
  'PJASA0209260002',
  'PJASA0209260003',
  'PJASA0209260004',
  'PJASA0209260005'
);

DELETE FROM `tbpo_jasa_request`
WHERE `kd_po_jasa` IN (
  'PJASA0209260001',
  'PJASA0209260002',
  'PJASA0209260003',
  'PJASA0209260004',
  'PJASA0209260005'
);

INSERT INTO `tbpo_jasa_vendor`
  (`kd_vendor_jasa`, `nama_vendor`, `kategori_jasa`, `nama_pic`, `no_telpon`, `email`, `alamat_vendor`, `npwp`, `status_vendor`, `created_by`)
VALUES
  ('VJ0001', '[DUMMY] Hostinger Indonesia', 'IT & Hosting', 'Customer Success Hostinger', '021-30000001', 'billing@hostinger.example', 'Jakarta', '00.000.000.0-000.001', 'AKTIF', 'SYSTEM'),
  ('VJ0002', '[DUMMY] Paramita Ban Service', 'Kendaraan', 'Bapak Andi', '081200000002', 'paramitaban@example.com', 'Bekasi', '00.000.000.0-000.002', 'AKTIF', 'SYSTEM'),
  ('VJ0003', '[DUMMY] Wahyu CCTV Maintenance', 'IT & CCTV', 'Bapak Wahyu', '081200000003', 'wahyucctv@example.com', 'Bogor', '00.000.000.0-000.003', 'AKTIF', 'SYSTEM'),
  ('VJ0004', '[DUMMY] Udy Teknik Genset', 'Maintenance Mesin', 'Bapak Udy', '081200000004', 'udyteknik@example.com', 'Tangerang', '00.000.000.0-000.004', 'AKTIF', 'SYSTEM'),
  ('VJ0005', '[DUMMY] Untung Bangun Renovasi', 'Bangunan', 'Bapak Untung', '081200000005', 'untungbangun@example.com', 'Karawang', '00.000.000.0-000.005', 'AKTIF', 'SYSTEM')
ON DUPLICATE KEY UPDATE
  `nama_vendor` = VALUES(`nama_vendor`),
  `kategori_jasa` = VALUES(`kategori_jasa`),
  `nama_pic` = VALUES(`nama_pic`),
  `no_telpon` = VALUES(`no_telpon`),
  `email` = VALUES(`email`),
  `alamat_vendor` = VALUES(`alamat_vendor`),
  `npwp` = VALUES(`npwp`),
  `status_vendor` = VALUES(`status_vendor`),
  `updated_by` = 'SYSTEM';

INSERT INTO `tbpo_jasa_request`
  (`kd_po_jasa`, `no_spk`, `kd_vendor_jasa`, `kd_user`, `nm_user`, `departemen`, `tgl_request`, `tgl_target`, `lokasi_pekerjaan`, `tujuan_pekerjaan`, `estimasi_total`, `status`, `acc_with_kadep`, `acc_at_kadep`, `acc_with_direktur`, `acc_at_direktur`, `generated_by`, `generated_at`)
VALUES
  ('PJASA0209260001', NULL, 'VJ0001', 'USRGA01', 'Dummy Requester GA', 'GA', '2026-09-02', '2026-09-07', 'Kantor Pusat', 'Perpanjangan layanan hosting aplikasi internal', 3620376.00, 'ON PROGRESS', NULL, NULL, NULL, NULL, NULL, NULL),
  ('PJASA0209260002', NULL, 'VJ0002', 'USRGA02', 'Dummy Requester Kendaraan', 'GA', '2026-09-02', '2026-09-04', 'Pool Kendaraan', 'Balancing roda kendaraan operasional', 110000.00, 'ACC-KADEP', 'KADEP05', '2026-09-02 10:15:00', NULL, NULL, NULL, NULL),
  ('PJASA0209260003', NULL, 'VJ0003', 'USRIT01', 'Dummy Requester IT', 'IT', '2026-09-02', '2026-09-10', 'Gudang Utama', 'Maintenance CCTV dan pengecekan jaringan monitoring', 3250000.00, 'ACC DIREKTUR', 'KADEP10', '2026-09-02 10:20:00', 'DIR001', '2026-09-02 10:45:00', NULL, NULL),
  ('PJASA0209260004', 'SPKJ0209260001', 'VJ0004', 'USRGA03', 'Dummy Requester Genset', 'GA', '2026-09-02', '2026-09-12', 'Ruang Genset', 'Service genset dan pengecekan panel beban', 40600000.00, 'SPK TERBIT', 'KADEP05', '2026-09-02 09:30:00', 'DIR001', '2026-09-02 09:45:00', 'PURCH01', '2026-09-02 11:00:00'),
  ('PJASA0209260005', NULL, 'VJ0005', 'USRGA04', 'Dummy Requester Renovasi', 'GA', '2026-09-02', '2026-09-20', 'Area Pagar BRC', 'Pengecatan pagar dan dinding pembatas', 24980000.00, 'REJECT', 'KADEP05', '2026-09-02 11:10:00', NULL, NULL, NULL, NULL);

INSERT INTO `tbpo_jasa_request_detail`
  (`kd_po_jasa`, `nama_pekerjaan`, `deskripsi`, `qty`, `satuan`, `hrg_satuan`, `total_harga`)
VALUES
  ('PJASA0209260001', 'Cloud Hosting Startup', 'Paket hosting aplikasi internal selama 1 tahun', 1.00, 'Tahun', 3620376.00, 3620376.00),
  ('PJASA0209260002', 'Balancing Roda Depan', 'Balancing dua roda depan kendaraan operasional', 2.00, 'Roda', 55000.00, 110000.00),
  ('PJASA0209260003', 'Maintenance CCTV', 'Pengecekan kamera, DVR, kabel, dan koneksi monitoring', 1.00, 'Lot', 2250000.00, 2250000.00),
  ('PJASA0209260003', 'Perapihan Jaringan', 'Perapihan kabel dan testing koneksi area gudang', 1.00, 'Lot', 1000000.00, 1000000.00),
  ('PJASA0209260004', 'Service Genset', 'Service besar genset dan penggantian consumable', 1.00, 'Lot', 40000000.00, 40000000.00),
  ('PJASA0209260004', 'Pengecekan Panel', 'Pengecekan panel beban dan simulasi operasional', 1.00, 'Lot', 600000.00, 600000.00),
  ('PJASA0209260005', 'Pengecatan Pagar BRC', 'Pengecatan area pagar luar', 1.00, 'Lot', 18000000.00, 18000000.00),
  ('PJASA0209260005', 'Pengecatan Dinding Pembatas', 'Pengecatan dinding pembatas dan finishing', 1.00, 'Lot', 6980000.00, 6980000.00);

INSERT INTO `tbpo_jasa_note`
  (`kd_po_jasa`, `isi_note`, `kd_user`, `nama_user`, `aksi_status`, `create_at`)
VALUES
  ('PJASA0209260001', 'Request Pekerjaan Jasa Baru - dummy hosting', 'USRGA01', 'Dummy Requester GA', 'ON PROGRESS', '2026-09-02 09:00:00'),
  ('PJASA0209260002', 'Request Pekerjaan Jasa Baru - dummy balancing roda', 'USRGA02', 'Dummy Requester Kendaraan', 'ON PROGRESS', '2026-09-02 09:10:00'),
  ('PJASA0209260002', 'PO Jasa ACCEPT KADEP', 'KADEP05', 'Dummy KADEP GA', 'ACC-KADEP', '2026-09-02 10:15:00'),
  ('PJASA0209260003', 'Request Pekerjaan Jasa Baru - dummy maintenance CCTV', 'USRIT01', 'Dummy Requester IT', 'ON PROGRESS', '2026-09-02 09:15:00'),
  ('PJASA0209260003', 'PO Jasa ACCEPT KADEP', 'KADEP10', 'Dummy KADEP IT', 'ACC-KADEP', '2026-09-02 10:20:00'),
  ('PJASA0209260003', 'PO Jasa ACCEPT DIREKTUR', 'DIR001', 'Dummy Direktur', 'ACC DIREKTUR', '2026-09-02 10:45:00'),
  ('PJASA0209260004', 'Request Pekerjaan Jasa Baru - dummy service genset', 'USRGA03', 'Dummy Requester Genset', 'ON PROGRESS', '2026-09-02 09:20:00'),
  ('PJASA0209260004', 'PO Jasa ACCEPT KADEP', 'KADEP05', 'Dummy KADEP GA', 'ACC-KADEP', '2026-09-02 09:30:00'),
  ('PJASA0209260004', 'PO Jasa ACCEPT DIREKTUR', 'DIR001', 'Dummy Direktur', 'ACC DIREKTUR', '2026-09-02 09:45:00'),
  ('PJASA0209260004', 'PO/SPK Jasa Terbit: SPKJ0209260001', 'PURCH01', 'Dummy Purchasing', 'SPK TERBIT', '2026-09-02 11:00:00'),
  ('PJASA0209260005', 'Request Pekerjaan Jasa Baru - dummy pengecatan pagar', 'USRGA04', 'Dummy Requester Renovasi', 'ON PROGRESS', '2026-09-02 09:25:00'),
  ('PJASA0209260005', 'PO Jasa REJECT - biaya perlu dilakukan pembanding vendor terlebih dahulu', 'KADEP05', 'Dummy KADEP GA', 'REJECT', '2026-09-02 11:10:00');

COMMIT;
