<?php
include '../config/koneksi.php';

if (isset($koneksi)) {
    echo "✅ Variabel \$koneksi ADA";
    var_dump($koneksi);
} else {
    echo "❌ Variabel \$koneksi TIDAK ADA";
}
?>