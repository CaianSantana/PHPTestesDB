<?php
class PHPDBC
{

    private static $instance;
    private $connection;

    private function __construct() {
        try {
            $dbuser = 'root';
            $dbpass = '';
            $db = 'dbteste';
            $host = 'localhost';

            $this->connection = new PDO("mysql:host=$host;dbname=$db", $dbuser, $dbpass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance(): PHPDBC
    {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        } catch (Exception $e) {
            die("Erro ao obter a instância da classe: " . $e->getMessage());
        }
    }

    public function selectAll($tableName) {
        try {
            $sql = "SELECT * FROM $tableName";
            $statement = $this->connection->query($sql);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao executar o select: " . $e->getMessage());
        }
    }

    public function insert($tableName, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));
        try{
            $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";
            $statement = $this->connection->prepare($sql);
            $statement->execute($data);
            return $this->connection->lastInsertId();
        }catch (PDOException $e) {
            die("Erro ao executar o insert: " . $e->getMessage());
        }
    }

    public function update($tableName, $data, $condition) {
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ', ');
        try{
            $sql = "UPDATE $tableName SET $setClause WHERE $condition";
            $statement = $this->connection->prepare($sql);
            $statement->execute($data);
            return $statement->rowCount();
        }catch (PDOException $e) {
            die("Erro ao executar o update: " . $e->getMessage());
        }
        
    }

    public function delete($tableName, $condition) {
        try{
            $sql = "DELETE FROM $tableName WHERE $condition";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            return $statement->rowCount();
        }catch (PDOException $e) {
            die("Erro ao executar o delete: " . $e->getMessage());
        }
        }
}
