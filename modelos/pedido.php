<?php
class Pedido {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function consulta() {
        $con = "SELECT v.*, c.nombre AS nombrecl, c.ident AS identcl, c.direccion AS direccion, 
                c.celular AS celular, ci.municipio AS ciudad, d.departamento AS dpto, u.nombre AS vendedor 
                FROM ventas v 
                INNER JOIN cliente c ON v.fo_cliente = c.id_cliente 
                INNER JOIN municipios ci ON c.fo_ciudad = ci.id_ciudad 
                INNER JOIN departamentos d ON ci.departamento_id = d.id_departamento
                INNER JOIN usuario u ON v.fo_vendedor = u.id_usuario
                ORDER BY v.fecha DESC, v.id_venta DESC";
        $res = mysqli_query($this->conexion, $con);
        $vec = [];

        while ($row = mysqli_fetch_array($res)) {
            $vec[] = $row;
        }

        return $vec;
    }

    /*public function eliminar($id) {
        $del = "DELETE FROM pedido WHERE id_pedido = $id";
        mysqli_query($this->conexion, $del);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El pedido ha sido eliminado";
        return $vec;
    }*/

    public function insertar($params) {
        $ins = "INSERT INTO ventas(fecha, fo_cliente, productos, subtotal, total, fo_vendedor)
        VALUES('$params->fecha', $params->fo_cliente, '$params->productos', $params->subtotal, $params->total, 
        $params->fo_vendedor";
        mysqli_query($this->conexion, $ins);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El pedido ha sido guardado";
        return $vec;
    }

    /*public function editar($id, $params) {
        $editar = "UPDATE pedido SET fecha = '$params->fecha', cliente_id = $params->cliente_id, total = $params->total WHERE id_pedido = $id";
        mysqli_query($this->conexion, $editar);
        $vec = [];
        $vec['resultado'] = "OK";
        $vec['mensaje'] = "El pedido ha sido editado";
        return $vec;
    }*/

    function consultap($id) {
        $con = "SELECT productos from ventas WHERE id_venta = $id";
        $res = mysqli_query($this->conexion, $con);
        $row = mysqli_fetch_array($res);
        $vec = unserialize($row[0]);

        return $vec;
    }

}
?>
