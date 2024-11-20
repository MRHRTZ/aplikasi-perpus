<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM buku WHERE id_buku = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $jumlah_buku = $_POST['jumlah_buku'];

    $query = "UPDATE buku SET judul_buku=?, pengarang=?, penerbit=?, tahun_terbit=?, jumlah_buku=? WHERE id_buku=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssii', $judul_buku, $pengarang, $penerbit, $tahun_terbit, $jumlah_buku, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: buku_list.php');
    } else {
        echo "<script>alert('Gagal update data: " . mysqli_error($conn) . "')</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<h2>Edit Buku</h2>
<form method="POST" action="" autocomplete="off">
    <input type="hidden" name="id" value="<?php echo $user['id_buku']; ?>">
    <table>
        <tr>
            <td>Judul Buku:</td>
            <td><input type="text" name="judul_buku" value="<?php echo $user['judul_buku']; ?>" required></td>
        </tr>
        <tr>
            <td>Pengarang:</td>
            <td><input type="text" name="pengarang" value="<?php echo $user['pengarang']; ?>" required></td>
        </tr>
        <tr>
            <td>Penerbit:</td>
            <td><input type="text" name="penerbit" value="<?php echo $user['penerbit']; ?>" required></td>
        </tr>
        <tr>
            <td>Tahun Terbit</td>
            <td><input type="number" name="tahun_terbit" value="<?php echo $user['tahun_terbit']; ?>" required></td>
        </tr>
        <tr>
            <td>Jumlah Buku:</td>
            <td><input type="number" name="jumlah_buku" value="<?php echo $user['jumlah_buku']; ?>" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="update">Update</button></td>
        </tr>
    </table>
</form>