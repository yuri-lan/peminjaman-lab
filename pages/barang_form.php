<?php
include 'header.php';
include '../config/koneksi.php';

$edit = false;
$data = ['id_barang'=>'', 'kode_barang'=>'', 'nama_barang'=>'', 'kategori'=>'', 'stok'=>'', 'kondisi'=>'baik'];

if (isset($_GET['id'])) {
    $edit = true;
    $id = $_GET['id'];
    $q = mysqli_query($koneksi, "SELECT * FROM barangs WHERE id_barang='$id'");
    $data = mysqli_fetch_assoc($q);
}
?>
<h1><?= $edit ? 'Edit' : 'Tambah' ?> Barang</h1>

<form method="POST" action="barang_simpan.php" class="form">
    <input type="hidden" name="id_barang" value="<?= $data['id_barang'] ?>">
    
    <label>Kode Barang</label>
    <input type="text" name="kode_barang" value="<?= $data['kode_barang'] ?>" required>
    
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" value="<?= $data['nama_barang'] ?>" required>
    
    <label>Kategori</label>
    <input type="text" name="kategori" value="<?= $data['kategori'] ?>">
    
    <label>Stok</label>
    <input type="number" name="stok" value="<?= $data['stok'] ?>" required>
    
    <label>Kondisi</label>
    <select name="kondisi">
        <option value="baik" <?= $data['kondisi']=='baik'?'selected':'' ?>>Baik</option>
        <option value="rusak" <?= $data['kondisi']=='rusak'?'selected':'' ?>>Rusak</option>
        <option value="perbaikan" <?= $data['kondisi']=='perbaikan'?'selected':'' ?>>Perbaikan</option>
    </select>
    
    <button type="submit" class="btn-primary">Simpan</button>
    <a href="barang.php" class="btn-secondary">Batal</a>
</form>

<?php include 'footer.php'; ?>