<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM pengguna WHERE id_pengguna = $id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $peran = $_POST['peran'];
    $no_telp = $_POST['no_telp'];

    $password = md5($password);
    $query = "INSERT INTO pengguna (nama, username, password, alamat, peran, no_telp) VALUES ('$nama', '$username', '$password', '$alamat', '$peran', '$no_telp')";
    if (mysqli_query($conn, $query)) {
        header('Location: pengguna_list.php');
    } else {
        echo "<script>alert('Gagal tambah data: " . mysqli_error($conn) . "')</script>";
    }
}
?>

<h2>Tambah Pengguna</h2>
<form method="POST" action="" autocomplete="off">
    <table>
        <tr>
            <td>Nama:</td>
            <td><input type="text" name="nama" value="" required></td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" value="" required></td>
        </tr>
        <tr>
            <td>Password:</td>
            <td><input type="password" name="password" value="" required></td>
        </tr>
        <tr>
            <td>Alamat:</td>
            <td><input type="text" name="alamat" value="" required></td>
        </tr>
        <tr>
            <td>Peran:</td>
            <td>
                <select name="peran" required>
                    <option value="petugas">Petugas</option>
                    <option value="anggota">Anggota</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Telepon:</td>
            <td><input type="number" name="no_telp" value="" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="simpan">Simpan</button></td>
        </tr>
    </table>
</form>