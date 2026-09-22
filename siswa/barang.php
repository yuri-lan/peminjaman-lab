<?php
include 'header.php';
include '../config/koneksi.php';
?>
<h1>Daftar Barang Laboratorium</h1>
<p class="welcome">Barang yang tersedia untuk dipinjam</p>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($koneksi, "SELECT * FROM barangs ORDER BY nama_barang");
            while ($r = mysqli_fetch_assoc($q)):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $r['kode_barang'] ?></td>
                <td><?= $r['nama_barang'] ?></td>
                <td><?= $r['kategori'] ?></td>
                <td>
                    <?php if ($r['stok'] > 0): ?>
                        <span class="badge badge-success"><?= $r['stok'] ?> tersedia</span>
                    <?php else: ?>
                        <span class="badge badge-warning">Habis</span>
                    <?php endif; ?>
                </td>
                <td><?= $r['kondisi'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>