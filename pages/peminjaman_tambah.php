<?php
include '../koneksi.php';

$query_pengguna = "SELECT * FROM pengguna WHERE peran = 'anggota'";
$pengguna = mysqli_query($conn, $query_pengguna);

$query_buku = "SELECT * FROM buku";
$buku = mysqli_query($conn, $query_buku);

if (isset($_POST['simpan'])) {
    $id_pengguna = $_POST['id_pengguna'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query_buku_pinjam = "SELECT * FROM buku WHERE id_buku = $id_buku";
    $buku_pinjam_query = mysqli_query($conn, $query_buku_pinjam);
    $buku_pinjam = mysqli_fetch_assoc($buku_pinjam_query);

    if ($buku_pinjam['jumlah_buku'] == 0) {
        echo "<script>alert('Stok buku habis.')</script>";
        exit;
    } else {
        $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id_buku = $id_buku";
        mysqli_query($conn, $query_update_buku);
    }

    $query = "INSERT INTO peminjaman (id_pengguna, id_buku, tanggal_pinjam, tanggal_kembali) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iiss", $id_pengguna, $id_buku, $tanggal_pinjam, $tanggal_kembali);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: peminjaman_list.php');
    } else {
        echo "<script>alert('Gagal tambah data: " . mysqli_error($conn) . "')</script>";
    }

    mysqli_stmt_close($stmt);
}
?>

<h2>Tambah Peminjaman</h2>
<form method="POST" action="" autocomplete="off">
    <table>
        <tr>
            <td>Anggota:</td>
            <td>
                <select name="id_pengguna" required>
                    <?php while ($row = mysqli_fetch_assoc($pengguna)) : ?>
                        <option value="<?php echo $row['id_pengguna']; ?>"><?php echo $row['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Buku:</td>
            <td>
                <select name="id_buku" required>
                    <?php while ($row = mysqli_fetch_assoc($buku)) : ?>
                        <option value="<?php echo $row['id_buku']; ?>"><?php echo $row['judul_buku']; ?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Pinjam:</td>
            <td><input type="date" name="tanggal_pinjam" value="" required></td>
        </tr>
        <tr>
            <td>Tanggal Kembali:</td>
            <td><input type="date" name="tanggal_kembali" value="" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="simpan">Simpan</button></td>
        </tr>
    </table>
</form>