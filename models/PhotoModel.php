<?php

class PhotoModel extends Model
{

  static $table = 'photo';

  static function getByID($id): ?object
  {
    $data = new stdClass;
    try {
      $connection = static::getConnection();
      $sql = "select * from " . static::$table . " where id = :id ";
      $stmt = $connection->prepare($sql);
      $stmt->bindValue(":id", (int)$id, pdo::PARAM_INT);
      $stmt->execute();
      $data = $stmt->fetch(pdo::FETCH_OBJ);


      // echo " after stmt <br>";

      // echo json_encode($data = $stmt->fetch(pdo::FETCH_OBJ));
      // echo "<br>";

      // echo $data->fetch(PDO::FETCH_OBJ);
      // die();
      return $data;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }
}
