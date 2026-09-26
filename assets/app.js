/* ============================================
   PEMINJAMAN LAB - Core Logic (LocalStorage)
   ============================================ */

function initData() {
    if (!localStorage.getItem('barangs')) {
        localStorage.setItem('barangs', JSON.stringify([
            { id: 1, kode: 'LP-001', nama: 'Laptop Asus VivoBook 14', kategori: 'Laptop', stok: 5, kondisi: 'baik' },
            { id: 2, kode: 'LP-002', nama: 'Laptop Lenovo ThinkPad', kategori: 'Laptop', stok: 3, kondisi: 'baik' },
            { id: 3, kode: 'LP-003', nama: 'Laptop Acer Aspire 5', kategori: 'Laptop', stok: 4, kondisi: 'baik' },
            { id: 4, kode: 'PJ-001', nama: 'Proyektor Epson EB-X05', kategori: 'Proyektor', stok: 2, kondisi: 'baik' },
            { id: 5, kode: 'KB-001', nama: 'Kabel HDMI 2 meter', kategori: 'Kabel', stok: 10, kondisi: 'baik' },
            { id: 6, kode: 'RT-001', nama: 'Router TP-Link Archer C6', kategori: 'Jaringan', stok: 3, kondisi: 'baik' },
        ]));
    }
    if (!localStorage.getItem('siswas')) {
        localStorage.setItem('siswas', JSON.stringify([
            { id: 1, nis: '2024001', nama: 'Andi Pratama', kelas: 'XII RPL 1', no_hp: '081234567890', password: 'siswa123' },
            { id: 2, nis: '2024002', nama: 'Budi Santoso', kelas: 'XII RPL 1', no_hp: '081234567891', password: 'siswa123' },
            { id: 3, nis: '2024003', nama: 'Citra Dewi', kelas: 'XII RPL 2', no_hp: '081234567892', password: 'siswa123' },
            { id: 4, nis: '2024004', nama: 'Dina Ayu', kelas: 'XII RPL 2', no_hp: '081234567893', password: 'siswa123' },
            { id: 5, nis: '2024005', nama: 'Eko Wijaya', kelas: 'XI RPL 1', no_hp: '081234567894', password: 'siswa123' },
        ]));
    }
    if (!localStorage.getItem('peminjamans')) {
        localStorage.setItem('peminjamans', JSON.stringify([]));
    }
}

// ============ BARANG ============
function getBarang() { return JSON.parse(localStorage.getItem('barangs') || '[]'); }
function saveBarang(data) { localStorage.setItem('barangs', JSON.stringify(data)); }
function tambahBarang(b) {
    const list = getBarang();
    b.id = list.length ? Math.max(...list.map(x => x.id)) + 1 : 1;
    list.push(b); saveBarang(list);
}
function updateBarang(id, data) {
    const list = getBarang();
    const i = list.findIndex(x => x.id === id);
    if (i !== -1) { list[i] = { ...list[i], ...data }; saveBarang(list); }
}
function hapusBarang(id) { saveBarang(getBarang().filter(x => x.id !== id)); }
function getBarangById(id) { return getBarang().find(x => x.id === id); }

// ============ SISWA ============
function getSiswa() { return JSON.parse(localStorage.getItem('siswas') || '[]'); }
function saveSiswa(data) { localStorage.setItem('siswas', JSON.stringify(data)); }
function tambahSiswa(s) {
    const list = getSiswa();
    s.id = list.length ? Math.max(...list.map(x => x.id)) + 1 : 1;
    s.password = 'siswa123';
    list.push(s); saveSiswa(list);
}
function updateSiswa(id, data) {
    const list = getSiswa();
    const i = list.findIndex(x => x.id === id);
    if (i !== -1) { list[i] = { ...list[i], ...data }; saveSiswa(list); }
}
function hapusSiswa(id) { saveSiswa(getSiswa().filter(x => x.id !== id)); }

// ============ PEMINJAMAN ============
function getPeminjaman() { return JSON.parse(localStorage.getItem('peminjamans') || '[]'); }
function savePeminjaman(data) { localStorage.setItem('peminjamans', JSON.stringify(data)); }
function tambahPeminjaman(p) {
    const list = getPeminjaman();
    p.id = list.length ? Math.max(...list.map(x => x.id)) + 1 : 1;
    p.status = 'dipinjam';
    list.push(p); savePeminjaman(list);

    const barangs = getBarang();
    p.items.forEach(it => {
        const b = barangs.find(x => x.id === it.id_barang);
        if (b) b.stok -= it.jumlah;
    });
    saveBarang(barangs);
}
function kembalikanPeminjaman(id, kondisi, denda) {
    const list = getPeminjaman();
    const i = list.findIndex(x => x.id === id);
    if (i !== -1) {
        list[i].status = 'dikembalikan';
        list[i].tanggal_dikembalikan = new Date().toISOString().split('T')[0];
        list[i].kondisi_kembali = kondisi;
        list[i].denda = denda;
        savePeminjaman(list);

        const barangs = getBarang();
        list[i].items.forEach(it => {
            const b = barangs.find(x => x.id === it.id_barang);
            if (b) b.stok += it.jumlah;
        });
        saveBarang(barangs);
    }
}

// ============ HELPER ============
function formatRupiah(n) { return 'Rp ' + (n || 0).toLocaleString('id-ID'); }
function getCurrentSiswa() { return JSON.parse(localStorage.getItem('currentSiswa') || 'null'); }
function logoutSiswa() {
    localStorage.removeItem('currentSiswa');
    window.location.href = '../index.html';
}
function cekLoginSiswa() {
    if (!getCurrentSiswa()) window.location.href = '../index.html';
}
function hitungDenda(tglJatuhTempo) {
    const jatuh = new Date(tglJatuhTempo);
    const sekarang = new Date();
    jatuh.setHours(0,0,0,0); sekarang.setHours(0,0,0,0);
    if (sekarang <= jatuh) return 0;
    const telat = Math.floor((sekarang - jatuh) / (1000 * 60 * 60 * 24));
    return telat * 2000;
}
function tanggalHariIni() { return new Date().toISOString().split('T')[0]; }
function tanggalPlusHari(hari) {
    const d = new Date();
    d.setDate(d.getDate() + hari);
    return d.toISOString().split('T')[0];
}