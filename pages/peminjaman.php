<?php
include 'header.php';
include '../config/koneksi.php';
?>
<h1>Data Peminjaman</h1>
<a href="peminjaman_form.php" class="btn-primary">+ Peminjaman Baru</a>

<table>
    <tr><th>No</th><th>Tanggal</th><th>Siswa</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "SELECT p.*, s.nama_siswa FROM peminjamans p 
                                 JOIN siswas s ON p.id_siswa=s.id_siswa 
                                 ORDER BY p.id_pinjam DESC");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['tanggal_pinjam'] ?></td>
        <td><?= $r['nama_siswa'] ?></td>
        <td><?= $r['tanggal_kembali'] ?></td>
        <td>
            <span class="badge <?= $r['status']=='dipinjam'?'badge-warning':'badge-success' ?>">
                <?= $r['status'] ?>
            </span>
        </td>
        <td>
            <a href="peminjaman_detail.php?id=<?= $r['id_pinjam'] ?>" class="btn-secondary">Detail</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>