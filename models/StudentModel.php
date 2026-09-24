<?php


class StudentModel extends Model
{
    static $table = 'student';


    // find student using like 
    // takes email,password as parameter
    // look in database for student where email like %email% && password like %password%
    // return student 

    function find(string $id): ?object
    {


        $student = null;
        try {
            $connection = static::getConnection();
            $sql = "select * from " . static::$table . " where id =" . $id;
            $stmt = $connection->query($sql);
            $data =  $stmt->fetch(PDO::FETCH_OBJ);
            if ($data) {
                $student = $data;
            }
            // echo json_encode($student);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        // echo json_encode($data);

        return $student;
    }

    // find by name email & password
    function findByEmail(string $email): ?object
    {
        $student = null;
        try {
            $connection = static::getConnection();
            $sql = "select * from " . static::$table . " where email = '" . $email . "'";
            $stmt = $connection->query($sql);
            $data =  $stmt->fetch(PDO::FETCH_OBJ);
            // echo json_encode($data);
            // echo "<br>";
            // echo "from here now";
            // echo "<br>";

            if ($data) {
                $student = $data;
            }
            // echo json_encode($student);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $student;
    }


    function insert(object $studentP): bool
    {
        // echo json_encode($studentP);
        // echo "<br>";

        $isInserted = false;
        $student = $this->findByEmail($studentP->email);

        $emptyString = "";
        if (!$student) {

            $connection = static::getConnection();
            $sql = "insert into student (first_name,last_name,password,email) values (:first_name,:last_name,:password,:email)";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(":first_name", $studentP->first_name ?? $emptyString, PDO::PARAM_STR);
            $stmt->bindValue(":last_name", $studentP->last_name ?? $emptyString, PDO::PARAM_STR);
            $stmt->bindValue(":password", $studentP->password, PDO::PARAM_STR);
            $stmt->bindValue(":email", $studentP->email, PDO::PARAM_STR);
            $isInserted = $stmt->execute();
            // echo "<br>";
        }

        return $isInserted;
    }

    function update(object $student): ?object
    {
        // find student 
        if ($oldData = $this->find($student->id)) {
            $newData = new stdClass;
            $newData->id = $oldData->id;
            $newData->first_name = $student->first_name ?? $oldData->first_name;
            $newData->last_name = $student->last_name ?? $oldData->last_name;
            $newData->email = $student->email ?? $oldData->email;
            $newData->description = $student->description ?? $oldData->description ?? "";
            $newData->location = $student->location ?? $oldData->location ?? "";
            $newData->password = $student->password ?? $oldData->password ?? "";
            $newData->occupation = $student->occupation ?? $oldData->occupation ?? "";
            $newData->isLogin = $student->isLogin ?? $oldData->isLogin ?? false;

            try {
                $connection = $this->getConnection();
                $sql = "update student set last_name = '" . $newData->last_name . "', first_name = '" . $newData->first_name . "', password = '" . $newData->password . "' ,email = '"
                    . $newData->email . "' ,description = '" . $newData->description . "' , occupation = '" . $newData->occupation . " ', location = '" . $newData->location . "',isLogin = " . $newData->isLogin .
                    " where id = " . $newData->id . "";
                $stmt = $connection->query($sql);
                if ($stmt) {
                    return $newData;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }
        // update data

        return null;
    }

    function deleteStudent($id): bool
    {
        $isdeleted = false;

        if ($id) {
            try {
                $connection = $this->getConnection();
                $sql = "DELETE FROM `student` WHERE `student`.`id` = " . $id;
                $stmt = $connection->query($sql);
                if ($stmt) {
                    $isdeleted = true;
                    return $isdeleted;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return $isdeleted;
            }
        }


        return $isdeleted;
    }


    function updateStateLogin($id): bool
    {
        try {
            $connection = static::getConnection();

            $sql = "update student set isLogin = true where id = " . $id;
            $stmt = $connection->query($sql);
            if ($stmt) {
                return true;
            } else {
                return false;
            }
            // echo json_encode($stmt);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function updateStateLogout($id): bool
    {
        try {
            $connection = static::getConnection();

            $sql = "update student set isLogin = false where id = " . $id;
            $stmt = $connection->query($sql);
            if ($stmt) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
