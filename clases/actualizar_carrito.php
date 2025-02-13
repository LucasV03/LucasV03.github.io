<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../config/config.php';
require '../config/database.php';
session_start();
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $id = isset($_POST['id']) ? $_POST['id'] : 0;

    if ($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($id, $cantidad);

        if ($respuesta > 0) {
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }
        $datos['sub'] =number_format($respuesta, 2, ".", ",");
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);


function agregar($id,  $cantidad){
    $res =0;
    if($id > 0 && $cantidad > 0 && is_numeric(($cantidad))){
        if(isset($_SESSION['carrito']['productos']['$id'])){
            $_SESSION['carrito']['productos'][$id]= $cantidad;

            $db = new Database();
            $con = $db->conectar();

            $sql = $con->prepare("SELECT  precio FROM productos WHERE id=? AND activo=1 LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio = $row['precio'];
            $res = $cantidad * $precio;
            return $res;
        }
    }else {
        return $res;
    }
}

