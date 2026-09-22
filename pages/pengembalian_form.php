<?php
include 'header.php';
include '../config/koneksi.php';

$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT p.*, s.nama_siswa FROM peminjamans p 
                                               JOIN siswas s ON p.id_siswa=s.id_siswa 
                                               WHERE p.id_pinjam='$id'"));

// Hitung denda: Rp 2000/hari keterlambatan
$jatuh_tempo = strtotime($p['tanggal_kembali']);
$hari_ini = strtotime(date('Y-m-d'));
$denda = 0;
if ($hari_ini > $jatuh_tempo) {
    $telat = floor(($hari_ini - $jatuh_tempo) / 86400);
    $denda = $telat * 2000;
}
?>
<h1>Form Pengembalian</h1>

<div class="detail-box">
    <p><b>Siswa:</b> <?= $p['nama_siswa'] ?></p>
    <p><b>Jatuh Tempo:</b> <?= $p['tanggal_kembali'] ?></p>
    <?php if ($denda > 0): ?>
        <p style="color:red;"><b>Terlambat! Denda: Rp <?= number_format($denda,0,',','.') ?></b></p>
    <?php endif; ?>
</div>

<form method="POST" action="pengembalian_simpan.php" class="form">
    <input type="hidden" name="id_pinjam" value="<?= $id ?>">
    
    <label>Tanggal Dikembalikan</label>
    <input type="date" name="tanggal_dikembalikan" value="<?= date('Y-m-d') ?>" required>
    
    <label>Kondisi Barang</label>
    <select name="kondisi_kembali">
        <option value="baik">Baik</option>
        <option value="rusak">Rusak</option>
    </select>
    
    <label>Denda (Rp)</label>
    <input type="number" name="denda" value="<?= $denda ?>" readonly>
    
    <button type="submit" class="btn-primary">Simpan Pengembalian</button>
</form>

<?php include 'footer.php'; ?>