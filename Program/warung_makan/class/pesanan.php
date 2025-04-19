<?php
require_once 'config/db.php';

class pesanan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM pesanan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insert($id_menu, $id_pemesan, $jumlah, $tanggal) {
        $stmt = $this->db->prepare("INSERT INTO pesanan (id_menu, id_pemesan, jumlah, tanggal) 
                                    VALUES (:id_menu, :id_pemesan, :jumlah, :tanggal)");
        return $stmt->execute([
            'id_menu'    => $id_menu,
            'id_pemesan' => $id_pemesan,
            'jumlah'     => $jumlah,
            'tanggal'    => $tanggal
        ]);
    }

    public function update($id, $id_menu, $id_pemesan, $jumlah, $tanggal) {
        $stmt = $this->db->prepare("UPDATE pesanan 
                                    SET id_menu = :id_menu, id_pemesan = :id_pemesan, jumlah = :jumlah, tanggal = :tanggal 
                                    WHERE id_pesanan = :id");
        return $stmt->execute([
            'id'         => $id,
            'id_menu'    => $id_menu,
            'id_pemesan' => $id_pemesan,
            'jumlah'     => $jumlah,
            'tanggal'    => $tanggal
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM pesanan WHERE id_pesanan = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pesanan WHERE id_pesanan = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
