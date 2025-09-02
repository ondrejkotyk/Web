<?php
require('propojeni_databaze_local.php');

$errors = [];
$success = false;

// Pokud byl formulář odeslán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře
    $jmeno = trim($_POST['jmeno']);
    $prijmeni = trim($_POST['prijmeni']);
    $tagy = trim($_POST['tagy']);
    $lokalita = trim($_POST['lokalita']);
    $pracovnidoba = trim($_POST['pracovnidoba']);
    $sazba = trim($_POST['sazba']);
    $popis = trim($_POST['popis']);

    // Validace vstupů
    if (empty($jmeno)) $errors[] = "Jméno je povinné.";
    if (empty($prijmeni)) $errors[] = "Příjmení je povinné.";
    if (empty($tagy)) $errors[] = "Musíte zadat alespoň jedno zaměření práce.";
    if (empty($lokalita)) $errors[] = "Lokalita je povinná.";
    if (empty($pracovnidoba)) $errors[] = "Pracovní doba je povinná.";
    if (!is_numeric($sazba) || $sazba <= 0) $errors[] = "Sazba musí být platné číslo větší než 0.";
    if (empty($popis)) $errors[] = "Popis nemůže být prázdný.";

    // Zpracování nahrávání obrázku
    if (!empty($_FILES['obr']['name'])) {
        $target_dir = "img/"; // Cesta k ukládání obrázků
        $imageFileType = strtolower(pathinfo($_FILES["obr"]["name"], PATHINFO_EXTENSION));
        $newFileName = uniqid('foto_') . '.' . $imageFileType; // Unikátní název souboru
        $target_file = $target_dir . $newFileName;

        // Kontrola typu souboru
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $errors[] = "Povolené formáty jsou JPG, JPEG, PNG a GIF.";
        }

        // Kontrola velikosti (max 2MB)
        if ($_FILES["obr"]["size"] > 2 * 1024 * 1024) {
            $errors[] = "Soubor nesmí být větší než 2 MB.";
        }

        // Uložení souboru, pokud nejsou chyby
        if (empty($errors)) {
            if (!move_uploaded_file($_FILES["obr"]["tmp_name"], $target_file)) {
                $errors[] = "Chyba při nahrávání obrázku.";
            }
        }
    } else {
        $errors[] = "Musíte nahrát fotografii.";
    }

    // Pokud nejsou chyby, vložíme data do databáze
    if (empty($errors)) {
        try {
            $conn->beginTransaction();

            // Vložení uživatele do tabulky "user"
            $stmt = $conn->prepare("INSERT INTO user (jmeno, prijmeni) VALUES (:jmeno, :prijmeni)");
            $stmt->execute([
                ':jmeno' => $jmeno,
                ':prijmeni' => $prijmeni
            ]);
            $user_id = $conn->lastInsertId(); // Získání ID nového uživatele

            // Vložení nabídky do tabulky "nabidka"
            $stmt = $conn->prepare("INSERT INTO nabidka (hodnoceni, pracovnidoba, sazba, lokalita, tagy, obr, user_iduser) 
                                    VALUES ('0/5', :pracovnidoba, :sazba, :lokalita, :tagy, :obr, :user_iduser)");
            $stmt->execute([
                ':pracovnidoba' => $pracovnidoba,
                ':sazba' => $sazba . ' Kč/h',
                ':lokalita' => $lokalita,
                ':tagy' => $tagy,
                ':obr' => $newFileName, // Uložíme název souboru do databáze
                ':user_iduser' => $user_id
            ]);

            $conn->commit();
            $success = true;
        } catch (Exception $e) {
            $conn->rollBack();
            $errors[] = "Chyba při vkládání do databáze: " . $e->getMessage();
        }
    }
}



?>


?>
<!doctype html>
<html lang="cs">

    <head>
        <title>Hodinový manžel/ka</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- CSS -->
        <link rel="stylesheet" href="styly.css">
    </head>

    <body class="bg-light">

        <div class="container">   
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

            <?php
            include 'header.php';
            ?>

            <div id="customFormContainer" class="container">
                <form id="customForm" class="bg-light p-4 rounded shadow" method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="formFirstName">Jméno:</label>
                        <input type="text" class="form-control" name="jmeno" id="formFirstName" placeholder="Zadejte jméno" required>
                    </div>
                    <div class="form-group">
                        <label for="formLastName">Příjmení:</label>
                        <input type="text" class="form-control" name="prijmeni" id="formLastName" placeholder="Zadejte příjmení" required>
                    </div>
                    <div class="form-group">
                        <label for="formWorkField">Zaměření práce (tagy):</label>
                        <input type="text" class="form-control" name="tagy" id="formWorkField" placeholder="Montáž nábytku, Elektro-instalace ..." required>
                    </div>
                    <div class="form-group">
                        <label for="formLocation">Lokalita:</label>
                        <input type="text" class="form-control" name="lokalita" id="formLocation" placeholder="Středočeský kraj" required>
                    </div>
                    <div class="form-group">
                        <label for="formWorkHours">Pracovní doba:</label>
                        <input type="text" class="form-control" name="pracovnidoba" id="formWorkHours" placeholder="Po, St, So 16-20 hodin" required>
                    </div>
                    <div class="form-group">
                        <label for="formRate">Sazba na hodinu (Kč/h):</label>
                        <input type="number" class="form-control" name="sazba" id="formRate" placeholder="300" required>
                    </div>
                    <div class="form-group">
                        <label for="formDescription">Osobní popis:</label>
                        <textarea class="form-control" name="popis" id="formDescription" rows="5" placeholder="Zadejte osobní popis" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="formPhoto">Fotografie:</label>
                        <input type="file" class="form-control-file" name="obr" id="formPhoto" required>
                    </div>
                    <div class="form-buttons d-flex justify-content-between">
                        <button type="button" class="btn btn-danger" id="formCancelBtn">Zrušit</button>
                        <button type="submit" class="btn btn-primary" id="formSubmitBtn">Zveřejnit</button>
                    </div>
                </form>
            </div>



        </div>

        <?php
        include 'footer.php';
        ?>

        <script>
            $(function () {
                $('[data-toggle="popover"]').popover();
            });
            $('html').on('click', function (e) {
                if (typeof $(e.target).data('original-title') == 'undefined' &&
                        !$(e.target).parents().is('.popover.in')) {
                    $('[data-original-title]').popover('hide');
                }
            });

            document.getElementById('offerServicesBtn').addEventListener('click', showLoginRegister);
            document.getElementById('needHelpBtn').addEventListener('click', showLoginRegister);
            document.querySelector('.cancelbtn').addEventListener('click', resetToInitialState);

            function showLoginRegister() {
                // Skryj sekci výběru práce
                document.getElementById('workSelection').classList.add('d-none');
                // Zobraz sekci přihlášení nebo registrace
                document.getElementById('loginRegister').classList.remove('d-none');
            }

            function resetToInitialState() {
                // Zobraz sekci výběru práce
                document.getElementById('workSelection').classList.remove('d-none');
                // Skryj sekci přihlášení nebo registrace
                document.getElementById('loginRegister').classList.add('d-none');
            }
        </script>


    </body>


</html>