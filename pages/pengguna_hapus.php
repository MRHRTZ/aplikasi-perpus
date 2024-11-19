<?php
include '../koneksi.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    $id = $_GET['id'];

    $query = "DELETE FROM pengguna WHERE id_pengguna = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna.');</script>";
    }

    $stmt->close();
    $conn->close();

    header('Location: pengguna_list.php');
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        echo "<script>
        var result = confirm('Apakah Anda yakin ingin menghapus pengguna ini?');
        if (result) {
            window.open('pengguna_hapus.php?confirm=true&id=$id', '_self');
        } else {
            window.open('pengguna_list.php', '_self');
        }
        </script>";
    }
}
?>