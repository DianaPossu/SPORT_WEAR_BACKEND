<?php
class Cliente {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT * FROM cliente ORDER BY nombre";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function eliminar($id) {
        $del = "DELETE FROM cliente WHERE id_cliente = $id";
        mysqli_query($this->conexion, $del);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El cliente ha sido eliminado";
        return $vec;
    }

    public function insertar($params) {
        $ins = "INSERT INTO cliente(nombre, email) VALUES('$params->nombre', '$params->email')";
        mysqli_query($this->conexion, $ins);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El cliente ha sido guardado";
        return $vec;
    }

    public function editar($id, $params) {
        $editar = "UPDATE cliente SET nombre = '$params->nombre', email = '$params->email' WHERE id_cliente = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El cliente ha sido editado";
        return $vec;
    }

    public function filtro($dato) {
        $con = "SELECT c.*, ci.municipio AS municipios, d.departamento AS departamentos FROM cliente c 
        INNER JOIN municipios ci ON c.fo_ciudad = ci.id_ciudad
        INNER JOIN departamentos d ON ci.departamento_id = d.id_departamento 
        WHERE c.ident LIKE '%$dato%' OR c.nombre LIKE '%$dato%' OR c.email LIKE '%$dato%' 
        ORDER BY c.nombre";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];
        
        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    public function consultar_cliente($dato) {
        $con = "SELECT c.*, ci.municipio AS municipios, d.departamento AS departamentos FROM cliente c 
        INNER JOIN municipios ci ON c.fo_ciudad = ci.id_ciudad
        INNER JOIN departamentos d ON ci.departamento_id = d.id_departamento 
        WHERE c.ident = '$dato'
        ORDER BY c.nombre";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];
        
        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }    
}
?>
