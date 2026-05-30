CREATE TABLE IF NOT EXISTS tbpo_formula (
    id_formula INT AUTO_INCREMENT PRIMARY KEY,
    kode_formula VARCHAR(50) NOT NULL UNIQUE,
    nama_formula VARCHAR(150) NOT NULL,
    deskripsi TEXT NULL,
    formula_expression TEXT NOT NULL,
    output_label VARCHAR(100) NOT NULL,
    output_unit VARCHAR(50) NULL,
    rounding_mode ENUM('none','round','ceil','floor') DEFAULT 'none',
    decimal_place INT DEFAULT 2,
    status TINYINT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tbpo_formula_variable (
    id_variable INT AUTO_INCREMENT PRIMARY KEY,
    id_formula INT NOT NULL,
    variable_key VARCHAR(100) NOT NULL,
    variable_label VARCHAR(150) NOT NULL,
    input_type ENUM('number','decimal','currency') DEFAULT 'decimal',
    unit VARCHAR(50) NULL,
    default_value DECIMAL(20,6) NULL,
    is_required TINYINT DEFAULT 1,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_formula) REFERENCES tbpo_formula(id_formula)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tbpo_formula_result (
    id_result INT AUTO_INCREMENT PRIMARY KEY,
    id_po_detail INT NULL,
    id_formula INT NOT NULL,
    input_json JSON NOT NULL,
    formula_expression TEXT NOT NULL,
    result_value DECIMAL(20,6) NOT NULL,
    result_label VARCHAR(100) NULL,
    result_unit VARCHAR(50) NULL,
    created_by VARCHAR(100) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_formula) REFERENCES tbpo_formula(id_formula)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tbpo_barang_packaging (
    id_packaging INT AUTO_INCREMENT PRIMARY KEY,
    id_barang INT NOT NULL,
    isi_kemasan DECIMAL(20,6) NULL,
    satuan_kemasan VARCHAR(20) NULL,
    isi_per_dos DECIMAL(20,6) NULL,
    isi_per_inner DECIMAL(20,6) NULL,
    inner_per_dos DECIMAL(20,6) NULL,
    satuan_dasar VARCHAR(20) NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO tbpo_formula (kode_formula, nama_formula, deskripsi, formula_expression, output_label, output_unit, rounding_mode, decimal_place, status) VALUES
('HARGA_SATUAN', 'Harga Per Satuan Terkecil', NULL, 'harga_per_box / isi_per_dos', 'Harga Satuan', 'Rupiah', 'none', 2, 1),
('HARGA_KEMASAN_DARI_KG_LITER', 'Harga botol dari harga Kg/Liter', NULL, 'harga_per_kg_liter * isi_kemasan / 1000', 'Harga Per Kemasan', 'Rupiah', 'none', 2, 1),
('TOTAL_DOS_TANPA_INNER', 'Total Liter/Kg menjadi dos tanpa inner', NULL, 'total_liter_kg * 1000 / isi_kemasan / isi_per_dos', 'Jumlah Dos', 'Dos', 'none', 2, 1),
('TOTAL_DOS_DENGAN_INNER', 'Total Liter/Kg menjadi dos dengan inner', NULL, 'total_liter_kg * 1000 / isi_kemasan / isi_per_inner / inner_per_dos', 'Jumlah Dos', 'Dos', 'none', 2, 1),
('ISI_DOS_TANPA_INNER', 'Isi 1 dos dalam Liter/Kg tanpa inner', NULL, 'isi_per_dos * isi_kemasan / 1000', 'Isi Per Dos', 'L/Kg', 'none', 2, 1),
('ISI_DOS_DENGAN_INNER', 'Isi 1 dos dalam Liter/Kg dengan inner', NULL, 'isi_per_inner * inner_per_dos * isi_kemasan / 1000', 'Isi Per Dos', 'L/Kg', 'none', 2, 1);

INSERT INTO tbpo_formula_variable (id_formula, variable_key, variable_label, input_type, unit, default_value, is_required, sort_order)
SELECT f.id_formula, v.variable_key, v.variable_label, v.input_type, v.unit, NULL, 1, v.sort_order
FROM tbpo_formula f
JOIN (
    SELECT 'HARGA_SATUAN' kode_formula, 'harga_per_box' variable_key, 'Harga Per Box' variable_label, 'currency' input_type, 'Rupiah' unit, 1 sort_order
    UNION ALL SELECT 'HARGA_SATUAN', 'isi_per_dos', 'Isi Per Dos', 'decimal', 'pcs', 2
    UNION ALL SELECT 'HARGA_KEMASAN_DARI_KG_LITER', 'harga_per_kg_liter', 'Harga Per Kg/Liter', 'currency', 'Rupiah', 1
    UNION ALL SELECT 'HARGA_KEMASAN_DARI_KG_LITER', 'isi_kemasan', 'Isi Kemasan', 'decimal', 'ml/gr', 2
    UNION ALL SELECT 'TOTAL_DOS_TANPA_INNER', 'total_liter_kg', 'Total Liter/Kg', 'decimal', 'L/Kg', 1
    UNION ALL SELECT 'TOTAL_DOS_TANPA_INNER', 'isi_kemasan', 'Isi Kemasan', 'decimal', 'ml/gr', 2
    UNION ALL SELECT 'TOTAL_DOS_TANPA_INNER', 'isi_per_dos', 'Isi Per Dos', 'decimal', 'pcs', 3
    UNION ALL SELECT 'TOTAL_DOS_DENGAN_INNER', 'total_liter_kg', 'Total Liter/Kg', 'decimal', 'L/Kg', 1
    UNION ALL SELECT 'TOTAL_DOS_DENGAN_INNER', 'isi_kemasan', 'Isi Kemasan', 'decimal', 'ml/gr', 2
    UNION ALL SELECT 'TOTAL_DOS_DENGAN_INNER', 'isi_per_inner', 'Isi Per Inner', 'decimal', 'pcs', 3
    UNION ALL SELECT 'TOTAL_DOS_DENGAN_INNER', 'inner_per_dos', 'Inner Per Dos', 'decimal', 'inner', 4
    UNION ALL SELECT 'ISI_DOS_TANPA_INNER', 'isi_per_dos', 'Isi Per Dos', 'decimal', 'pcs', 1
    UNION ALL SELECT 'ISI_DOS_TANPA_INNER', 'isi_kemasan', 'Isi Kemasan', 'decimal', 'ml/gr', 2
    UNION ALL SELECT 'ISI_DOS_DENGAN_INNER', 'isi_per_inner', 'Isi Per Inner', 'decimal', 'pcs', 1
    UNION ALL SELECT 'ISI_DOS_DENGAN_INNER', 'inner_per_dos', 'Inner Per Dos', 'decimal', 'inner', 2
    UNION ALL SELECT 'ISI_DOS_DENGAN_INNER', 'isi_kemasan', 'Isi Kemasan', 'decimal', 'ml/gr', 3
) v ON v.kode_formula = f.kode_formula
WHERE NOT EXISTS (
    SELECT 1
    FROM tbpo_formula_variable existing
    WHERE existing.id_formula = f.id_formula
      AND existing.variable_key = v.variable_key
);
