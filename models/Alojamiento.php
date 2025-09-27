<?php
class Alojamiento {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function obtenerTodos() {
        try {
            $sql = "SELECT * FROM alojamientos ORDER BY fecha_creacion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT * FROM alojamientos WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function crear($nombre, $descripcion, $precio, $ubicacion, $imagen = null) {
        try {
            $sql = "INSERT INTO alojamientos (nombre, descripcion, precio, ubicacion, imagen) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$nombre, $descripcion, $precio, $ubicacion, $imagen]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerAlojamientosUsuario($usuarioId) {
        try {
            $sql = "SELECT a.*, ua.fecha_seleccion 
                    FROM alojamientos a 
                    JOIN usuario_alojamientos ua ON a.id = ua.alojamiento_id 
                    WHERE ua.usuario_id = ? 
                    ORDER BY ua.fecha_seleccion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }

    public function obtenerAlojamientosDisponibles($usuarioId) {
        try {
            $sql = "SELECT * FROM alojamientos a 
                    WHERE a.id NOT IN (
                        SELECT ua.alojamiento_id 
                        FROM usuario_alojamientos ua 
                        WHERE ua.usuario_id = ?
                    )
                    ORDER BY a.fecha_creacion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId]);

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return [];
        }
    }
}
?>