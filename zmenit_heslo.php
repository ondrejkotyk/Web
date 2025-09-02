<?php
require('propojeni_databaze_local.php');
session_start();

// Kontrola přihlášení
if (!isset($_SESSION['iduser'])) {
    header("Location: login.php");
    exit();
}

// Zpracování formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $iduser = $_SESSION['iduser'];
    $heslo = trim($_POST['heslo']);
    $heslo2 = trim($_POST['heslo2']);

    // Kontrola, zda jsou pole vyplněna
    if (empty($heslo) || empty($heslo2)) {
        $_SESSION['heslo_error'] = "Všechna pole musí být vyplněna!";
        header("Location: profil.php");
        exit();
    }

    // Kontrola, zda hesla souhlasí
    if ($heslo !== $heslo2) {
        $_SESSION['heslo_error'] = "Hesla se neshodují!";
        header("Location: profil.php");
        exit();
    }

    // Aktualizace hesla v databázi (aktuálně bez šifrování - pro testování)
    $sql = "UPDATE user SET heslo = :heslo WHERE iduser = :iduser";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['heslo' => $heslo, 'iduser' => $iduser]);

    $_SESSION['heslo_success'] = "Heslo bylo úspěšně změněno!";
    header("Location: profil.php");
    exit();
}
?>
