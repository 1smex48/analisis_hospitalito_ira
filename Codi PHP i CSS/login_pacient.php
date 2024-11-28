<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login_pacient.css">
    <title>Hospitalito - Àrea Pacient</title>
</head>
<body>
    <header class="header">
        <h1>Hospitalito IRA</h1>
    </header>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../">Inici</a></li>
            <li class="nav-item"><a class="nav-link" href="login_medic.php">Àrea Metge</a></li>
        </ul>
    </nav>
    <section>
        <h2>ÀREA PACIENT</h2>
        <div class="content">
            <p style="text-align:center">Per accedir a l'àrea si ets pacient, introdueix el teu DNI i l'ID de l'anàlisi.</p>
        </div>
    </section>
    <main>
        <div class="login-container">
            <form method="post" action="">
                <div>
                    <label for="dni_pacient">DNI Pacient:</label>
                    <input type="text" id="dni_pacient" name="dni_pacient" required>
                </div>
                <div>
                    <label for="id_analisis">ID Anàlisi:</label>
                    <input type="text" id="id_analisis" name="id_analisis" required>
                </div>
                <div>
                    <label for="tipo_analisis">Tipus d'Anàlisi:</label>
                    <select id="tipo_analisis" name="tipo_analisis" required>
                        <option value="sang">Anàlisi de Sang</option>
                        <option value="orina">Anàlisi d'Orina</option>
                        <option value="eses">Anàlisi de Femtes</option>
                    </select>
                </div>
                <button type="submit">Accedeix als Resultats</button>
            </form>

            <?php
            include 'connect_database.php';
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $dni_pacient = filter_input(INPUT_POST, 'dni_pacient');
                $id_analisis = filter_input(INPUT_POST, 'id_analisis');
                $tipo_analisis = filter_input(INPUT_POST, 'tipo_analisis');

                if ($tipo_analisis == "eses") {
                    $stmt = $conn->prepare("SELECT ID_Eses FROM analisis_eses WHERE ID_Eses = ? AND DNI_Pacient = ?");
                    $stmt->bind_param("ss", $id_analisis, $dni_pacient);
                } elseif ($tipo_analisis == "sang") {
                    $stmt = $conn->prepare("SELECT ID_Sang FROM analisis_sang WHERE ID_Sang = ? AND DNI_Pacient = ?");
                    $stmt->bind_param("ss", $id_analisis, $dni_pacient);
                } elseif ($tipo_analisis == "orina") {
                    $stmt = $conn->prepare("SELECT ID_Orina FROM analisis_orina WHERE ID_Orina = ? AND DNI_Pacient = ?");
                    $stmt->bind_param("ss", $id_analisis, $dni_pacient);
                }

                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $_SESSION['dni_pacient'] = $dni_pacient;
                    $_SESSION['id_analisis'] = $id_analisis;
                    $_SESSION['tipo_analisis'] = $tipo_analisis;

                    header("Location: resultat_analisis.php");
                    exit();
                } else {
                    echo "Identificador de análisis no válido.";
                }

                $stmt->close();
                $conn->close();
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
