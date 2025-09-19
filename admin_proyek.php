<?php
include 'auth.php'; // Pengecek login
include 'koneksi.php';
$pesan = '';

// PROSES TAMBAH & UPDATE DATA
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $id = $_POST['id'];
    $gambar_nama = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    if (!empty($gambar_nama)) {
        $gambar_baru = time() . '_' . $gambar_nama;
        move_uploaded_file($gambar_tmp, 'uploads/' . $gambar_baru);
        if(!empty($id)){
            $q_gambar_lama = mysqli_query($koneksi, "SELECT gambar FROM proyek WHERE id='$id'");
            $data_gambar_lama = mysqli_fetch_array($q_gambar_lama);
            if(file_exists('uploads/'.$data_gambar_lama['gambar'])) { unlink('uploads/'.$data_gambar_lama['gambar']); }
        }
    } else {
        $q_gambar_lama = mysqli_query($koneksi, "SELECT gambar FROM proyek WHERE id='$id'");
        $data_gambar_lama = mysqli_fetch_array($q_gambar_lama);
        $gambar_baru = $data_gambar_lama['gambar'];
    }
    if (empty($id)) {
        $query = "INSERT INTO proyek (judul, deskripsi, gambar) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sss", $judul, $deskripsi, $gambar_baru);
        $pesan = "Data proyek baru berhasil ditambahkan.";
    } else {
        $query = "UPDATE proyek SET judul=?, deskripsi=?, gambar=? WHERE id=?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "sssi", $judul, $deskripsi, $gambar_baru, $id);
        $pesan = "Data proyek berhasil diperbarui.";
    }
    mysqli_stmt_execute($stmt);
}
// PROSES HAPUS DATA
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $q_gambar = mysqli_query($koneksi, "SELECT gambar FROM proyek WHERE id='$id'");
    $data_gambar = mysqli_fetch_array($q_gambar);
    if(file_exists('uploads/'.$data_gambar['gambar'])) { unlink('uploads/'.$data_gambar['gambar']); }
    $query = "DELETE FROM proyek WHERE id=?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $pesan = "Data proyek berhasil dihapus.";
}
// Ambil data untuk diedit
$edit_data = ['id' => '', 'judul' => '', 'deskripsi' => ''];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q_edit = mysqli_query($koneksi, "SELECT * FROM proyek WHERE id='$id'");
    $edit_data = mysqli_fetch_assoc($q_edit);
}
$semua_proyek = mysqli_query($koneksi, "SELECT * FROM proyek ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Kelola Proyek</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="header-nav">
        <h1>Kelola Proyek Unggulan</h1>
        <div>
            <a href="admin.php">&larr; Kembali ke Admin Utama</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
    <div class="admin-wrapper">
        <?php if (!empty($pesan)): ?><div class="sukses"><?= htmlspecialchars($pesan) ?></div><?php endif; ?>
        <form method="POST" action="admin_proyek.php" enctype="multipart/form-data">
            <h2><?= empty($edit_data['id']) ? 'Tambah Proyek Baru' : 'Edit Proyek' ?></h2>
            <input type="hidden" name="id" value="<?= htmlspecialchars($edit_data['id']) ?>">
            <label>Judul Proyek</label>
            <input type="text" name="judul" value="<?= htmlspecialchars($edit_data['judul']) ?>" required>
            <label>Deskripsi</label>
            <textarea name="deskripsi" required><?= htmlspecialchars($edit_data['deskripsi']) ?></textarea>
            <label>Gambar</label>
            <input type="file" name="gambar" accept="image/*">
            <button type="submit" name="simpan">Simpan Proyek</button>
        </form>
        <h2>Daftar Proyek Saat Ini</h2>
        <table>
            <thead><tr><th>Gambar</th><th>Judul</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while($proyek = mysqli_fetch_array($semua_proyek)): ?>
                <tr>
                    <td><img src="uploads/<?= htmlspecialchars($proyek['gambar']) ?>" alt="" class="gambar-kecil"></td>
                    <td><?= htmlspecialchars($proyek['judul']) ?></td>
                    <td>
                        <a href="admin_proyek.php?edit=<?= $proyek['id'] ?>">Edit</a> | 
                        <a href="admin_proyek.php?hapus=<?= $proyek['id'] ?>" onclick="return confirm('Yakin ingin menghapus proyek ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>