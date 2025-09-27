<?php
class Database {
    private static $instance = null;
    private $connection;

    // Configuración de base de datos
    private $host = 'localhost';
    private $database = 'alojamientos_app';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';

    /**
     * Constructor privado para implementar Singleton
     */
    private function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}"
            ];

            $this->connection = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Log error en producción, mostrar mensaje genérico
            error_log("Database Connection Error: " . $e->getMessage());
            throw new PDOException("Error de conexión a la base de datos", (int)$e->getCode());
        }
    }

    /**
     * Obtiene la instancia única de la clase (Singleton)
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Obtiene la conexión PDO
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Ejecuta una consulta preparada con parámetros
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function query($query, $params = []) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Database Query Error: " . $e->getMessage() . " | Query: " . $query);
            throw new PDOException("Error al ejecutar la consulta", (int)$e->getCode());
        }
    }

    /**
     * Obtiene una sola fila
     * @param string $query
     * @param array $params
     * @return array|false
     */
    public function fetch($query, $params = []) {
        $stmt = $this->query($query, $params);
        return $stmt->fetch();
    }

    /**
     * Obtiene todas las filas
     * @param string $query
     * @param array $params
     * @return array
     */
    public function fetchAll($query, $params = []) {
        $stmt = $this->query($query, $params);
        return $stmt->fetchAll();
    }

    /**
     * Obtiene una sola columna
     * @param string $query
     * @param array $params
     * @return mixed
     */
    public function fetchColumn($query, $params = []) {
        $stmt = $this->query($query, $params);
        return $stmt->fetchColumn();
    }

    /**
     * Ejecuta una consulta de inserción y retorna el último ID insertado
     * @param string $query
     * @param array $params
     * @return string
     */
    public function insert($query, $params = []) {
        $this->query($query, $params);
        return $this->connection->lastInsertId();
    }

    /**
     * Ejecuta una consulta de actualización/eliminación y retorna el número de filas afectadas
     * @param string $query
     * @param array $params
     * @return int
     */
    public function execute($query, $params = []) {
        $stmt = $this->query($query, $params);
        return $stmt->rowCount();
    }

    /**
     * Inicia una transacción
     * @return bool
     */
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }

    /**
     * Confirma una transacción
     * @return bool
     */
    public function commit() {
        return $this->connection->commit();
    }

    /**
     * Revierte una transacción
     * @return bool
     */
    public function rollback() {
        return $this->connection->rollback();
    }

    /**
     * Verifica si hay una transacción activa
     * @return bool
     */
    public function inTransaction() {
        return $this->connection->inTransaction();
    }

    /**
     * Obtiene información sobre la base de datos
     * @return array
     */
    public function getInfo() {
        return [
            'server_version' => $this->connection->getAttribute(PDO::ATTR_SERVER_VERSION),
            'client_version' => $this->connection->getAttribute(PDO::ATTR_CLIENT_VERSION),
            'connection_status' => $this->connection->getAttribute(PDO::ATTR_CONNECTION_STATUS),
            'driver_name' => $this->connection->getAttribute(PDO::ATTR_DRIVER_NAME),
        ];
    }

    /**
     * Verifica si una tabla existe
     * @param string $tableName
     * @return bool
     */
    public function tableExists($tableName) {
        try {
            $query = "SHOW TABLES LIKE ?";
            $stmt = $this->query($query, [$tableName]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Obtiene la estructura de una tabla
     * @param string $tableName
     * @return array
     */
    public function getTableStructure($tableName) {
        try {
            $query = "DESCRIBE " . $tableName;
            return $this->fetchAll($query);
        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Ejecuta múltiples consultas en una transacción
     * @param array $queries Array de consultas con sus parámetros
     * @return bool
     */
    public function executeTransaction($queries) {
        try {
            $this->beginTransaction();

            foreach ($queries as $queryData) {
                $query = $queryData['query'];
                $params = isset($queryData['params']) ? $queryData['params'] : [];
                $this->query($query, $params);
            }

            return $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            error_log("Transaction Error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Limpia y valida datos de entrada
     * @param mixed $data
     * @return mixed
     */
    public function sanitize($data) {
        if (is_string($data)) {
            return trim(htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
        } elseif (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return $data;
    }

    /**
     * Prevenir clonación del objeto
     * @throws Exception
     */
    public function __clone() {
        throw new Exception("No se puede clonar una instancia de Database (Singleton)");
    }

    /**
     * Prevenir deserialización del objeto
     * @throws Exception
     */
    public function __wakeup() {
        throw new Exception("No se puede deserializar una instancia de Database (Singleton)");
    }

    /**
     * Cierra la conexión al destruir el objeto
     */
    public function __destruct() {
        $this->connection = null;
    }
}
