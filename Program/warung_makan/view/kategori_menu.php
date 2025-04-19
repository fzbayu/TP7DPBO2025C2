<?php

// Inisialisasi
$kategori = new kategori_menu();

// Insert
if (isset($_POST['nama'])) {
    $kategori->insert($_POST['nama']);
    header("Location: index.php?page=kategori");
    exit;
}

// Delete
if (isset($_GET['hapus'])) {
    $kategori->delete($_GET['hapus']);
    header("Location: index.php?page=kategori");
    exit;
}

// Update
if (isset($_POST['id_kategori_update']) && isset($_POST['nama_update'])) {
    $kategori->update($_POST['id_kategori_update'], $_POST['nama_update']);
    header("Location: index.php?page=kategori");
    exit;
}

// Ambil data kategori untuk ditampilkan
$data = $kategori->getAll();
?>

<h2>Data Kategori Menu</h2>

<!-- Tabel  -->
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Kategori</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $k): ?>
            <tr>
                <td><?= htmlspecialchars($k['id_kategori']); ?></td>
                <td><?= htmlspecialchars($k['nama_kategori']); ?></td>
                <td>
                    <a href="?page=kategori&hapus=<?= $k['id_kategori']; ?>" onclick="return confirm('Hapus kategori ini?')">[Hapus]</a>
                    <a href="?page=kategori&edit=<?= $k['id_kategori']; ?>">[Edit]</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Form Tambah Kategori -->
<h3>Tambah Kategori</h3>
<form method="post">
    <input type="text" name="nama" placeholder="Nama kategori" required>
    <button type="submit">Tambah Kategori</button>
</form>

<!-- Form Update Kategori -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $editId = $_GET['edit'];
    $kategoriData = $kategori->getById($editId);
    ?>
    <h3>Edit Kategori</h3>
    <form method="post">
        <input type="hidden" name="id_kategori_update" value="<?= $kategoriData['id_kategori']; ?>">
        <input type="text" name="nama_update" value="<?= htmlspecialchars($kategoriData['nama_kategori']); ?>" required>
        <button type="submit">Update Kategori</button>
    </form>
<?php endif; ?>

<br>
