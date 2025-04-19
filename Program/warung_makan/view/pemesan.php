<?php
require_once './class/pemesan.php';

$pemesan = new Pemesan();

// Insert 
if (isset($_POST['nama_pemesan'])) {
    $pemesan->insert($_POST['nama_pemesan'], $_POST['alamat']);
    header("Location: index.php?page=pemesan");
    exit;
}

// Update 
if (isset($_POST['id_pemesan_update']) && isset($_POST['nama_pemesan_update']) && isset($_POST['alamat_update'])) {
    $pemesan->update($_POST['id_pemesan_update'], $_POST['nama_pemesan_update'], $_POST['alamat_update']);
    header("Location: index.php?page=pemesan");
    exit;
}

// Delete
if (isset($_GET['hapus'])) {
    $pemesan->delete($_GET['hapus']);
    header("Location: index.php?page=pemesan");
    exit;
}

// Ambil semua pemesan
$data = $pemesan->getAll();
?>

<h2>Daftar Pemesan</h2>

<!-- Tabel  -->
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Pemesan</th>
            <th>Nama Pemesan</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id_pemesan']); ?></td>
                <td><?= htmlspecialchars($p['nama_pemesan']); ?></td>
                <td><?= htmlspecialchars($p['alamat']); ?></td>
                <td>
                    <a href="?page=pemesan&hapus=<?= $p['id_pemesan']; ?>" onclick="return confirm('Hapus pemesan ini?')">[Hapus]</a>
                    <a href="?page=pemesan&edit=<?= $p['id_pemesan']; ?>">[Edit]</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Form Tambah Pemesan -->
<h3>Tambah Pemesan</h3>
<form method="post">
    <input type="text" name="nama_pemesan" placeholder="Nama Pemesan" required>
    <input type="text" name="alamat" placeholder="Alamat" required>
    <button type="submit">Tambah Pemesan</button>
</form>

<!-- Form Update Pemesan -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $editId = $_GET['edit'];
    $pemesanData = $pemesan->getById($editId);
    ?>
    <h3>Edit Pemesan</h3>
    <form method="post">
        <input type="hidden" name="id_pemesan_update" value="<?= $pemesanData['id_pemesan']; ?>">
        <input type="text" name="nama_pemesan_update" value="<?= htmlspecialchars($pemesanData['nama_pemesan']); ?>" required>
        <input type="text" name="alamat_update" value="<?= htmlspecialchars($pemesanData['alamat']); ?>" required>
        <button type="submit">Update Pemesan</button>
    </form>
<?php endif; ?>