<?php

require_once 'config/Database.php';

abstract class Model
{
    static $table;
    static $table2;
    static $table3;
    static function getConnection(): ?object
    {

        return Database::connect();
    }

    static function getAll(): array
    {
        try {

            $connection = self::getConnection();
        } catch (PDOException $e) {
            $obj = new stdClass();
            $obj->message = $e->getMessage();

            return [$obj];
        }
        $sql = 'select * from ' . static::$table;
        $stmt = $connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    static function getByID($id): object
    {
        $connection = self::getConnection();
        $sql = "select * from " . static::$table . " where id = " . $id;
        $stmt = $connection->prepare($sql);
        $data = $stmt->execute([$id]);
        return $data->fetch(PDO::FETCH_OBJ);
    }


    function delete($id): bool
    {
        $connection = static::getConnection();
        try {
            $sql = "delete from " . static::$table . " where id = " . $id;
            $stmt = $connection->query($sql);
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function joinTAble(): array
    {
        $sql = 'select * from ' . static::$table . 'inner join ' . static::$table2 . ' on id =' . static::$table2 . '.id';
        $connection = self::getConnection();
        $stmt = $connection->prepare($sql);
        $data = $stmt->execute([static::$table, static::$table2]);
        return $data->fetchAll(PDO::FETCH_OBJ);
    }
}
