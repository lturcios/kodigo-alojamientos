<?php
class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function crear($nombre, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([$nombre, $email, $hashedPassword]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function autenticar($email, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);

            $usuario = $stmt->fetch();

            if ($usuario && password_verify($password, $usuario['password'])) {
                return $usuario;
            }

            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function obtenerPorId($id) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function existeEmail($email) {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return true; // En caso de error, asumimos que existe para prevenir duplicados
        }
    }

    public function esAdmin($usuarioId) {
        try {
            $sql = "SELECT tipo FROM usuarios WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$usuarioId]);

            $resultado = $stmt->fetch();
            return $resultado && $resultado['tipo'] === 'admin';
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>