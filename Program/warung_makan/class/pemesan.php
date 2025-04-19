<?php
require_once 'config/db.php';

class pemesan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM pemesan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nama, $alamat) {
        $stmt = $this->db->prepare("INSERT INTO pemesan (nama_pemesan, alamat) VALUES (:nama, :alamat)");
        return $stmt->execute([
            'nama' => $nama,
            'alamat' => $alamat
        ]);
    }

    public function update($id, $nama, $alamat) {
        $stmt = $this->db->prepare("UPDATE pemesan SET nama_pemesan = :nama, alamat = :alamat WHERE id_pemesan = :id");
        return $stmt->execute([
            'id' => $id,
            'nama' => $nama,
            'alamat' => $alamat
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pemesan WHERE id_pemesan = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pemesan WHERE id_pemesan = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
