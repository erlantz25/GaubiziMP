<?php
require_once __DIR__ . '/../Config/database.php';

class HomeController {
    public function index() {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->query("SELECT COUNT(*) FROM locales");
        $totalLocales = $stmt->fetchColumn();

        $stmt = $conn->query("SELECT COUNT(DISTINCT provincia) FROM locales");
        $totalProvincias = $stmt->fetchColumn();

        require_once '../app/Views/home/index.php';
    }
}
?>