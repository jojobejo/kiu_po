-- Reset existing tb_user accounts to password 'karisma'.
-- password must be a PHP PASSWORD_DEFAULT hash because Auth uses password_verify().
-- Generated for the checked local database on 2026-10-26; executing this file resets all current accounts.
UPDATE tb_user SET password = '$2y$10$U6T9ZNd/thFhR6aZXw8MZ.aK1pD3C4YLJb0e/ulxY3QUjiERBRBea';
