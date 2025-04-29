<?php
require_once '../../conexion.php';

class Product
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }
    
    public function getAllProducts()
    {
        $query = "SELECT
            productos.cod_prod, productos.nombre_prod, productos.descripcion_prod, productos.stock_prod, productos.impuesto,
            productos.valor_unidad, categorias.id_categoria, categorias.nombre_categoria, estados.id_estado, estados.nombre_estado
            FROM `productos`
            INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
            INNER JOIN estados ON productos.id_estado = estados.id_estado";

        $statement = $this->db->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getProduct($cod_prod)
    {
        $query = "SELECT
            productos.cod_prod, productos.nombre_prod, productos.descripcion_prod, productos.stock_prod, productos.impuesto,
            productos.valor_unidad, categorias.id_categoria, categorias.nombre_categoria, estados.id_estado, estados.nombre_estado
            FROM `productos` INNER JOIN categorias ON productos.id_categoria = categorias.id_categoria
            INNER JOIN estados ON productos.id_estado = estados.id_estado WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":cod_prod", $cod_prod);

        $statement->execute();

        return $statement->fetch();
    }

    public function insertProduct($data)
    {
        $query = "INSERT INTO productos
                (cod_prod, nombre_prod, descripcion_prod, stock_prod, valor_unidad, impuesto, id_categoria, id_estado) 
            VALUES
                (:cod_prod, :nombre_prod, :descripcion_prod, :stock_prod, :valor_unidad, :impuesto, :id_categoria, :id_estado)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':cod_prod', $data["codigo"]);
        $statement->bindValue(':nombre_prod', $data["nombre"]);
        $statement->bindValue(':descripcion_prod', $data["descripcion"]);
        $statement->bindValue(':stock_prod', $data["stock"]);
        $statement->bindValue(':valor_unidad', $data["precio"]);
        $statement->bindValue(':impuesto', $data["impuesto"]);
        $statement->bindValue(':id_categoria', $data["id_categoria"]);
        $statement->bindValue(':id_estado', $data["id_estado"]);

        return $statement->execute();
    }

    public function updateProduct($cod_prod, $data)
    {
        $query = "UPDATE productos SET
                nombre_prod = :nombre_prod,
                descripcion_prod = :descripcion_prod,
                stock_prod = :stock_prod,
                valor_unidad = :valor_unidad,
                id_categoria = :id_categoria,
                id_estado = :id_estado
            WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nombre_prod', $data["nombre"]);
        $statement->bindValue(':descripcion_prod', $data["descripcion"]);
        $statement->bindValue(':stock_prod', $data["stock"]);
        $statement->bindValue(':valor_unidad', $data["precio"]);
        $statement->bindValue(':id_categoria', $data["id_categoria"]);
        $statement->bindValue(':id_estado', $data["id_estado"]);
        $statement->bindValue(':cod_prod', $cod_prod);

        return $statement->execute();
    }

    public function deleteProduct($cod_prod)
    {
        $query = "DELETE FROM productos WHERE cod_prod = :cod_prod";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':cod_prod', $cod_prod);

        return $statement->execute();
    }
}
?>