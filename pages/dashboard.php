<?php
include 'header.php';
include '../config/koneksi.php';

$total_barang  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM barangs"))['total'];
$total_siswa   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswas"))['total'];
$total_pinjam  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM peminjamans WHERE status='dipinjam'"))['total'];
$total_kembali = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pengembalians"))['total'];
?>

<div class="page-head">
    <div>
        <h1>Dashboard</h1>
        <p class="welcome">Selamat datang, <b><?= $_SESSION['nama_admin'] ?></b>!</p>
    </div>
</div>

<div class="cards">
    <div class="card">
        <h3><?= $total_barang ?></h3>
        <p>Total Barang</p>
    </div>
    <div class="card">
        <h3><?= $total_siswa ?></h3>
        <p>Total Siswa</p>
    </div>
    <div class="card">
        <h3><?= $total_pinjam ?></h3>
        <p>Sedang Dipinjam</p>
    </div>
    <div class="card">
        <h3><?= $total_kembali ?></h3>
        <p>Sudah Dikembalikan</p>
    </div>
</div>

<h2>Transaksi Terbaru</h2>
<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Siswa</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($koneksi, "SELECT p.*, s.nama_siswa FROM peminjamans p 
                                         JOIN siswas s ON p.id_siswa=s.id_siswa 
                                         ORDER BY p.id_pinjam DESC LIMIT 5");
            if (mysqli_num_rows($q) == 0):
            ?>
                <tr>
                    <td colspan="4" class="empty">Belum ada transaksi</td>
                </tr>
            <?php else: while ($r = mysqli_fetch_assoc($q)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['tanggal_pinjam'] ?></td>
                    <td><?= $r['nama_siswa'] ?></td>
                    <td>
                        <span class="badge <?= $r['status']=='dipinjam'?'badge-warning':'badge-success' ?>">
                            <?= $r['status'] ?>
                        </span>
                    </td>
                </tr>
            <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>