<?php
include 'header.php';
include '../config/koneksi.php';

$barangs = mysqli_query($koneksi, "SELECT * FROM barangs WHERE stok > 0 ORDER BY nama_barang");
?>
<h1>Ajukan Peminjaman</h1>
<p class="welcome">Pilih barang yang ingin kamu pinjam</p>

<form method="POST" action="pinjam_simpan.php" class="form">
    <label>Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" value="<?= date('Y-m-d') ?>" required>

    <label>Tanggal Kembali</label>
    <input type="date" name="tanggal_kembali" value="<?= date('Y-m-d', strtotime('+3 days')) ?>" required>

    <h3>Pilih Barang</h3>
    <div id="barang-list">
        <div class="barang-row">
            <select name="barang[]" required>
                <option value="">-- Pilih Barang --</option>
                <?php 
                mysqli_data_seek($barangs, 0);
                while ($b = mysqli_fetch_assoc($barangs)): ?>
                    <option value="<?= $b['id_barang'] ?>">
                        <?= $b['kode_barang'] ?> - <?= $b['nama_barang'] ?> (Stok: <?= $b['stok'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
            <input type="number" name="jumlah[]" min="1" value="1" required>
            <button type="button" onclick="this.parentElement.remove()">✖</button>
        </div>
    </div>
    <button type="button" onclick="tambahBarang()" class="btn-secondary">+ Tambah Barang</button>

    <br><br>
    <button type="submit" class="btn-primary">Ajukan Peminjaman</button>
</form>

<script>
function tambahBarang() {
    const list = document.getElementById('barang-list');
    const row = list.children[0].cloneNode(true);
    row.querySelectorAll('select, input').forEach(el => el.value = '');
    row.querySelector('input[type=number]').value = 1;
    list.appendChild(row);
}
</script>

<?php include 'footer.php'; ?>