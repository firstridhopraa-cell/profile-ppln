<?php
include 'auth.php'; // Pengecek login
include 'koneksi.php';
$pesan_sukses = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $q_data_lama = mysqli_query($koneksi, "SELECT * FROM konten_halaman WHERE id=1");
    $data_lama = mysqli_fetch_array($q_data_lama);
    function handle_upload($file_input_name, $existing_filename) {
        if (!empty($_FILES[$file_input_name]['name'])) {
            $gambar_nama = time() . '_' . $_FILES[$file_input_name]['name'];
            move_uploaded_file($_FILES[$file_input_name]['tmp_name'], 'uploads/' . $gambar_nama);
            if (!empty($existing_filename) && file_exists('uploads/' . $existing_filename)) { unlink('uploads/' . $existing_filename); }
            return $gambar_nama;
        } return $existing_filename;
    }
    $_POST['hero_gambar1'] = handle_upload('hero_gambar1', $data_lama['hero_gambar1']);
    $_POST['hero_gambar2'] = handle_upload('hero_gambar2', $data_lama['hero_gambar2']);
    $query_update = "UPDATE konten_halaman SET visi=?, misi=?, tugas_pokok=?, nilai_akhlak=?, layanan_judul_1=?, layanan_deskripsi_1=?, layanan_judul_2=?, layanan_deskripsi_2=?, layanan_judul_3=?, layanan_deskripsi_3=?, layanan_judul_4=?, layanan_deskripsi_4=?, hero_judul1=?, hero_deskripsi1=?, hero_tombol1=?, hero_gambar1=?, hero_judul2=?, hero_deskripsi2=?, hero_tombol2=?, hero_gambar2=?, tentang_judul=?, tentang_subjudul=?, layanan_judul=?, layanan_subjudul=?, proyek_judul=?, proyek_subjudul=?, kontak_judul=?, kontak_subjudul=?, kontak_alamat=?, kontak_telepon=?, kontak_center=?, kontak_email=?, link_instagram=?, link_youtube=?, footer_deskripsi=?, footer_copyright=? WHERE id = 1";
    $stmt = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssss", $_POST['visi'], $_POST['misi'], $_POST['tugas_pokok'], $_POST['nilai_akhlak'], $_POST['layanan_judul_1'], $_POST['layanan_deskripsi_1'], $_POST['layanan_judul_2'], $_POST['layanan_deskripsi_2'], $_POST['layanan_judul_3'], $_POST['layanan_deskripsi_3'], $_POST['layanan_judul_4'], $_POST['layanan_deskripsi_4'], $_POST['hero_judul1'], $_POST['hero_deskripsi1'], $_POST['hero_tombol1'], $_POST['hero_gambar1'], $_POST['hero_judul2'], $_POST['hero_deskripsi2'], $_POST['hero_tombol2'], $_POST['hero_gambar2'], $_POST['tentang_judul'], $_POST['tentang_subjudul'], $_POST['layanan_judul'], $_POST['layanan_subjudul'], $_POST['proyek_judul'], $_POST['proyek_subjudul'], $_POST['kontak_judul'], $_POST['kontak_subjudul'], $_POST['kontak_alamat'], $_POST['kontak_telepon'], $_POST['kontak_center'], $_POST['kontak_email'], $_POST['link_instagram'], $_POST['link_youtube'], $_POST['footer_deskripsi'], $_POST['footer_copyright']);
    if (mysqli_stmt_execute($stmt)) { $pesan_sukses = "Data halaman utama berhasil diperbarui!"; }
    mysqli_stmt_close($stmt);
}
$result = mysqli_query($koneksi, "SELECT * FROM konten_halaman WHERE id = 1");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel Utama</title>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <div class="header-nav">
        <h1>Admin Panel Utama</h1>
        <div>
            <a href="admin_proyek.php">Kelola Proyek &rarr;</a>
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>
    <div class="admin-wrapper">
        <?php if ($pesan_sukses): ?><p class="sukses"><?php echo $pesan_sukses; ?></p><?php endif; ?>
        <form method="POST" action="admin.php" enctype="multipart/form-data">
            <h2>Bagian Hero</h2>
            <fieldset>
                <legend>Slide 1</legend>
                <label>Judul</label><input type="text" name="hero_judul1" value="<?= htmlspecialchars($data['hero_judul1']); ?>">
                <label>Deskripsi</label><textarea name="hero_deskripsi1"><?= htmlspecialchars($data['hero_deskripsi1']); ?></textarea>
                <label>Teks Tombol</label><input type="text" name="hero_tombol1" value="<?= htmlspecialchars($data['hero_tombol1']); ?>">
                <label>Gambar Latar (Kosongkan jika tidak ganti)</label><input type="file" name="hero_gambar1">
            </fieldset>
            <fieldset>
                <legend>Slide 2</legend>
                <label>Judul</label><input type="text" name="hero_judul2" value="<?= htmlspecialchars($data['hero_judul2']); ?>">
                <label>Deskripsi</label><textarea name="hero_deskripsi2"><?= htmlspecialchars($data['hero_deskripsi2']); ?></textarea>
                <label>Teks Tombol</label><input type="text" name="hero_tombol2" value="<?= htmlspecialchars($data['hero_tombol2']); ?>">
                <label>Gambar Latar (Kosongkan jika tidak ganti)</label><input type="file" name="hero_gambar2">
            </fieldset>

            <h2>Bagian "Tentang Kami"</h2>
            <fieldset>
                <legend>Judul & Konten</legend>
                <label>Judul Section</label><input type="text" name="tentang_judul" value="<?= htmlspecialchars($data['tentang_judul']); ?>">
                <label>Subjudul Section</label><textarea name="tentang_subjudul"><?= htmlspecialchars($data['tentang_subjudul']); ?></textarea>
                <label>Visi</label><textarea name="visi"><?= htmlspecialchars($data['visi']); ?></textarea>
                <label>Misi</label><textarea name="misi"><?= htmlspecialchars($data['misi']); ?></textarea>
                <label>Tugas Pokok UPT</label><textarea name="tugas_pokok"><?= htmlspecialchars($data['tugas_pokok']); ?></textarea>
                <label>Nilai Inti: AKHLAK</label><textarea name="nilai_akhlak"><?= htmlspecialchars($data['nilai_akhlak']); ?></textarea>
            </fieldset>

            <h2>Bagian "Layanan Transmisi"</h2>
            <fieldset>
                <legend>Judul & Konten</legend>
                 <label>Judul Section</label><input type="text" name="layanan_judul" value="<?= htmlspecialchars($data['layanan_judul']); ?>">
                <label>Subjudul Section</label><textarea name="layanan_subjudul"><?= htmlspecialchars($data['layanan_subjudul']); ?></textarea>
                <label>Layanan 1: Judul</label><input type="text" name="layanan_judul_1" value="<?= htmlspecialchars($data['layanan_judul_1']); ?>">
                <label>Layanan 1: Deskripsi</label><textarea name="layanan_deskripsi_1"><?= htmlspecialchars($data['layanan_deskripsi_1']); ?></textarea>
                <label>Layanan 2: Judul</label><input type="text" name="layanan_judul_2" value="<?= htmlspecialchars($data['layanan_judul_2']); ?>">
                <label>Layanan 2: Deskripsi</label><textarea name="layanan_deskripsi_2"><?= htmlspecialchars($data['layanan_deskripsi_2']); ?></textarea>
                <label>Layanan 3: Judul</label><input type="text" name="layanan_judul_3" value="<?= htmlspecialchars($data['layanan_judul_3']); ?>">
                <label>Layanan 3: Deskripsi</label><textarea name="layanan_deskripsi_3"><?= htmlspecialchars($data['layanan_deskripsi_3']); ?></textarea>
                <label>Layanan 4: Judul</label><input type="text" name="layanan_judul_4" value="<?= htmlspecialchars($data['layanan_judul_4']); ?>">
                <label>Layanan 4: Deskripsi</label><textarea name="layanan_deskripsi_4"><?= htmlspecialchars($data['layanan_deskripsi_4']); ?></textarea>
            </fieldset>
            
             <h2>Bagian "Proyek Unggulan"</h2>
            <fieldset>
                <legend>Judul Section</legend>
                <label>Judul Section</label><input type="text" name="proyek_judul" value="<?= htmlspecialchars($data['proyek_judul']); ?>">
                <label>Subjudul Section</label><textarea name="proyek_subjudul"><?= htmlspecialchars($data['proyek_subjudul']); ?></textarea>
            </fieldset>

            <h2>Bagian Kontak & Footer</h2>
            <fieldset>
                <legend>Judul & Konten</legend>
                <label>Judul Section</label><input type="text" name="kontak_judul" value="<?= htmlspecialchars($data['kontak_judul']); ?>">
                <label>Subjudul Section</label><textarea name="kontak_subjudul"><?= htmlspecialchars($data['kontak_subjudul']); ?></textarea>
                <label>Alamat</label><textarea name="kontak_alamat"><?= htmlspecialchars($data['kontak_alamat']); ?></textarea>
                <label>Telepon</label><input type="text" name="kontak_telepon" value="<?= htmlspecialchars($data['kontak_telepon']); ?>">
                <label>Contact Center</label><input type="text" name="kontak_center" value="<?= htmlspecialchars($data['kontak_center']); ?>">
                <label>Email</label><input type="text" name="kontak_email" value="<?= htmlspecialchars($data['kontak_email']); ?>">
                <label>Link Instagram</label><input type="text" name="link_instagram" value="<?= htmlspecialchars($data['link_instagram']); ?>">
                <label>Link YouTube</label><input type="text" name="link_youtube" value="<?= htmlspecialchars($data['link_youtube']); ?>">
                <label>Deskripsi Footer</label><textarea name="footer_deskripsi"><?= htmlspecialchars($data['footer_deskripsi']); ?></textarea>
                <label>Copyright Footer</label><input type="text" name="footer_copyright" value="<?= htmlspecialchars($data['footer_copyright']); ?>">
            </fieldset>
            <button type="submit">SIMPAN SEMUA PERUBAHAN</button>
        </form>
    </div>
</body>
</html>