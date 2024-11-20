<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
    $result = mysqli_query($conn, $query);
    $peminjaman = mysqli_fetch_assoc($result);

    $query_pengguna = "SELECT * FROM pengguna WHERE peran = 'anggota'";
    $pengguna = mysqli_query($conn, $query_pengguna);

    $query_buku = "SELECT * FROM buku";
    $buku = mysqli_query($conn, $query_buku);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $id_pengguna = $_POST['id_pengguna'];
    $id_buku = $_POST['id_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $query_pinjam = "SELECT * FROM peminjaman WHERE id_peminjaman = $id";
    $pinjam_query = mysqli_query($conn, $query_pinjam);
    $pinjam = mysqli_fetch_assoc($pinjam_query);

    // Jika pinjam beda buku
    if ($pinjam['id_buku'] != $id_buku) {
        $id_buku_lama = $pinjam['id_buku'];
        $id_buku_baru = $id_buku;

        $query_update_buku_lama = "UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id_buku = $id_buku_lama";
        mysqli_query($conn, $query_update_buku_lama);

        $query_update_buku_baru = "UPDATE buku SET jumlah_buku = jumlah_buku - 1 WHERE id_buku = $id_buku_baru";
        mysqli_query($conn, $query_update_buku_baru);
    }

    $query = "UPDATE peminjaman SET id_pengguna=?, id_buku=?, tanggal_pinjam=?, tanggal_kembali=? WHERE id_peminjaman=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'iissi', $id_pengguna, $id_buku, $tanggal_pinjam, $tanggal_kembali, $id);

    if (mysqli_stmt_execute($stmt)) {
        header('Location: peminjaman_list.php');
    } else {
        echo "<script>alert('Gagal update data: " . mysqli_error($conn) . "')</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<h2>Edit Peminjaman</h2>
<form method="POST" action="" autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $peminjaman['id_peminjaman']; ?>">
    <table>
        <tr>
            <td>Anggota:</td>
            <td>
                <select name="id_pengguna" required>
                    <?php while ($row = mysqli_fetch_assoc($pengguna)) : ?>
                        <option value="<?php echo $row['id_pengguna']; ?>" <?= $peminjaman['id_pengguna'] == $row['id_pengguna'] ? 'selected' : '' ?>><?php echo $row['nama']; ?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Buku:</td>
            <td>
                <select name="id_buku" required>
                    <?php while ($row = mysqli_fetch_assoc($buku)) : ?>
                        <option value="<?php echo $row['id_buku']; ?>" <?= $peminjaman['id_buku'] == $row['id_buku'] ? 'selected' : '' ?>><?php echo $row['judul_buku']; ?></option>
                    <?php endwhile; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tanggal Pinjam:</td>
            <td><input type="date" name="tanggal_pinjam" value="<?php echo $peminjaman['tanggal_pinjam']; ?>" required></td>
        </tr>
        <tr>
            <td>Tanggal Kembali:</td>
            <td><input type="date" name="tanggal_kembali" value="<?php echo $peminjaman['tanggal_kembali']; ?>" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="update">Update</button></td>
        </tr>
    </table>
</form>