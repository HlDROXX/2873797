<?php
require_once '../../conexion.php';

class Client
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function getAllClients()
    {
        $query = "SELECT * FROM clientes";

        $statement = $this->db->prepare($query);

        $statement->execute();

        return $statement->fetchAll();
    }

    public function getClient($id_client)
    {
        $query = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(":id_cliente", $id_client);

        $statement->execute();

        return $statement->fetch();
    }

    public function insertClient($data)
    {
        $query = "INSERT INTO clientes
            (nro_identidad, nombre_cliente, direccion_cliente) 
        VALUES
            (:nro_identidad, :nombre_cliente, :direccion_cliente)";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_identidad', $data["identidad"]);
        $statement->bindValue(':nombre_cliente', $data["nombre"]);
        $statement->bindValue(':direccion_cliente', $data["direccion"]);

        return $statement->execute();
    }


    public function updateClient($id_client, $data)
    {
        $query = "UPDATE clientes SET
                nro_identidad = :nro_identidad, 
                nombre_cliente = :nombre_cliente,
                direccion_cliente = :direccion_cliente
            WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':nro_identidad', $data["identidad"]);
        $statement->bindValue(':nombre_cliente', $data["nombre"]);
        $statement->bindValue(':direccion_cliente', $data["direccion"]);
        $statement->bindValue(':id_cliente', $id_client);

        return $statement->execute();
    }


    public function deleteClient($id_client)
    {
        $query = "DELETE FROM clientes WHERE id_cliente = :id_cliente";

        $statement = $this->db->prepare($query);

        $statement->bindValue(':id_cliente', $id_client);

        return $statement->execute();
    }
}
?>