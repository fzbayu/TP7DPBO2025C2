<?php
require_once 'config/db.php';

class kategori_menu {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM kategori_menu");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nama) {
        $stmt = $this->db->prepare("INSERT INTO kategori_menu (nama_kategori) VALUES (:nama)");
        return $stmt->execute(['nama' => $nama]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori_menu WHERE id_kategori = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function update($id, $nama_baru) {
        $stmt = $this->db->prepare("UPDATE kategori_menu SET nama_kategori = :nama WHERE id_kategori = :id");
        return $stmt->execute([
            'nama' => $nama_baru,
            'id' => $id
        ]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori_menu WHERE id_kategori = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
