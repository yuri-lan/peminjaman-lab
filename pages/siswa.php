<?php
include 'header.php';
include '../config/koneksi.php';
?>
<h1>Data Siswa</h1>
<a href="siswa_form.php" class="btn-primary">+ Tambah Siswa</a>

<table>
    <tr><th>No</th><th>NIS</th><th>Nama</th><th>Kelas</th><th>No HP</th><th>Aksi</th></tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "SELECT * FROM siswas ORDER BY id_siswa DESC");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['nis'] ?></td>
        <td><?= $r['nama_siswa'] ?></td>
        <td><?= $r['kelas'] ?></td>
        <td><?= $r['no_hp'] ?></td>
        <td>
            <a href="siswa_form.php?id=<?= $r['id_siswa'] ?>" class="btn-warning">Edit</a>
            <a href="siswa_hapus.php?id=<?= $r['id_siswa'] ?>" class="btn-danger" onclick="return confirm('Yakin?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>