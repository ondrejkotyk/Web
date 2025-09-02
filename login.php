<?php
require('propojeni_databaze_local.php');
session_start();

header('Content-Type: application/json'); // Odpověď bude JSON

// Kontrola, zda byl formulář odeslán metodou POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $heslo = trim($_POST["heslo"]);

    if (empty($email)) {
        echo json_encode(["status" => "error", "message" => "Vyplňte e-mail.", "field" => "loginEmail"]);
        exit();
    }

    if (empty($heslo)) {
        echo json_encode(["status" => "error", "message" => "Vyplňte heslo.", "field" => "loginPassword"]);
        exit();
    }

    // Dotaz na uživatele podle e-mailu
    $sql = "SELECT iduser, jmeno, prijmeni, tel, email, heslo FROM user WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ověření hesla
    if (!$user || $heslo !== $user['heslo']) { // (Zatím bez hashování)
        echo json_encode(["status" => "error", "message" => "Špatný e-mail nebo heslo!", "field" => "loginEmail"]);
        exit();
    }

    // Uložení údajů do session
    $_SESSION['iduser'] = $user['iduser'];
    $_SESSION['jmeno'] = $user['jmeno'];
    $_SESSION['prijmeni'] = $user['prijmeni'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['tel'] = $user['tel'];
    $_SESSION['time'] = time();

    echo json_encode(["status" => "success"]);
    exit();
}
?>
