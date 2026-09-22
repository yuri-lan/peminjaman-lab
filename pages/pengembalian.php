<?php
include 'header.php';
include '../config/koneksi.php';
?>
<h1>Pengembalian Barang</h1>

<h3>Peminjaman Aktif</h3>
<table>
    <tr><th>No</th><th>Tanggal Pinjam</th><th>Siswa</th><th>Jatuh Tempo</th><th>Aksi</th></tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "SELECT p.*, s.nama_siswa FROM peminjamans p 
                                 JOIN siswas s ON p.id_siswa=s.id_siswa 
                                 WHERE p.status='dipinjam' ORDER BY p.id_pinjam DESC");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['tanggal_pinjam'] ?></td>
        <td><?= $r['nama_siswa'] ?></td>
        <td><?= $r['tanggal_kembali'] ?></td>
        <td>
            <a href="pengembalian_form.php?id=<?= $r['id_pinjam'] ?>" class="btn-primary">Kembalikan</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>