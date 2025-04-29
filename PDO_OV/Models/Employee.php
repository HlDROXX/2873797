<?php
require_once '../../conexion.php';

class Employee
{
    private $db;

    public function __construct()
    {
        $conexionDb = new Conexion();
        $this->db = $conexionDb->obtenerConexion();
    }

    public function getAllEmployees()
    {
        $query = "SELECT id_empleado, nombre_empleado, usuario, correo FROM empleados";
        $statement = $this->db->prepare($query);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getEmployee($id_employee)
    {
        $query = "SELECT id_empleado, nombre_empleado, usuario, correo FROM empleados WHERE id_empleado = :id_empleado";
        $statement = $this->db->prepare($query);
        $statement->bindValue(":id_empleado", $id_employee);
        $statement->execute();

        return $statement->fetch();
    }

    public function insertEmployee($data)
    {
        $query = "INSERT INTO empleados (nombre_empleado, usuario, correo, empleado_password) 
                  VALUES (:nombre_empleado, :usuario, :correo, :empleado_password)";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':nombre_empleado', $data["nombre"]);
        $statement->bindValue(':usuario', $data["usuario"]);
        $statement->bindValue(':correo', $data["email"]);
        $statement->bindValue(':empleado_password', $data["password"]);

        return $statement->execute();
    }

    public function updateEmployee($id_employee, $data)
    {
        $query = "UPDATE empleados SET 
                  nombre_empleado = :nombre_empleado, 
                  usuario = :usuario,
                  correo = :correo
                  WHERE id_empleado = :id_empleado";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':nombre_empleado', $data["nombre"]);
        $statement->bindValue(':usuario', $data["usuario"]);
        $statement->bindValue(':correo', $data["email"]);
        $statement->bindValue(':id_empleado', $id_employee);

        return $statement->execute();
    }

    public function deleteEmployee($id_employee)
    {
        $query = "DELETE FROM empleados WHERE id_empleado = :id_empleado";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id_empleado', $id_employee);
        return $statement->execute();
    }
}
?>