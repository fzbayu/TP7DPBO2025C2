<?php
require_once 'config/db.php';

class menu {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM menu");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nama_menu, $harga, $id_kategori) {
        $stmt = $this->db->prepare("INSERT INTO menu (nama_menu, harga, id_kategori) VALUES (:nama, :harga, :id_kategori)");
        return $stmt->execute([
            'nama' => $nama_menu,
            'harga' => $harga,
            'id_kategori' => $id_kategori
        ]);
    }

    public function update($id_menu, $nama_menu, $harga, $id_kategori) {
        $stmt = $this->db->prepare("UPDATE menu SET nama_menu = :nama, harga = :harga, id_kategori = :id_kategori WHERE id_menu = :id");
        return $stmt->execute([
            'nama' => $nama_menu,
            'harga' => $harga,
            'id_kategori' => $id_kategori,
            'id' => $id_menu
        ]);
    }

    public function delete($id_menu) {
        $stmt = $this->db->prepare("DELETE FROM menu WHERE id_menu = :id");
        return $stmt->execute(['id' => $id_menu]);
    }

    public function getById($id_menu) {
        $stmt = $this->db->prepare("SELECT * FROM menu WHERE id_menu = :id");
        $stmt->execute(['id' => $id_menu]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchByName($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM menu WHERE nama_menu LIKE ?");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
    
}
?>
