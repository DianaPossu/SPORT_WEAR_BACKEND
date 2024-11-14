<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once "../conexion.php";
    require_once "../modelos/pedido.php";

    $control = $_GET['control'];

    $pedido = new Pedido($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $pedido->consulta();
            $datosj = json_encode($vec);
            echo $datosj;
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            //$json = '{"nombre":"prueba 2"}';
            $params = json_decode($json);
            $texto_arreglo = serialize($params->productos);
            $params->productos = $texto_arreglo;
            $vec = $pedido->insertar($params);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;
        case 'productos':
                $id = $_GET['id'];
               $vec = $pedido->consultap($id);
               $datosj = json_encode($vec);
               echo $datosj;
               header('Content-Type: application/json');
        break;
        /*case 'editar':
                $json = file_get_contents('php://input');
                $params = json_decode($json);
                $id = $_GET['id'];
                $vec = $pedido->editar($id, $params);
        break;
        case 'filtro':
                $dato = $_GET['dato'];
                $vec = $pedido->filtro( $dato );
        break; */    
    }


?>
