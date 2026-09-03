-- Admin full access dan module User Management
-- Username: admin
-- Password default: admin123

INSERT INTO tbpo_user
    (kode_user, nama_user, username, password, aksess_lv, departement)
SELECT
    'KIUADMIN',
    'Admin Full Access',
    'admin',
    '$2y$10$jhqW2XSbkW7dyNaNV55IIugylitCJ4kM1u24u9TkLHNv1okOkg/GG',
    1,
    'ADMIN'
WHERE NOT EXISTS (
    SELECT 1 FROM tbpo_user WHERE username = 'admin'
);

UPDATE tbpo_user
SET
    kode_user = 'KIUADMIN',
    nama_user = 'Admin Full Access',
    password = '$2y$10$jhqW2XSbkW7dyNaNV55IIugylitCJ4kM1u24u9TkLHNv1okOkg/GG',
    aksess_lv = 1,
    departement = 'ADMIN'
WHERE username = 'admin';
