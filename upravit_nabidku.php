<?php
require('propojeni_databaze_local.php');
session_start();

// Kontrola přihlášení uživatele
if (!isset($_SESSION['iduser'])) {
    header("Location: login.php");
    exit();
}

$iduser = $_SESSION['iduser'];

// Získání ID nabídky z URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Chyba: Nebyla určena žádná nabídka k úpravě.");
}
$idnabidka = $_GET['id'];

// Načtení údajů o nabídce
$sql = "SELECT * FROM nabidka WHERE idnabidka = :idnabidka AND user_iduser = :iduser";
$stmt = $conn->prepare($sql);
$stmt->execute(['idnabidka' => $idnabidka, 'iduser' => $iduser]);
$nabidka = $stmt->fetch(PDO::FETCH_ASSOC);

// Pokud nabídka neexistuje nebo nepatří uživateli
if (!$nabidka) {
    die("Chyba: Tato nabídka neexistuje nebo k ní nemáte přístup.");
}

// Zpracování formuláře při odeslání
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pracovnidoba = trim($_POST["pracovnidoba"]);
    $sazba = trim($_POST["sazba"]);
    $lokalita = trim($_POST["lokalita"]);
    $tagy = trim($_POST["tagy"]);
    $hodnoceni = trim($_POST["hodnoceni"]);

    // Zpracování nahrání obrázku (pokud byl vybrán nový)
    if (!empty($_FILES["obr"]["name"])) {
        $targetDir = "img/";
        $fileName = time() . "_" . basename($_FILES["obr"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Povolené formáty obrázku
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["obr"]["tmp_name"], $targetFilePath)) {
                $obr = $fileName;
            } else {
                $error = "Chyba při nahrávání souboru.";
            }
        } else {
            $error = "Neplatný formát obrázku (povolené: jpg, jpeg, png, gif).";
        }
    } else {
        $obr = $nabidka['obr']; // Ponechá původní obrázek
    }

    // Aktualizace databáze
    if (!isset($error)) {
        $sqlUpdate = "UPDATE nabidka SET pracovnidoba = :pracovnidoba, sazba = :sazba, 
                      lokalita = :lokalita, tagy = :tagy, obr = :obr, hodnoceni = :hodnoceni
                      WHERE idnabidka = :idnabidka AND user_iduser = :iduser";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->execute([
            'pracovnidoba' => $pracovnidoba,
            'sazba' => $sazba,
            'lokalita' => $lokalita,
            'tagy' => $tagy,
            'obr' => $obr,
            'hodnoceni' => $hodnoceni,
            'idnabidka' => $idnabidka,
            'iduser' => $iduser
        ]);

        // Nastavení úspěšné zprávy a přesměrování
        $_SESSION['success'] = "Nabídka byla úspěšně aktualizována!";
        header("Location: profil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
    <head>
        <title>Upravit nabídku</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="styly.css">
    </head>
    <body class="bg-light">
        <?php include 'header.php'; ?>
        <div class="container my-5">
            <h2>Upravit nabídku</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow">
                <!-- Obrázek nabídky -->
                <div class="text-center mb-3">
                    <img src="img/<?php echo htmlspecialchars($nabidka['obr']); ?>" alt="Nabídka" class="img-thumbnail" width="150">
                </div>

                <div class="form-group">
                    <label for="obr">Změnit obrázek:</label>
                    <input type="file" class="form-control" name="obr">
                </div>

                <div class="form-group">
                    <label for="pracovnidoba">Pracovní doba:</label>
                    <input type="text" class="form-control" id="pracovnidoba" name="pracovnidoba" value="<?php echo htmlspecialchars($nabidka['pracovnidoba']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="sazba">Sazba (Kč/h):</label>
                    <input type="number" class="form-control" id="sazba" name="sazba" value="<?php echo htmlspecialchars($nabidka['sazba']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="lokalita">Lokalita:</label>
                    <input type="text" class="form-control" id="lokalita" name="lokalita" value="<?php echo htmlspecialchars($nabidka['lokalita']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="tagy">Tagy (oddělené čárkou):</label>
                    <input type="text" class="form-control" id="tagy" name="tagy" value="<?php echo htmlspecialchars($nabidka['tagy']); ?>">
                </div>

                <div class="form-group">
                    <label for="hodnoceni">Hodnocení (0-5):</label>
                    <input type="number" class="form-control" id="hodnoceni" name="hodnoceni" value="<?php echo htmlspecialchars($nabidka['hodnoceni']); ?>" step="0.1" min="0" max="5">
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Uložit změny</button>
                <a href="profil.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Zpět</a>
            </form>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
