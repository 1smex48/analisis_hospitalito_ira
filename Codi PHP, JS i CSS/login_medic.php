<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login_medic.css">
    <title>Hospitalito - Àrea Metge</title>
</head>
<body>
    <header class="header">
        <h1>Hospitalito IRA</h1>
    </header>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../">Inici</a></li>
            <li class="nav-item"><a class="nav-link" href="login_pacient.php">Àrea Pacient</a></li>
        </ul>
    </nav>
    <section>
        <h2>ÀREA METGE</h2>
        <div class="content">
            <p style="text-align:center">Per accedir a l'àrea si ets metge, introdueix el teu DNI i contrasenya.</p>
        </div>
    </section>
    <main>
        <div class="login-container">
            <form action="login_medic.php" method="post">
                <div>
                    <label for="dni">DNI:</label>
                    <input type="text" id="dni" name="dni" required>
                </div>
                <div>
                    <label for="password">Contrasenya:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dni = $_POST['dni'];
                $password = $_POST['password'];

                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=analisis_hospitalito_ira', 'adminmysql', 'P@ssw0rd');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->prepare('SELECT Contrasenya FROM medic WHERE DNI_Medic = :dni');
                    $stmt->execute([':dni' => $dni]);

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        $hashed_password = $row['Contrasenya'];

                        if (password_verify($password, $hashed_password)) {
                            header('Location: enviar_resultats.php');
                            exit();
                        } else {
                            echo '<div>Contraseña incorrecta.</div>';
                        }
                    } else {
                        echo '<div>DNI no encontrado.</div>';
                    }
                } catch (PDOException $e) {
                    echo '<div>Error: ' . $e->getMessage() . '</div>';
                }
            }
            ?>
        </div>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Hospitalito. Tots els drets reservats.</p>
    </footer>
    <script src="js/login.js"></script>
</body>
</html>
