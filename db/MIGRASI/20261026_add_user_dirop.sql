-- Add the DIROP account for the all-department PO status view.
-- Password is stored as PASSWORD_DEFAULT hash for password_verify().
INSERT INTO tb_user (kode_user, nama_user, username, password, aksess_lv, departement)
VALUES ('DIROP', 'Direktorat Operasional', 'dirop', '$2y$10$Q8O25Hu9DP.yYhFIHfmwM.ofcet9WkHKy4MOJZOWbIsVkvMJ2mdga', 5, 'DIREKTORAT OPERASIONAL');
