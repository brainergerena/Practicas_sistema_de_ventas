<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $codfabrica = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM fabrica WHERE codfabrica = $codfabrica");
    mysqli_close($conexion);
    header("location: lista_productos_fabrica.php");
}
?>