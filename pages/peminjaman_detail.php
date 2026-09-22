<?php
include 'header.php';
include '../config/koneksi.php';

$id = $_GET['id'];
$p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT p.*, s.nama_siswa, s.kelas FROM peminjamans p 
                                               JOIN siswas s ON p.id_siswa=s.id_siswa 
                                               WHERE p.id_pinjam='$id'"));
?>
<h1>Detail Peminjaman #<?= $id ?></h1>

<div class="detail-box">
    <p><b>Siswa:</b> <?= $p['nama_siswa'] ?> (<?= $p['kelas'] ?>)</p>
    <p><b>Tanggal Pinjam:</b> <?= $p['tanggal_pinjam'] ?></p>
    <p><b>Jatuh Tempo:</b> <?= $p['tanggal_kembali'] ?></p>
    <p><b>Status:</b> <?= $p['status'] ?></p>
</div>

<h3>Barang yang Dipinjam</h3>
<table>
    <tr><th>No</th><th>Kode</th><th>Nama Barang</th><th>Jumlah</th></tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "SELECT d.*, b.kode_barang, b.nama_barang 
                                 FROM detail_peminjamans d 
                                 JOIN barangs b ON d.id_barang=b.id_barang 
                                 WHERE d.id_pinjam='$id'");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['kode_barang'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['jumlah'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="peminjaman.php" class="btn-secondary">Kembali</a>

<?php include 'footer.php'; ?>