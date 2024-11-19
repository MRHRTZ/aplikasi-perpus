CREATE TABLE buku(
    id_buku INT PRIMARY KEY AUTO_INCREMENT,
    judul_buku VARCHAR(100),
    pengarang VARCHAR(100),
    penerbit VARCHAR(100),
    tahun_terbit INT,
    jumlah_buku INT
);

CREATE TABLE pengguna(
    id_pengguna INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    username VARCHAR(100),
    password VARCHAR(100),
    alamat VARCHAR(100),
    peran ENUM('petugas', 'anggota'),
    no_telp VARCHAR(100)
);

CREATE TABLE peminjaman(
    id_peminjaman INT PRIMARY KEY AUTO_INCREMENT,
    id_pengguna INT,
    id_buku INT,
    tanggal_pinjam DATE,
    tanggal_kembali DATE,
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna),
    FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
);


INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit, jumlah_buku) VALUES
('Pemrograman Python', 'Guido van Rossum', "O'Reilly Media", 2010, 5),
('Belajar SQL', 'John Doe', 'Packt Publishing', 2015, 3),
('Algoritma dan Struktur Data', 'Jane Smith', 'Addison-Wesley', 2018, 7);

INSERT INTO pengguna (username, nama, password, alamat, peran, no_telp) VALUES
('petugas1', 'Petugas 1', MD5('petugas1'), 'Jl. Merdeka No. 1', 'petugas', '081234567890'),
('charlie', 'Charlie', MD5('charlie'), 'Jl. Thamrin No. 3', 'anggota', '081234567892');

INSERT INTO peminjaman (id_pengguna, id_buku, tanggal_pinjam, tanggal_kembali) VALUES
(2, 1, '2023-01-01', '2023-01-10'),
(2, 2, '2023-01-05', '2023-01-15'),
(2, 3, '2023-01-10', '2023-01-20');