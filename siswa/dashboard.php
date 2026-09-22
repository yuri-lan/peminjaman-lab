<?php
include 'header.php';
include '../config/koneksi.php';

$id_siswa = $_SESSION['id_siswa'];

$total_pinjam = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total FROM peminjamans WHERE id_siswa='$id_siswa'"))['total'];

$aktif = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total FROM peminjamans WHERE id_siswa='$id_siswa' AND status='dipinjam'"))['total'];

$selesai = mysqli_fetch_assoc(mysqli_query($koneksi, 
    "SELECT COUNT(*) AS total FROM peminjamans WHERE id_siswa='$id_siswa' AND status='dikembalikan'"))['total'];
?>

<div class="page-head">
    <div>
        <h1>Dashboard Siswa</h1>
        <p class="welcome">Halo, <b><?= $_SESSION['nama_siswa'] ?></b>! Selamat datang di sistem peminjaman lab.</p>
    </div>
</div>

<div class="cards" style="grid-template-columns: repeat(3, 1fr) !important;">
    <div class="card">
        <h3><?= $total_pinjam ?></h3>
        <p>Total Peminjaman</p>
    </div>
    <div class="card">
        <h3><?= $aktif ?></h3>
        <p>Sedang Dipinjam</p>
    </div>
    <div class="card">
        <h3><?= $selesai ?></h3>
        <p>Sudah Dikembalikan</p>
    </div>
</div>

<h2>Peminjaman Aktif</h2>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Barang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($koneksi, 
                "SELECT p.*, GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS barang_list
                 FROM peminjamans p
                 JOIN detail_peminjamans d ON p.id_pinjam = d.id_pinjam
                 JOIN barangs b ON d.id_barang = b.id_barang
                 WHERE p.id_siswa='$id_siswa' AND p.status='dipinjam'
                 GROUP BY p.id_pinjam
                 ORDER BY p.id_pinjam DESC");
            if (mysqli_num_rows($q) == 0):
            ?>
                <tr><td colspan="5" class="empty">Tidak ada peminjaman aktif</td></tr>
            <?php else: while ($r = mysqli_fetch_assoc($q)): 
                $jatuh_tempo = strtotime($r['tanggal_kembali']);
                $hari_ini = strtotime(date('Y-m-d'));
                $terlambat = $hari_ini > $jatuh_tempo;
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['tanggal_pinjam'] ?></td>
                    <td>
                        <?= $r['tanggal_kembali'] ?>
                        <?php if ($terlambat): ?>
                            <span class="badge badge-warning" style="margin-left:6px;">TERLAMBAT</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $r['barang_list'] ?></td>
                    <td><span class="badge badge-warning"><?= $r['status'] ?></span></td>
                </tr>
            <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>