<?php
class Usuario {
    private $conn;
    private $table_name = "Usuario";

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Crear nuevo usuario
    public function crear($id_usuario, $nombre, $apellido, $email, $password, $rol) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_usuario, nombre, apellido, email, password, rol) 
                  VALUES (:id_usuario, :nombre, :apellido, :email, :password, :rol)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Puedes aplicar hash aquí si deseas
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }

    // Obtener usuario por ID
    public function obtenerPorId($id_usuario) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtenerPorEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email AND activo = 1";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar usuario
    public function actualizar($id_usuario, $nombre, $apellido, $email, $password, $rol, $activo) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, apellido = :apellido, email = :email, 
                      password = :password, rol = :rol, activo = :activo 
                  WHERE id_usuario = :id_usuario";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':activo', $activo);

        return $stmt->execute();
    }

    // Eliminar usuario
    public function eliminar($id_usuario) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        return $stmt->execute();
    }

    // Listar todos los usuarios
    public function listarTodos() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
