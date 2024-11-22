<!DOCTYPE html>
<html>
<head>
    <title>Login Pacient</title>
</head>
<body>
    <h2>Hospitalito IRA - Analisis</h2>
    <form method="post" action="">
        <label for="dni_pacient">DNI Pacient:</label>
        <input type="text" id="dni_pacient" name="dni_pacient" required><br><br>
        <label for="id_analisis">ID Análisis:</label>
        <input type="text" id="id_analisis" name="id_analisis" required><br><br>
        <label for="tipo_analisis">Tipo de Análisis:</label>
        <select id="tipo_analisis" name="tipo_analisis" required>
            <option value="sang">Análisis de Sangre</option>
            <option value="orina">Análisis de Orina</option>
            <option value="eses">Análisis de Eses</option>
        </select><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

<?php
include 'connect_database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y sanitizar los datos de entrada
    $dni_pacient = filter_input(INPUT_POST, 'dni_pacient', FILTER_SANITIZE_STRING);
    $id_analisis = filter_input(INPUT_POST, 'id_analisis', FILTER_SANITIZE_STRING);
    $tipo_analisis = filter_input(INPUT_POST, 'tipo_analisis', FILTER_SANITIZE_STRING);

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
        // Almacenar variables en la sesión
        $_SESSION['dni_pacient'] = $dni_pacient;
        $_SESSION['id_analisis'] = $id_analisis;
        $_SESSION['tipo_analisis'] = $tipo_analisis;

        // Redirigir a la página de resultados
        header("Location: resultat_analisis.php");
        exit();
    } else {
        echo "Identificador de análisis no válido.";
    }

    $stmt->close();
    $conn->close();
}
?>