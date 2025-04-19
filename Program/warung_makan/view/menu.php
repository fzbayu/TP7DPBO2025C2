<?php
require_once './class/menu.php';
require_once './class/kategori_menu.php';

$kategori = new kategori_menu;

$dataKategori = $kategori->getAll();

$menu = new Menu();

$editData = null;
if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    foreach ($dataKategori as $ps) {
        if ($ps['id_kategori'] == $idEdit) {
            $editData = $ps;
            break;
        }
    }
}

// Insert 
if (isset($_POST['nama_menu']) && isset($_POST['harga']) && isset($_POST['id_kategori'])) {
    $menu->insert($_POST['nama_menu'], $_POST['harga'], $_POST['id_kategori']);
    header("Location: index.php?page=menu");
    exit;
}

// Update 
if (isset($_POST['id_menu_update']) && isset($_POST['nama_menu_update']) && isset($_POST['harga_update']) && isset($_POST['id_kategori_update'])) {
    $menu->update($_POST['id_menu_update'], $_POST['nama_menu_update'], $_POST['harga_update'], $_POST['id_kategori_update']);
    header("Location: index.php?page=menu");
    exit;
}

// Hapus 
if (isset($_GET['hapus'])) {
    $menu->delete($_GET['hapus']);
    header("Location: index.php?page=menu");
    exit;
}

// Ambil semua menu
if (isset($_GET['search']) && $_GET['search'] !== '') {
    $searchTerm = $_GET['search'];
    $data = $menu->searchByName($searchTerm);
} else {
    $data = $menu->getAll();
}

?>

<form method="get" style="margin-bottom: 15px;">
    <input type="hidden" name="page" value="menu">
    <input type="text" name="search" placeholder="Cari nama menu..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Cari</button>
</form>

<h2>Daftar Menu</h2>

<!-- Tabel -->
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID Menu</th>
            <th>Nama Menu</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['id_menu']); ?></td>
                <td><?= htmlspecialchars($m['nama_menu']); ?></td>
                <td>Rp<?= number_format($m['harga'], 0, ',', '.'); ?></td>
                <?php
                    // Mencari nama kategori berdasarkan ID
                    $kategoriName = '';
                    foreach ($dataKategori as $p) {
                        if ($m['id_kategori'] == $p['id_kategori']) {
                            $kategoriName = $p['nama_kategori'];
                            break;
                        }
                    }
                ?>
                <td><?= htmlspecialchars($kategoriName); ?></td>
                <td>
                    <a href="?page=menu&hapus=<?= $m['id_menu']; ?>" onclick="return confirm('Hapus menu ini?')">[Hapus]</a>
                    <a href="?page=menu&edit=<?= $m['id_menu']; ?>">[Edit]</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Form Tambah Menu -->
<h3>Tambah Menu</h3>
<form method="post">
    <input type="text" name="nama_menu" placeholder="Nama Menu" required>
    <input type="number" name="harga" placeholder="Harga" required>
    <select name="id_kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <?php foreach($dataKategori as $m): ?>
            <option value="<?= $m['id_kategori'] ?>" <?= $editData && $editData['id_kategori'] == $m['id_kategori'] ? 'selected' : '' ?>>
                <?= $m['nama_kategori'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Tambah Menu</button>
</form>

<!-- Form Update Menu -->
<?php if (isset($_GET['edit'])): ?>
    <?php
    $editId = $_GET['edit'];
    $menuData = $menu->getById($editId);
    ?>
    <h3>Edit Menu</h3>
    <form method="post">
        <input type="hidden" name="id_menu_update" value="<?= $menuData['id_menu']; ?>">
        <input type="text" name="nama_menu_update" value="<?= htmlspecialchars($menuData['nama_menu']); ?>" required>
        <input type="number" name="harga_update" value="<?= $menuData['harga']; ?>" required>
        
        <select name="id_kategori_update" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach($dataKategori as $m): ?>
                <option value="<?= $m['id_kategori'] ?>" <?= $editData && $editData['id_kategori'] == $m['id_kategori'] ? 'selected' : '' ?>>
                    <?= $m['nama_kategori'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update Menu</button>
    </form>
<?php endif; ?>