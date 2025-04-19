<?php
// Menyertakan file yang diperlukan
require_once 'config/db.php';
require_once 'class/kategori_menu.php';
require_once 'class/menu.php';
require_once 'class/pemesan.php';
require_once 'class/pesanan.php';

// Inisialisasi objek
$kategori = new kategori_menu();
$menu = new menu();
$pemesan = new pemesan();
$pesanan = new pesanan();

// Page default index
$page = $_GET['page'] ?? 'pesanan';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Makan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <div class="container">
        <h3>Selamat Datang di Warung Makan Online</h3>

        <nav>
            <a href="?page=kategori">Kategori</a>
            <a href="?page=menu">Menu</a>
            <a href="?page=pemesan">Pemesan</a>
            <a href="?page=pesanan">Pesanan</a>
        </nav>

        <div>
            <?php
            switch($page) {
                case 'kategori':
                    include 'view/kategori_menu.php';
                    break;
                case 'menu':
                    include 'view/menu.php';
                    break;
                case 'pemesan':
                    include 'view/pemesan.php';
                    break;
                case 'pesanan':
                    include 'view/pesanan.php';
                    break;
                default:
                    include 'view/pesanan.php';
                    break;
            }
            ?>
        </div>
    </div>

    <?php include 'view/footer.php'; ?>
</body>
</html>
