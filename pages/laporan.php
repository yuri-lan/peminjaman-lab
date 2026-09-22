<?php
include 'header.php';
include '../config/koneksi.php';

$dari = $_GET['dari'] ?? date('Y-m-01');
$ke   = $_GET['ke'] ?? date('Y-m-d');
?>
<h1>Laporan Peminjaman</h1>

<form method="GET" class="form-inline">
    <label>Dari</label>
    <input type="date" name="dari" value="<?= $dari ?>">
    <label>Ke</label>
    <input type="date" name="ke" value="<?= $ke ?>">
    <button type="submit" class="btn-primary">Filter</button>
    <button type="button" onclick="window.print()" class="btn-secondary">Cetak</button>
</form>

<table>
    <tr>
        <th>No</th><th>Tanggal</th><th>Siswa</th><th>Barang</th><th>Jumlah</th><th>Status</th>
    </tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "
        SELECT p.tanggal_pinjam, s.nama_siswa, b.nama_barang, d.jumlah, p.status 
        FROM peminjamans p 
        JOIN siswas s ON p.id_siswa=s.id_siswa 
        JOIN detail_peminjamans d ON p.id_pinjam=d.id_pinjam 
        JOIN barangs b ON d.id_barang=b.id_barang 
        WHERE p.tanggal_pinjam BETWEEN '$dari' AND '$ke' 
        ORDER BY p.tanggal_pinjam DESC
    ");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['tanggal_pinjam'] ?></td>
        <td><?= $r['nama_siswa'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['jumlah'] ?></td>
        <td><?= $r['status'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>