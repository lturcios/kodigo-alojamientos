<?php
class UsuarioAlojamiento {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function seleccionar($usuarioId, $alojamientoId) {
        try {
            $sql = "INSERT INTO usuario_alojamientos (usuario_id, alojamiento_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$usuarioId, $alojamientoId]);
        } catch (PDOException $e) {
            // Si ya existe la relación, no es un error crítico
            return false;
        }
    }

    public function eliminar($usuarioId, $alojamientoId) {
        try {
            $sql = "DELETE FROM usuario_alojamientos WHERE usuario_id = ? AND alojamiento_id = ?";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$usuarioId, $alojamientoId]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function yaSeleccionado($usuarioId, $alojamientoId) {
        try {
            $sql = "SELECT COUNT(*) FROM usuario_alojamientos WHERE usuario_id = ? AND alojamiento_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId, $alojamientoId]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function contarSeleccionados($usuarioId) {
        try {
            $sql = "SELECT COUNT(*) FROM usuario_alojamientos WHERE usuario_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId]);

            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return 0;
        }
    }
}
?>