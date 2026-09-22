<?php
include 'header.php';
include '../config/koneksi.php';
?>
<h1>Data Barang</h1>
<a href="barang_form.php" class="btn-primary">+ Tambah Barang</a>

<table>
    <tr>
        <th>No</th><th>Kode</th><th>Nama</th><th>Kategori</th><th>Stok</th><th>Kondisi</th><th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    $q = mysqli_query($koneksi, "SELECT * FROM barangs ORDER BY id_barang DESC");
    while ($r = mysqli_fetch_assoc($q)):
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $r['kode_barang'] ?></td>
        <td><?= $r['nama_barang'] ?></td>
        <td><?= $r['kategori'] ?></td>
        <td><?= $r['stok'] ?></td>
        <td><?= $r['kondisi'] ?></td>
        <td>
            <a href="barang_form.php?id=<?= $r['id_barang'] ?>" class="btn-warning">Edit</a>
            <a href="barang_hapus.php?id=<?= $r['id_barang'] ?>" class="btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include 'footer.php'; ?>