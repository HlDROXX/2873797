<?php
require_once __DIR__ . '/../conexion.php';

class Category
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categorias";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getCategory($id_category)
    {
        $query = "SELECT * FROM categorias WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_category);

        $statement->execute();

        return $statement->fetch();
    }

    public function insertCategory($category_name)
    {
        $query = "INSERT INTO categorias (nombre_categoria) VALUES (:nombre_categoria)";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":nombre_categoria", $category_name);

        return $statement->execute();
    }

    public function updateCategory($id_category, $category_name)
    {
        $query = "UPDATE categorias SET nombre_categoria = :nombre_categoria WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_category);
        $statement->bindParam(":nombre_categoria", $category_name);

        return $statement->execute();
    }

    public function deleteCategory($id_category)
    {
        $query = "DELETE FROM categorias WHERE id_categoria = :id_categoria";

        $statement = $this->db->prepare($query);

        $statement->bindParam(":id_categoria", $id_category);

        return $statement->execute();
    }
}
?>