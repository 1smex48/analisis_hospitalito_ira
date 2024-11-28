<?php
include 'connect_database.php';
session_start();

$dni_pacient = $_SESSION['dni_pacient'];
$id_analisis = $_SESSION['id_analisis'];
$tipo_analisis = $_SESSION['tipo_analisis'];

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/resultat_analisis.css">
    <title>Resultats Anàlisi</title>
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
        <h2>Resultats de l'Anàlisi</h2>
        <?php

        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: login_pacient.php");
            exit();
        }

        if ($tipo_analisis == "sang") {
            $sql = "SELECT Tipus_Sang AS 'Tipus de sang', Nivells_glucosa AS 'Nivells de glucosa', Colesterol AS 'Nivell de colesterol', Recompte_celules_sanguineas AS 'Recompte de cel·lules sanguineas', Deficit_nutriens AS 'Deficit de nutriens', Hormones AS 'Nivell de hormones' FROM analisis_sang WHERE DNI_Pacient = '$dni_pacient' AND ID_Sang = $id_analisis";
        } elseif ($tipo_analisis == "eses") {
            $sql = "SELECT Color AS 'Color', Consistencia AS 'Consistència', Parasits AS 'Paràsits' FROM analisis_eses WHERE DNI_Pacient = '$dni_pacient' AND ID_Eses = $id_analisis";
        } elseif ($tipo_analisis == "orina") {
            $sql = "SELECT Color AS 'Color', Olor AS 'Olor', Densitat AS 'Densitat', pH AS 'pH', Nitrits AS 'Nitrits', Proteines AS 'Proteïnes', Glucosa AS 'Glucosa', Cetones AS 'Cetones', Bilirubina AS 'Bilirubina', Urobilinogen AS 'Urobilinogen', Hemoglobina AS 'Hemoglobina', Leucocits AS 'Leucòcits', Eritrocits AS 'Eritròcits', Cilindres AS 'Cilindres', Cristalls AS 'Cristalls', Bacteris AS 'Bacteris' FROM analisis_orina WHERE DNI_Pacient = '$dni_pacient' AND ID_Orina = $id_analisis";
        } 

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table border='1' class='result-table'>";
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $field => $value) {
                    echo "<tr>";
                    echo "<th>{$field}</th>";
                    echo "<td class='value'>{$value}</td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        } else {
            echo "<p>No s'han trobat resultats.</p>";
        }

        $conn->close();
        ?>
        <form method="post">
            <button type="submit" name="logout">Tancar Sessió</button>
        </form>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Hospitalito. Tots els drets reservats.</p>
    </footer>
    <script src="js/resultat_analisis.js"></script>
</body>
</html>
