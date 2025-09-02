<?php
require('propojeni_databaze_local.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno = trim($_POST["jmeno"]);
    $prijmeni = trim($_POST["prijmeni"]);
    $tel = trim($_POST["tel"]);
    $email = trim($_POST["email"]);
    $tagy = trim($_POST["tagy"]);
    $popis = trim($_POST["popis"]);
    $heslo = trim($_POST["heslo"]);
    $heslo2 = trim($_POST["passw2"]);

    // Ověření, že hesla se shodují
    if ($heslo !== $heslo2) {
        echo json_encode(['status' => 'error', 'message' => 'Hesla se neshodují!', 'field' => 'passw2']);
        exit();
    }

    // Ověření, zda e-mail už není v databázi
    $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Tento e-mail je již zaregistrován!', 'field' => 'email']);
        exit();
    }

    // Uložení uživatele do databáze
    $sql = "INSERT INTO user (jmeno, prijmeni, tel, email, heslo) VALUES (:jmeno, :prijmeni, :tel, :email, :heslo)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'jmeno' => $jmeno,
        'prijmeni' => $prijmeni,
        'tel' => $tel,
        'email' => $email,
        'heslo' => $heslo, // BEZ HASHOVÁNÍ (testovací verze)
    ]);

    // Přihlášení po registraci
    $_SESSION['iduser'] = $conn->lastInsertId();
    $_SESSION['jmeno'] = $jmeno;
    $_SESSION['prijmeni'] = $prijmeni;
    $_SESSION['email'] = $email;
    $_SESSION['tel'] = $tel;
    $_SESSION['time'] = time();

    echo json_encode(['status' => 'success']);
    exit();
}
?>
