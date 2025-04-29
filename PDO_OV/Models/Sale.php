<?php
require_once '../../conexion.php';

class Sale
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function getAllSales()
    {
        $query = "SELECT
            ventas_empleado.nro_factura, ventas_empleado.fecha_venta, clientes.nombre_cliente, empleados.nombre_empleado, tipos_venta.descripcion
            FROM ventas_empleado
            INNER JOIN clientes ON ventas_empleado.id_cliente = clientes.id_cliente
            INNER JOIN empleados ON ventas_empleado.id_empleado = empleados.id_empleado
            INNER JOIN tipos_venta ON ventas_empleado.id_tipo_venta = tipos_venta.id_tipo_venta";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSale($nro_invoice)
    {
        $query = "SELECT v.nro_factura, v.fecha_venta, c.nombre_cliente, e.nombre_empleado, t.descripcion AS tipo_venta,
                p.nombre_prod, d.cantidad, d.valor_prod, d.valor_impuesto, d.valor_total
                FROM ventas_empleado v
                JOIN clientes c ON v.id_cliente = c.id_cliente
                JOIN empleados e ON v.id_empleado = e.id_empleado
                JOIN tipos_venta t ON v.id_tipo_venta = t.id_tipo_venta
                LEFT JOIN detalles_factura d ON v.nro_factura = d.nro_factura
                LEFT JOIN productos p ON d.cod_prod = p.cod_prod
                WHERE v.nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $nro_invoice);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleHeader($nro_invoice)
    {
        $query = "SELECT v.nro_factura, v.fecha_venta, c.nombre_cliente, e.nombre_empleado, t.descripcion AS tipo_venta
              FROM ventas_empleado v
              JOIN clientes c ON v.id_cliente = c.id_cliente
              JOIN empleados e ON v.id_empleado = e.id_empleado
              JOIN tipos_venta t ON v.id_tipo_venta = t.id_tipo_venta
              WHERE v.nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":nro_factura", $nro_invoice);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getSaleDetails($nro_invoice)
    {
        $query = "SELECT p.nombre_prod, d.cantidad, d.valor_prod, d.valor_impuesto, d.valor_total
              FROM detalles_factura d
              JOIN productos p ON d.cod_prod = p.cod_prod
              WHERE d.nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);
        $statement->bindParam(":nro_factura", $nro_invoice);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertSale($data)
    {
        $query = "INSERT INTO
            ventas_empleado (nro_factura, fecha_venta, id_cliente, id_tipo_venta, id_empleado)
            VALUES (:nro_factura, :fecha_venta, :id_cliente, :id_tipo_venta, :id_empleado)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $data["nro_factura"]);
        $statement->bindParam(":fecha_venta", $data["fecha"]);
        $statement->bindParam(":id_cliente", $data["id_cliente"]);
        $statement->bindParam(":id_tipo_venta", $data["id_tipo_venta"]);
        $statement->bindParam(":id_empleado", $data["id_empleado"]);

        return $statement->execute();
    }

    public function updateSale($nro_invoice, $data)
    {
        $query = "UPDATE ventas_empleado SET
            id_cliente = :id_cliente,
            id_empleado = :id_empleado,
            id_tipo_venta = :id_tipo_venta
            WHERE nro_factura = :nro_factura";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nro_factura", $nro_invoice);
        $statement->bindParam(":id_cliente", $data["id_cliente"]);
        $statement->bindParam(":id_empleado", $data["id_empleado"]);
        $statement->bindParam(":id_tipo_venta", $data["id_tipo_venta"]);

        return $statement->execute();
    }

    public function deleteSale($nro_invoice)
    {
        $queryDetails = "DELETE FROM detalles_factura WHERE nro_factura = :nro_factura";
        $statementDetails = $this->db->prepare($queryDetails);
        $statementDetails->bindParam(":nro_factura", $nro_invoice);
        $statementDetails->execute();

        $query = "DELETE FROM ventas_empleado WHERE nro_factura = :nro_factura";
        $statement = $this->db->prepare($query);
        $statement->bindParam(":nro_factura", $nro_invoice);
        return $statement->execute();
    }

    public function generar_nro_factura()
    {
        $sql = "SELECT MAX(nro_factura) AS ultimoNumero FROM ventas_empleado";
        $consul = $this->db->prepare($sql);
        $consul->execute();
        $resultado = $consul->fetch();

        $ultimoNumero = isset($resultado['ultimoNumero']) ? $resultado['ultimoNumero'] : 'FACT-0';
        $ultimoNumeroSolo = (int) str_replace('VNT-', '', $ultimoNumero);

        $nuevoNumero = $ultimoNumeroSolo + 1;

        $nroFactura = "VNT-" . $nuevoNumero;

        return $nroFactura;
    }
}
?>