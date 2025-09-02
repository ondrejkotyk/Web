<?php
require('propojeni_databaze_local.php');

if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo json_encode([]);
    exit();
}

$search = trim($_GET['q']);
$search = "%$search%"; // Přidání wildcard pro LIKE

$sql = "SELECT DISTINCT tagy, lokalita FROM nabidka 
        WHERE tagy LIKE :search 
           OR lokalita LIKE :search
        LIMIT 5"; // Omezíme počet návrhů na 5

$stmt = $conn->prepare($sql);
$stmt->execute(['search' => $search]);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
