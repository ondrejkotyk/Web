<?php
require('propojeni_databaze_local.php');
?>

<!doctype html>
<html lang="cs">
    <head>
        <title>Můj profil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="styly.css">
    </head>

    <body class="bg-light">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <?php
        include 'header.php';
        if (!isset($_SESSION['iduser'])) {
            header("Location: login.php");
            exit();
        }

        $iduser = $_SESSION['iduser'];

// Načtení údajů o uživateli
        $sqlUser = "SELECT jmeno, prijmeni, tel, email, lokalita, popis, tagy, obr FROM user WHERE iduser = :iduser";
        $stmtUser = $conn->prepare($sqlUser);
        $stmtUser->execute(['iduser' => $iduser]);
        $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Uživatel nenalezen.");
        }

// Určení obrázku profilu
        $profilObr = !empty($user['obr']) ? "img/" . htmlspecialchars($user['obr']) : "img/profil_default.png";

// Načtení uživatelských nabídek
        $sqlNabidky = "SELECT idnabidka, hodnoceni, pracovnidoba, sazba, lokalita, tagy, obr FROM nabidka WHERE user_iduser = :iduser";
        $stmtNabidky = $conn->prepare($sqlNabidky);
        $stmtNabidky->execute(['iduser' => $iduser]);
        $nabidky = $stmtNabidky->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container my-4">
            <h1 style="margin-top: 9%;">Můj účet</h1>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); // Zpráva se zobrazí jen jednou ?>
            <?php endif; ?>


            <div id="card" class="d-flex bg-white p-4 rounded shadow mb-4">
                <!-- Obrázek -->
                <div class="obrazekNabidka">
                    <img src="<?php echo $profilObr; ?>" alt="<?php echo htmlspecialchars($user['jmeno']); ?>" class="img-fluid rounded">
                </div>
                <!-- Textová část -->
                <div class="flex-grow-1">
                    <div id="profile-nab">
                        <h2><?php echo htmlspecialchars($user['jmeno'] . " " . $user['prijmeni']); ?></h2>
                        <div id="btn-edit" class="form-buttons d-flex justify-content-between">
                            <button onclick="location.replace('upravit_profil.php')" class="btn btn-primary">Upravit</button>
                        </div>
                    </div>
                    <!-- Tagy -->
                    <div id="profil-tags" class="d-flex flex-wrap mb-2">
                        <?php
                        if (!empty($user['tagy'])) {
                            foreach (explode(", ", $user['tagy']) as $tag) {
                                echo '<span class="badge badge-primary mx-1">' . htmlspecialchars($tag) . '</span>';
                            }
                        } else {
                            echo '<p class="text-muted">Žádné dovednosti uvedeny.</p>';
                        }
                        ?>
                    </div>
                    <!-- Popis -->
                    <p><?php echo htmlspecialchars($user['popis']); ?></p>
                    <!-- Lokalita, telefon, email -->
                    <p class="mb-1"><strong>Lokalita:</strong> <?php echo htmlspecialchars($user['lokalita']); ?></p>
                    <p class="mb-1"><strong>Telefon:</strong> <?php echo htmlspecialchars($user['tel']); ?></p>
                    <p class="mb-1"><strong>E-mail:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>

            <div class="profil-nabidka">
                <h1>Moje nabídky</h1>

                <?php if (count($nabidky) > 0): ?>
                    <?php foreach ($nabidky as $nabidka): ?>
                        <div class="bg-white p-3 mb-4 rounded shadow layout nabidka-card">
                            <div class="d-flex align-items-center">
                                <!-- Obrázek nabídky -->
                                <div class="mr-3">
                                    <img src="img/<?php echo htmlspecialchars($nabidka['obr']); ?>" alt="Nabídka" class="img-thumbnail rounded" width="120">
                                </div>

                                <!-- Textová část -->
                                <div class="flex-grow-1">
                                    <h4 class="font-weight-bold">
                                        <a href="nabidkaDetail.php?id=<?php echo $nabidka['idnabidka']; ?>" class="text-dark text-decoration-none">
                                            <?php echo htmlspecialchars($_SESSION['jmeno'] . " " . $_SESSION['prijmeni']); ?>
                                        </a>
                                    </h4>

                                    <!-- Tagy -->
                                    <div class="d-flex flex-wrap mb-2">
                                        <?php
                                        foreach (explode(", ", $nabidka['tagy']) as $tag) {
                                            echo '<span class="badge badge-primary mx-1">' . htmlspecialchars($tag) . '</span>';
                                        }
                                        ?>
                                    </div>

                                    <!-- Lokalita, sazba -->
                                    <p class="mb-1"><strong>Lokalita:</strong> <?php echo htmlspecialchars($nabidka['lokalita']); ?></p>
                                    <p class="mb-1"><strong>Sazba:</strong> <strong><?php echo htmlspecialchars($nabidka['sazba']); ?> Kč/h</strong></p>
                                </div>

                                <!-- Pracovní doba, hodnocení -->
                                <div class="text-right">
                                    <p class="mb-1"><strong>Pracovní doba:</strong> <?php echo htmlspecialchars($nabidka['pracovnidoba']); ?></p>
                                    <p class="mb-1"><strong>Hodnocení:</strong> <?php echo htmlspecialchars($nabidka['hodnoceni']); ?>/5 ⭐</p>
                                </div>
                            </div>

                            <!-- Tlačítko Upravit nabídku -->
                            <div class="d-flex justify-content-end mt-3">
                                <a href="upravit_nabidku.php?id=<?php echo $nabidka['idnabidka']; ?>" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Upravit nabídku
                                </a>
                            </div>


                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Nemáte žádné nabídky.</p>
                <?php endif; ?>
            </div>


            <div id="customFormContainerPreview" class="container">
                <h1>Změnit heslo</h1>
                <form action="zmenit_heslo.php" method="POST" class="bg-light p-4 rounded shadow">
                    <div class="form-group">
                        <label for="formPass">Nové heslo:</label>
                        <input type="password" class="form-control" id="formPass" name="heslo" placeholder="Zadejte nové heslo">
                    </div>
                    <div class="form-group">
                        <label for="formPassVer">Heslo znovu:</label>
                        <input type="password" class="form-control" id="formPassVer" name="heslo2" placeholder="Zadejte heslo pro ověření">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Uložit</button>
                </form>
            </div>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
