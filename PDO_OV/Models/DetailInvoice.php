<?php
require_once __DIR__ . '/../conexion.php';

class DetailInvoice
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    
    public function insertDetailsInvoice($data)
    {
        $query = "INSERT INTO detalles_factura 
                (nro_factura, cod_prod, cantidad, valor_prod, valor_impuesto, valor_total) 
                VALUES 
                (:nro_factura, :cod_prod, :cantidad, :valor_prod, :valor_impuesto, :valor_total)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_factura', $data["nro_factura"]);
        $statement->bindValue(':cod_prod', $data["cod_prod"]);
        $statement->bindValue(':cantidad', $data["cantidad"]);
        $statement->bindValue(':valor_prod', $data["valor_prod"]);
        $statement->bindValue(':valor_impuesto', $data["valor_impuesto"]);
        $statement->bindValue(':valor_total', $data["valor_total"]);

        return $statement->execute();
    }
}
?>