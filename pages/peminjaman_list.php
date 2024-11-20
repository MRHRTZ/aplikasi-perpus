<?php
include '../koneksi.php';

$query = "SELECT p.id_peminjaman, u.nama, u.alamat, u.no_telp, b.id_buku, b.judul_buku, b.penerbit, p.tanggal_pinjam, p.tanggal_kembali
    FROM peminjaman p 
    LEFT JOIN buku b ON p.id_buku = b.id_buku 
    LEFT JOIN pengguna u ON p.id_pengguna = u.id_pengguna";
$result = mysqli_query($conn, $query);
?>

<h1>Daftar Peminjaman</h1>
<div style="margin-bottom: 20px;">
    <a href="peminjaman_tambah.php">Tambah Peminjaman</a>
</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Judul Buku</th>
            <th>Penerbit</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id_peminjaman']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['no_telp']; ?></td>
                <td><?php echo $row['judul_buku']; ?></td>
                <td><?php echo $row['penerbit']; ?></td>
                <td><?php echo $row['tanggal_pinjam']; ?></td>
                <td><?php echo $row['tanggal_kembali']; ?></td>
                <td>
                    <a href="peminjaman_edit.php?id=<?= $row['id_peminjaman']; ?>" >Edit</a>
                    <a href="peminjaman_hapus.php?id=<?= $row['id_peminjaman']; ?>&id_buku=<?= $row['id_buku']; ?>">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
mysqli_close($conn);
?>