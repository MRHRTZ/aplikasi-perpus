<?php
include '../koneksi.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
    $id = $_GET['id'];
    $id_buku = $_GET['id_buku'];

    $query_update_buku = "UPDATE buku SET jumlah_buku = jumlah_buku + 1 WHERE id_buku = $id_buku";
    mysqli_query($conn, $query_update_buku);

    $query = "DELETE FROM peminjaman WHERE id_peminjaman = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.');</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.');</script>";
    }

    $stmt->close();
    $conn->close();

    header('Location: peminjaman_list.php');
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $id_buku = $_GET['id_buku'];
    
        echo "<script>
        var result = confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');
        if (result) {
            window.open('peminjaman_hapus.php?confirm=true&id=$id&id_buku=$id_buku', '_self');
        } else {
            window.open('peminjaman_list.php', '_self');
        }
        </script>";
    }
}
?>