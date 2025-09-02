<?php
// header.php
?>

<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a id="logo" class="navbar-brand mr-3" href="index.php">
            <img id="logo_img" src="img/logo.png" alt="Logo">
            Hodinové práce s.r.o
        </a>

        <button id="nabidnoutPraci" type="button" class="btn btn-light order-3 btn-md border border-light" onclick="document.getElementById('id01').style.display = 'block'">
            <i class="fas fa-user-plus"></i> Nabídnout práci!
        </button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div id="praceMenu" class="navbar-nav align-items-center">
                <div class="dropdown mx-2">
                    <button class="btn btn-primary prace" type="button" onclick="location.replace('nabidka.php')" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-briefcase"></i> Nabídky práce
                    </button>
                </div>

                <div class="dropdown mx-2">
                    <button class="btn btn-primary prace" type="button" onclick="location.replace('poptavka.php')" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-search"></i> Poptávka práce
                    </button>
                </div>
            </div>

            <!-- Uživatel je přihlášen -->
            <?php if (isset($_SESSION['iduser'])): ?>
                <div class="dropdown ml-3">
                    <button style="background-color: #007bff;" class="btn btn-primary dropdown-toggle" type="button" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['jmeno'] . " " . $_SESSION['prijmeni']); ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="userMenu">
                        <a class="dropdown-item" href="profil.php"><i class="fas fa-user-circle"></i> Můj účet</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt"></i> Odhlásit se</a>
                    </div>
                </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div id="id01" class="modal">
    <div class="modal-content animate">
        <div class="container">
            <div class="container my-4">
                <!-- Sekce výběru práce -->
                <div id="workSelection" class="custom-work-selection bg-light p-4 rounded shadow">
                    <h3 class="custom-heading">O jakou práci se jedná?</h3>
                    <div class="custom-button-group">
                        <button <?php if (isset($_SESSION['iduser'])): ?> onclick="location.replace('nabizim.php')" <?php endif; ?> id="offerServicesBtn" class="btn custom-btn-primary">Nabízím služby</button>
                        <button <?php if (isset($_SESSION['iduser'])): ?>onclick="location.replace('poptavam.php')" <?php endif; ?> id="needHelpBtn" class="btn custom-btn-secondary">Potřebuji pomoc</button>
                    </div>
                </div>

                <?php if (!isset($_SESSION['iduser'])): ?>
                    <div id="loginRegister" class="custom-login-register bg-light p-4 rounded shadow mt-4 d-none">
                        <h3 class="custom-heading">Nabízíte práci poprvé?</h3>
                        <div class="custom-button-group">
                            <button id="loginBtn" class="btn custom-btn-primary">Přihlásit se</button>
                            <button id="registerBtn" class="btn custom-btn-secondary">Registrovat se</button>
                            <div>
                                <h5>Nabídnout jednorázově</h5>
                                <button onclick="location.replace('nabizim.php')" class="btn btn-info">Nabídnout práci</button>
                                <button onclick="location.replace('poptavam.php')" class="btn btn-primary">Poptat práci</button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>




                <div id="loginError" class="alert alert-danger d-none" role="alert"></div>
                <form id="loginForm" class="bg-light p-4 rounded shadow mt-4 d-none">
                    <h3 class="custom-heading">Přihlášení</h3>
                    <div class="form-group">
                        <label for="loginEmail">E-mail:</label>
                        <input type="email" class="form-control" id="loginEmail" name="email" placeholder="např. jan.novak@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Heslo:</label>
                        <input type="password" class="form-control" id="loginPassword" name="heslo" placeholder="Zadejte své heslo" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Přihlásit se</button>
                </form>

                <!-- Chybová hláška -->
                <div id="registerError" class="alert alert-danger d-none" role="alert"></div>
                <form id="registerForm" class="bg-light p-4 rounded shadow mt-4 d-none">
                    <h3 class="custom-heading">Registrace</h3>
                    <div class="form-group">
                        <label for="regJmeno">Jméno:</label>
                        <input type="text" class="form-control" id="regJmeno" name="jmeno" placeholder="např. Jan" required>
                    </div>
                    <div class="form-group">
                        <label for="regPrijmeni">Příjmení:</label>
                        <input type="text" class="form-control" id="regPrijmeni" name="prijmeni" placeholder="např. Novák" required>
                    </div>
                    <div class="form-group">
                        <label for="regTel">Telefon:</label>
                        <input type="tel" class="form-control" id="regTel" name="tel" placeholder="+420123456789" required>
                    </div>
                    <div class="form-group">
                        <label for="regEmail">E-mail:</label>
                        <input type="email" class="form-control" id="regEmail" name="email" placeholder="např. jan.novak@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="tagy">Oblasti práce:</label>
                        <input type="text" class="form-control" id="tagy" name="tagy" placeholder="Práce na zahradě, Malování..." required>
                    </div>
                    <div class="form-group">
                        <label for="popis">Pár slov o sobě:</label>
                        <textarea class="form-control" id="popis" name="popis" rows="4" placeholder="Ve volném čase se věnuji, umím...." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="regHeslo">Heslo:</label>
                        <input type="password" class="form-control" id="regHeslo" name="heslo" placeholder="Zadejte heslo" required>
                    </div>
                    <div class="form-group">
                        <label for="passw2">Heslo znovu:</label>
                        <input type="password" class="form-control" id="passw2" name="passw2" placeholder="Zadejte heslo znovu" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Registrovat se</button>
                </form>



            </div>

            <div class="d-flex justify-content-center">
                <button type="button" onclick="closeModal()" class="cancelbtn rounded btn btn-danger">Zrušit</button>
            </div>
        </div>
    </div>
</div>

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
    document.getElementById('loginBtn').addEventListener('click', showLoginForm);
    document.querySelector('.cancelbtn').addEventListener('click', closeModal);

    function showLoginRegister() {
        document.getElementById('workSelection').classList.add('d-none');
        document.getElementById('loginRegister').classList.remove('d-none');
    }

    function showLoginForm() {
        document.getElementById('loginRegister').classList.add('d-none');
        document.getElementById('loginForm').classList.remove('d-none');
    }

    function closeModal() {
        document.getElementById('id01').style.display = 'none'; // Skryje celý modal
        resetToInitialState(); // Vrátí modal do původního stavu
    }

    function resetToInitialState() {
        document.getElementById('workSelection').classList.remove('d-none');
        document.getElementById('loginRegister').classList.add('d-none');
        document.getElementById('loginForm').classList.add('d-none');
    }

    document.getElementById('loginBtn').addEventListener('click', function () {
        document.getElementById('loginRegister').classList.add('d-none');
        document.getElementById('loginForm').classList.remove('d-none');
    });

    document.getElementById('registerBtn').addEventListener('click', function () {
        document.getElementById('loginRegister').classList.add('d-none');
        document.getElementById('registerForm').classList.remove('d-none');
    });

    function closeModal() {
        document.getElementById('id01').style.display = 'none';
        document.getElementById('workSelection').classList.remove('d-none');
        document.getElementById('loginRegister').classList.add('d-none');
        document.getElementById('loginForm').classList.add('d-none');
        document.getElementById('registerForm').classList.add('d-none');
    }

</script>

<script>
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch('login.php', {
            method: 'POST',
            body: formData
        })
                .then(response => response.json())
                .then(data => {
                    console.log("Server response:", data); // Debugging log

                    if (data.status === 'success') {
                        window.location.replace('index.php');
                    } else {
                        let errorMessage = document.getElementById('loginError');
                        errorMessage.innerText = data.message;
                        errorMessage.classList.remove('d-none'); // Oprava - zobrazit error box

                        let errorField = document.getElementById(data.field);
                        if (errorField) {
                            errorField.classList.add('is-invalid');
                            errorField.focus(); // Přidá kurzor do chybného pole
                        }
                    }
                })
                .catch(error => {
                    console.error("Chyba v komunikaci s serverem:", error);
                    alert("Došlo k chybě při komunikaci se serverem. Zkuste to znovu.");
                });
    });

// Reset červených polí při změně vstupu
    document.querySelectorAll('#loginForm input').forEach(input => {
        input.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            let errorMessage = document.getElementById('loginError');
            errorMessage.classList.add('d-none'); // Skryj error box při opravě
        });
    });
</script>

<script>
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let form = this;
        let formData = new FormData(form);

        fetch('register.php', {
            method: 'POST',
            body: formData
        })
                .then(response => response.json())
                .then(data => {
                    console.log("Server response:", data); // Debugging log

                    if (data.status === 'success') {
                        window.location.replace('index.php');
                    } else {
                        let errorMessage = document.getElementById('registerError');
                        errorMessage.innerText = data.message;
                        errorMessage.classList.remove('d-none'); // Oprava - zobrazit error box

                        let errorField = document.getElementById(data.field);
                        if (errorField) {
                            errorField.classList.add('is-invalid');
                            errorField.focus(); // Přidá kurzor do chybného pole
                        }
                    }
                })
                .catch(error => {
                    console.error("Chyba v komunikaci s serverem:", error);
                    alert("Došlo k chybě při komunikaci se serverem. Zkuste to znovu.");
                });
    });

// Reset červených polí při změně vstupu
    document.querySelectorAll('#registerForm input').forEach(input => {
        input.addEventListener('input', function () {
            this.classList.remove('is-invalid');
            let errorMessage = document.getElementById('registerError');
            errorMessage.classList.add('d-none'); // Skryj error box při opravě
        });
    });
</script>

