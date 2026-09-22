<?php
include 'header.php';
include '../config/koneksi.php';

$id_siswa = $_SESSION['id_siswa'];
?>
<h1>Riwayat Peminjaman Saya</h1>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Barang</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($koneksi,
                "SELECT p.*, 
                        GROUP_CONCAT(b.nama_barang SEPARATOR ', ') AS barang_list,
                        peng.denda, peng.tanggal_dikembalikan
                 FROM peminjamans p
                 JOIN detail_peminjamans d ON p.id_pinjam = d.id_pinjam
                 JOIN barangs b ON d.id_barang = b.id_barang
                 LEFT JOIN pengembalians peng ON p.id_pinjam = peng.id_pinjam
                 WHERE p.id_siswa='$id_siswa'
                 GROUP BY p.id_pinjam
                 ORDER BY p.id_pinjam DESC");
            if (mysqli_num_rows($q) == 0):
            ?>
                <tr><td colspan="6" class="empty">Belum ada riwayat peminjaman</td></tr>
            <?php else: while ($r = mysqli_fetch_assoc($q)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $r['tanggal_pinjam'] ?></td>
                    <td><?= $r['tanggal_kembali'] ?></td>
                    <td><?= $r['barang_list'] ?></td>
                    <td>
                        <span class="badge <?= $r['status']=='dipinjam'?'badge-warning':'badge-success' ?>">
                            <?= $r['status'] ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($r['denda'] && $r['denda'] > 0): ?>
                            Rp <?= number_format($r['denda'],0,',','.') ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>