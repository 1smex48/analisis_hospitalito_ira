<?php
include 'connect_database.php';
session_start();

// Recuperar variables de la sesión
$dni_pacient = $_SESSION['dni_pacient'];
$id_analisis = $_SESSION['id_analisis'];
$tipo_analisis = $_SESSION['tipo_analisis'];

if ($tipo_analisis == "sang") {
    $sql = "SELECT * FROM analisis_sang WHERE DNI_Pacient = '$dni_pacient' AND ID_Sang = $id_analisis";
} elseif ($tipo_analisis == "eses") {
    $sql = "SELECT * FROM analisis_eses WHERE DNI_Pacient = '$dni_pacient' AND ID_Eses = $id_analisis";
} elseif ($tipo_analisis == "orina") {
    $sql = "SELECT * FROM analisis_orina WHERE DNI_Pacient = '$dni_pacient' AND ID_Orina = $id_analisis";
} 

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    // Generar encabezados de tabla dinámicamente
    $fields = $result->fetch_fields();
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>{$field->name}</th>";
    }
    echo "</tr>";
    // Generar filas de tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>{$value}</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
?>