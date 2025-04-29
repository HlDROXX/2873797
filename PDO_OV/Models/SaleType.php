<?php
require_once __DIR__ . '/../conexion.php';

class SaleType
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

   
    public function getAllSalesType()
    {
        $query = "SELECT * FROM tipos_venta";

        $statement = $this->db->prepare($query);

        $statement->execute();
        
        return $statement->fetchAll();
    }

    public function getSaleType($id_sale_type)
    {
        $query = "SELECT * FROM tipos_venta WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_sale_type);

        $statement->execute();
        
        return $statement->fetch();
    }

    public function insertSaleType($description)
    {
        $query = "INSERT INTO tipos_venta (descripcion) VALUES (:descripcion)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":descripcion", $description);

        return $statement->execute();
    }

    public function updateSaleType($id_sale_type, $description)
    {
        $query = "UPDATE tipos_venta SET descripcion = :descripcion WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_sale_type);
        $statement->bindParam(":descripcion", $description);

        return $statement->execute();
    }

    public function deleteSaleType($id_sale_type)
    {
        $query = "DELETE FROM tipos_venta WHERE id_tipo_venta = :id_tipo_venta";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_tipo_venta", $id_sale_type);

        return $statement->execute();
    }
}
?>