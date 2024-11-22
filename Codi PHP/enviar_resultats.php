<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Resultados de Análisis</title>
</head>
<body>
    <div>
        <h2>Enviar Resultados de Análisis</h2>
        <form action="enviar_resultats.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="tipo_analisis">Tipus d'Anàlisi:</label>
                <select id="tipo_analisis" name="tipo_analisis" required>
                    <option value="sang">Anàlisi de Sang</option>
                    <option value="orina">Anàlisi d'Orina</option>
                    <option value="eses">Anàlisi d'Eses</option>
                </select>
            </div>
            <div>
                <label for="resultados">Resultats (Arxiu JSON):</label>
                <input type="file" id="resultados" name="resultados" accept=".json" required>
            </div>
            <button type="submit" name="submit">Enviar</button>
        </form>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>

        <?php
        session_start();

        if (isset($_POST['logout'])) {
            // Destruir la sesión y redirigir al usuario a la página de inicio de sesión
            session_destroy();
            header("Location: login_medic.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            // Obtener los datos del formulario
            $tipo_analisis = $_POST['tipo_analisis'];

            // Verificar si se ha subido un archivo
            if (isset($_FILES['resultados']) && $_FILES['resultados']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['resultados']['tmp_name'];
                $fileName = $_FILES['resultados']['name'];
                $fileSize = $_FILES['resultados']['size'];
                $fileType = $_FILES['resultados']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                
                // Verificar la extensión del archivo
                if ($fileExtension === 'json') {
                    // Leer el contenido del archivo JSON
                    $jsonContent = file_get_contents($fileTmpPath);
                    $resultados = json_decode($jsonContent, true);
                
                    if (json_last_error() === JSON_ERROR_NONE) {
                        try {
                            // Conectar a la base de datos usando PDO
                            $pdo = new PDO('mysql:host=localhost;dbname=analisis_hospitalito_ira', 'adminmysql', 'P@ssw0rd');
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // Determinar la tabla y la consulta SQL según el tipo de análisis
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

                            // Iterar sobre los resultados y ejecutar la consulta para cada registro
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
</body>
</html>