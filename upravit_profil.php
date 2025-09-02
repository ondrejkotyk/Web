<?php
require('propojeni_databaze_local.php');
session_start(); // Ujistíme se, že session běží

// Ujistíme se, že je uživatel přihlášen
if (!isset($_SESSION['iduser'])) {
    header("Location: login.php");
    exit();
}

$iduser = $_SESSION['iduser'];

// Načtení údajů o uživateli
$sql = "SELECT jmeno, prijmeni, tel, email, lokalita, popis, tagy, obr FROM user WHERE iduser = :iduser";
$stmt = $conn->prepare($sql);
$stmt->execute(['iduser' => $iduser]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Uživatel nenalezen.");
}

// Určení aktuálního obrázku
$profilObr = !empty($user['obr']) ? "img/" . htmlspecialchars($user['obr']) : "img/profil_default.png";

// Zpracování formuláře
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno = trim($_POST["jmeno"]);
    $prijmeni = trim($_POST["prijmeni"]);
    $tel = trim($_POST["tel"]);
    $email = trim($_POST["email"]);
    $lokalita = trim($_POST["lokalita"]);
    $popis = trim($_POST["popis"]);
    $tagy = trim($_POST["tagy"]);

    // Zpracování nahrání obrázku
    if (!empty($_FILES["profil_obr"]["name"])) {
        $targetDir = "img/";
        $fileName = time() . "_" . basename($_FILES["profil_obr"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Povolené formáty obrázku
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["profil_obr"]["tmp_name"], $targetFilePath)) {
                $profilObr = $fileName;
            } else {
                $error = "Chyba při nahrávání souboru.";
            }
        } else {
            $error = "Neplatný formát obrázku (povolené: jpg, jpeg, png, gif).";
        }
    } else {
        $profilObr = $user['obr'];
    }

    // Pokud není chyba, aktualizujeme databázi
    if (!isset($error)) {
        $sqlUpdate = "UPDATE user SET jmeno = :jmeno, prijmeni = :prijmeni, tel = :tel, email = :email, 
              lokalita = :lokalita, popis = :popis, tagy = :tagy, obr = :obr WHERE iduser = :iduser";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->execute([
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'tel' => $tel,
            'email' => $email,
            'lokalita' => $lokalita,
            'popis' => $popis,
            'tagy' => $tagy,
            'obr' => $profilObr,
            'iduser' => $iduser
        ]);

        // ✅ Nastavení úspěšné zprávy
        $_SESSION['success'] = "Profil byl úspěšně aktualizován!";
        header("Location: profil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Upravit profil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styly.css">
</head>
<body class="bg-light">
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <h2>Upravit profil</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="upravit_profil.php" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
            <!-- Obrázek profilu -->
            <div class="text-center mb-3">
                <img src="<?php echo $profilObr; ?>" alt="Profilový obrázek" class="img-thumbnail" width="150">
            </div>

            <div class="form-group">
                <label for="profil_obr">Změnit profilový obrázek:</label>
                <input type="file" class="form-control" name="profil_obr">
            </div>

            <div class="form-group">
                <label for="jmeno">Jméno:</label>
                <input type="text" class="form-control" id="jmeno" name="jmeno" value="<?php echo htmlspecialchars($user['jmeno']); ?>" required>
            </div>

            <div class="form-group">
                <label for="prijmeni">Příjmení:</label>
                <input type="text" class="form-control" id="prijmeni" name="prijmeni" value="<?php echo htmlspecialchars($user['prijmeni']); ?>" required>
            </div>

            <div class="form-group">
                <label for="tel">Telefon:</label>
                <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($user['tel']); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lokalita">Lokalita:</label>
                <input type="text" class="form-control" id="lokalita" name="lokalita" value="<?php echo htmlspecialchars($user['lokalita']); ?>">
            </div>

            <div class="form-group">
                <label for="popis">O sobě:</label>
                <textarea class="form-control" id="popis" name="popis" rows="3"><?php echo htmlspecialchars($user['popis']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="tagy">Dovednosti (oddělené čárkou):</label>
                <input type="text" class="form-control" id="tagy" name="tagy" value="<?php echo htmlspecialchars($user['tagy']); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Uložit změny</button>
            <a href="profil.php" class="btn btn-secondary">Zpět</a>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
