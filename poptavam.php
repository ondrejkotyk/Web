<?php
require('propojeni_databaze_local.php');

$errors = []; // Pole pro chybové zprávy

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře a jejich ošetření
    $nazev = trim($_POST['nazev']);
    $tel = trim($_POST['tel']);
    $email = trim($_POST['email']);
    $lokalita = trim($_POST['lokalita']);
    $tagy = trim($_POST['tagy']);
    $popis = trim($_POST['popis']);
    $user_iduser = 1; // Uprav podle přihlášeného uživatele
    // Validace vstupů
    if (empty($nazev)) {
        $errors[] = "Název je povinný.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Neplatný formát e-mailu.";
    }
    if (!preg_match('/^\+?[0-9]{9,15}$/', $tel)) {
        $errors[] = "Neplatné telefonní číslo.";
    }
    if (empty($lokalita)) {
        $errors[] = "Lokalita je povinná.";
    }
    if (empty($tagy)) {
        $errors[] = "Musíte zadat alespoň jedno klíčové slovo.";
    }
    if (empty($popis)) {
        $errors[] = "Popis nemůže být prázdný.";
    }

    // Pokud nejsou chyby, vložíme poptávku do databáze
    if (empty($errors)) {
        $sql = "INSERT INTO poptavka (nazev, lokalita, popis, tagy, user_iduser, tel, email)
        VALUES (:nazev, :lokalita, :popis, :tagy, 1, :tel, :email)"; // user_iduser = 0 natvrdo

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nazev' => $nazev,
            ':lokalita' => $lokalita,
            ':popis' => $popis,
            ':tagy' => $tagy,
            ':tel' => $tel,
            ':email' => $email
        ]);

        // Přesměrování na stránku se seznamem poptávek
        header("Location: poptavka.php?success=1");
        exit();
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
                <form id="customForm" class="bg-light p-4 rounded shadow" method="POST" action="">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($errors as $error): ?>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="formName">Název: </label>
                        <input type="text" class="form-control" name="nazev" id="formName" placeholder="Zadejte název požadavku" required>
                    </div>
                    <div class="form-group">
                        <label for="formPhone">Telefonní číslo:</label>
                        <input type="tel" class="form-control" name="tel" id="formPhone" placeholder="+420287654985" required>
                    </div>
                    <div class="form-group">
                        <label for="formEmail">Email:</label>
                        <input type="email" class="form-control" name="email" id="formEmail" placeholder="jenda.dolansky@gmial.com" required>
                    </div>
                    <div class="form-group">
                        <label for="formRate">Lokalita: </label>
                        <input type="text" class="form-control" name="lokalita" id="formRate" placeholder="Praha" required>
                    </div>
                    <div class="form-group">
                        <label for="formWorkField">Klíčová slova</label>
                        <input type="text" class="form-control" name="tagy" id="formWorkField" placeholder="zahradní práce, stavební práce ..." required>
                    </div>
                    <div class="form-group">
                        <label for="formDescription">Popis práce: </label>
                        <textarea class="form-control" name="popis" id="formDescription" rows="5" placeholder="Zadejte osobní popis" required></textarea>
                    </div>
                    <div class="form-buttons d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" id="formCancelBtn">Zrušit</button>
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