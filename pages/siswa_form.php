<?php
include 'header.php';
include '../config/koneksi.php';

$edit = false;
$data = ['id_siswa'=>'', 'nis'=>'', 'nama_siswa'=>'', 'kelas'=>'', 'no_hp'=>''];

if (isset($_GET['id'])) {
    $edit = true;
    $id = $_GET['id'];
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswas WHERE id_siswa='$id'"));
}
?>
<h1><?= $edit ? 'Edit' : 'Tambah' ?> Siswa</h1>

<form method="POST" action="siswa_simpan.php" class="form">
    <input type="hidden" name="id_siswa" value="<?= $data['id_siswa'] ?>">
    <label>NIS</label>
    <input type="text" name="nis" value="<?= $data['nis'] ?>" required>
    <label>Nama Siswa</label>
    <input type="text" name="nama_siswa" value="<?= $data['nama_siswa'] ?>" required>
    <label>Kelas</label>
    <input type="text" name="kelas" value="<?= $data['kelas'] ?>" required>
    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>">
    <button type="submit" class="btn-primary">Simpan</button>
    <a href="siswa.php" class="btn-secondary">Batal</a>
</form>

<?php include 'footer.php'; ?>