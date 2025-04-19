<?php
require_once './class/pesanan.php';
require_once './class/menu.php';
require_once './class/pemesan.php';

$pesanan = new pesanan();
$menu = new menu();
$pemesan = new pemesan();

$dataPesanan = $pesanan->getAll();
$dataMenu = $menu->getAll();
$dataPemesan = $pemesan->getAll();

$editData = null;
if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    foreach ($dataPesanan as $ps) {
        if ($ps['id_pesanan'] == $idEdit) {
            $editData = $ps;
            break;
        }
    }
}

// Insert
if (isset($_POST['simpan'])) {
    $pesanan->insert($_POST['id_menu'], $_POST['id_pemesan'], $_POST['jumlah'], $_POST['tanggal']);
    header("Location: index.php?page=pesanan");
    exit;
}

// Delete
if (isset($_GET['hapus'])) {
    $pesanan->delete($_GET['hapus']);
    header("Location: index.php?page=pesanan");
    exit;
}

// Update
if (isset($_POST['update'])) {
    $pesanan->update($_POST['id_pesanan'], $_POST['id_menu'], $_POST['id_pemesan'], $_POST['jumlah'], $_POST['tanggal']);
    header("Location: index.php?page=pesanan");
    exit;
}
?>

<h2>Daftar Pesanan</h2>

<!-- Tabel -->

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Menu</th>
            <th>Pemesan</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataPesanan as $ps): ?>
            <tr>
                <td><?= $ps['id_pesanan'] ?></td>
                <?php
                    $menuName = '';
                    foreach ($dataMenu as $m) {
                        if ($m['id_menu'] == $ps['id_menu']) {
                            $menuName = $m['nama_menu'];
                            break;
                        }
                    }
                    $pemesanName = '';
                    foreach ($dataPemesan as $p) {
                        if ($p['id_pemesan'] == $ps['id_pemesan']) {
                            $pemesanName = $p['nama_pemesan'];
                            break;
                        }
                    }
                ?>
                <td><?= $menuName ?></td>
                <td><?= $pemesanName ?></td>
                <td><?= $ps['jumlah'] ?></td>
                <td><?= $ps['tanggal'] ?></td>
                <td>
                    <a href="?page=pesanan&edit=<?= $ps['id_pesanan'] ?>">Edit</a> |
                    <a href="?page=pesanan&hapus=<?= $ps['id_pesanan'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Form Tambah & Update Pesanan -->

<h2><?= $editData ? 'Edit Pesanan' : 'Tambah Pesanan' ?></h2>

<form method="post">
    <?php if ($editData): ?>
        <input type="hidden" name="id_pesanan" value="<?= $editData['id_pesanan'] ?>">
    <?php endif; ?>

    <select name="id_menu" required>
        <option value="">-- Pilih Menu --</option>
        <?php foreach($dataMenu as $m): ?>
            <option value="<?= $m['id_menu'] ?>" <?= $editData && $editData['id_menu'] == $m['id_menu'] ? 'selected' : '' ?>>
                <?= $m['nama_menu'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="id_pemesan" required>
        <option value="">-- Pilih Pemesan --</option>
        <?php foreach($dataPemesan as $p): ?>
            <option value="<?= $p['id_pemesan'] ?>" <?= $editData && $editData['id_pemesan'] == $p['id_pemesan'] ? 'selected' : '' ?>>
                <?= $p['nama_pemesan'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="jumlah" placeholder="Jumlah" required value="<?= $editData['jumlah'] ?? '' ?>">
    <input type="date" name="tanggal" required value="<?= $editData['tanggal'] ?? '' ?>">

    <button type="submit" name="<?= $editData ? 'update' : 'simpan' ?>">
        <?= $editData ? 'Simpan Perubahan' : 'Tambah' ?>
    </button>

    <?php if ($editData): ?>
        <a href="index.php?page=pesanan">Batal</a>
    <?php endif; ?>
</form>

<hr>
