<?php
include '../koneksi.php';

$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<h1>Daftar Buku</h1>
<div style="margin-bottom: 20px;">
    <a href="buku_tambah.php">Tambah Buku</a>
</div>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Jumlah Buku</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id_buku']; ?></td>
                <td><?php echo $row['judul_buku']; ?></td>
                <td><?php echo $row['pengarang']; ?></td>
                <td><?php echo $row['penerbit']; ?></td>
                <td><?php echo $row['tahun_terbit']; ?></td>
                <td><?php echo $row['jumlah_buku']; ?></td>
                <td>
                    <a href="buku_edit.php?id=<?php echo $row['id_buku']; ?>" >Edit</a>
                    <a href="buku_hapus.php?id=<?php echo $row['id_buku']; ?>">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
mysqli_close($conn);
?>