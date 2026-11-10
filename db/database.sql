
CREATE DATABASE IF NOT EXISTS jadwal_guru;
USE jadwal_guru;

CREATE TABLE guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);

CREATE TABLE kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(10) NOT NULL
);

CREATE TABLE mapel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_mapel VARCHAR(100) NOT NULL
);

CREATE TABLE jadwal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guru_id INT,
    kelas_id INT,
    mapel_id INT,
    hari VARCHAR(10),
    jam_ke VARCHAR(10),
    FOREIGN KEY (guru_id) REFERENCES guru(id),
    FOREIGN KEY (kelas_id) REFERENCES kelas(id),
    FOREIGN KEY (mapel_id) REFERENCES mapel(id)
);

CREATE TABLE absen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guru_id INT,
    tanggal DATE,
    jam_ke VARCHAR(10),
    pengganti_id INT,
    FOREIGN KEY (guru_id) REFERENCES guru(id),
    FOREIGN KEY (pengganti_id) REFERENCES guru(id)
);

