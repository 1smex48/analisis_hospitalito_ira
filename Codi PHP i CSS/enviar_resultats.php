<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/enviar_resultats.css">
    <title>Enviar Resultats d'Anàlisi</title>
</head>
<body>
    <header class="header">
        <h1>Hospitalito IRA</h1>
    </header>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../">Inici</a></li>
            <li class="nav-item"><a class="nav-link" href="login_medic.php">Àrea Metge</a></li>
            <li class="nav-item"><a class="nav-link" href="login_pacient.php">Àrea Pacient</a></li>
        </ul>
    </nav>
    <main>
        <div>
            <h2>Enviar Resultats d'Anàlisi</h2>
            <form action="enviar_resultats.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tipo_analisis">Tipus d'Anàlisi:</label>
                    <select id="tipo_analisis" name="tipo_analisis" required>
                        <option value="sang">Anàlisi de Sang</option>
                        <option value="orina">Anàlisi d'Orina</option>
                        <option value="eses">Anàlisi d'Eses</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="resultados">Resultats (Arxiu JSON):</label>
                    <input type="file" id="resultados" name="resultados" accept=".json" required>
                </div>
                <button type="submit" name="submit">Enviar</button>
            </form>
            <form method="post">
                <button type="submit" name="logout">Tancar Sessió</button>
            </form>

            <?php
            session_start();

            if (isset($_POST['logout'])) {
                // Destruir la sessió i redirigir l'usuari a la pàgina d'inici de sessió
                session_destroy();
                header("Location: login_medic.php");
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                // Obtenir les dades del formulari
                $tipo_analisis = $_POST['tipo_analisis'];

                // Verificar si s'ha pujat un arxiu
                if (isset($_FILES['resultados']) && $_FILES['resultados']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['resultados']['tmp_name'];
                    $fileName = $_FILES['resultados']['name'];
                    $fileSize = $_FILES['resultados']['size'];
                    $fileType = $_FILES['resultados']['type'];
                    $fileNameCmps = explode(".", $fileName);
                    $fileExtension = strtolower(end($fileNameCmps));
                    
                    // Verificar l'extensió de l'arxiu
                    if ($fileExtension === 'json') {
                        // Llegir el contingut de l'arxiu JSON
                        $jsonContent = file_get_contents($fileTmpPath);
                        $resultados = json_decode($jsonContent, true);
                    
                        if (json_last_error() === JSON_ERROR_NONE) {
                            try {
                                // Connectar a la base de dades usant PDO
                                $pdo = new PDO('mysql:host=localhost;dbname=analisis_hospitalito_ira', 'adminmysql', 'P@ssw0rd');
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                // Determinar la taula i la consulta SQL segons el tipus d'anàlisi
                                switch ($tipo_analisis) {
                                    case 'eses':
                                        $stmt = $pdo->prepare('INSERT INTO analisis_eses (Color, Consistencia, Parasits, DNI_Pacient) VALUES (:Color, :Consistencia, :Parasits, :DNI_Pacient)');
                                        break;
                                    case 'orina':
                                        $stmt = $pdo->prepare('INSERT INTO analisis_orina (Color, Olor, Densitat, pH, Nitrits, Proteines, Glucosa, Cetones, Bilirubina, Urobilinogen, Hemoglobina, Leucocits, Eritrocits, Cilindres, Cristalls, Bacteris, DNI_Pacient) VALUES (:Color, :Olor, :Densitat, :pH, :Nitrits, :Proteines, :Glucosa, :Cetones, :Bilirubina, :Urobilinogen, :Hemoglobina, :Leucocits, :Eritrocits, :Cilindres, :Cristalls, :Bacteris, :DNI_Pacient)');
                                        break;
                                    case 'sang':
                                        $stmt = $pdo->prepare('INSERT INTO analisis_sang (Tipus_Sang, Nivells_glucosa, Colesterol, Recompte_celules_sanguineas, Deficit_nutriens, Hormones, DNI_Pacient) VALUES (:Tipus_SANG, :Nivells_glucosa, :Colesterol, :Recompte_celules_sanguineas, :Deficit_nutriens, :Hormones, :DNI_Pacient)');
                                        break;
                                    default:
                                        throw new Exception('Tipus d\'anàlisi no vàlid.');
                                }

                                // Iterar sobre els resultats i executar la consulta per a cada registre
                                foreach ($resultados as $resultado) {
                                    $stmt->execute($resultado);
                                }

                                echo '<div>Resultats enviats exitosament.</div>';
                            } catch (PDOException $e) {
                                echo '<div>Error: ' . $e->getMessage() . '</div>';
                            } catch (Exception $e) {
                                echo '<div>Error: ' . $e->getMessage() . '</div>';
                            }
                        } else {
                            echo '<div>Error: L\'arxiu JSON no és vàlid.</div>';
                        }
                    } else {
                        echo '<div>Error: Només es permeten arxius JSON.</div>';
                    }
                }
            }
            ?>
        </div>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Hospitalito. Tots els drets reservats.</p>
    </footer>
    <script src="js/enviar_resultats.js"></script>
</body>
</html>
