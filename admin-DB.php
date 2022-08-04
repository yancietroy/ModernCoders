<?php

  require_once 'mysql_connect.php';

  class Database extends Config {
    // Insert User Into Database
    public function insert($studentId, $fname, $mname, $lname, $gender, $email, $yearLevel, $birthDate, $age) {
      $sql = 'INSERT INTO tb_students (STUDENT_ID, FIRST_NAME, MIDDLE_NAME, LAST_NAME, GENDER, EMAIL, YEAR_LEVEL, BIRTHDATE, AGE) VALUES (:studentId, :fname, :mname, :lname, :gender, email, :yearLevel, :birthDate, :age)';
      $stmt = $this->connect->prepare($sql);
      $stmt->execute([
        'studentId' => $studentId,
        'fname'     => $fname,
        'mname'     => $mname,
        'lname'     => $lname,
        'gender'    => $gender,
        'email'     => $email,
        'yearLevel' => $yearLevel,
        'birthDate' => $birthDate,
        'age'       => $age
      ]);
      return true;
    }

    // Fetch All Users From Database
    public function read() {
      $sql = 'SELECT * FROM tb_students ORDER BY STUDENT_ID DESC';
      $stmt = $this->connect->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single User From Database
    public function readOne($studentId) {
      $sql = 'SELECT * FROM tb_students WHERE STUDENT_ID = :studentId';
      $stmt = $this->connect->prepare($sql);
      $stmt->execute(['studentId' => $studentId]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single User
    public function update($fname, $mname, $lname, $gender, $email, $yearLevel, $birthDate, $age) {
      $sql = 'UPDATE tb_students SET FIRST_NAME = :fname, MIDDLE_NAME = :mname, LAST_NAME = :lname, GENDER = :gender, EMAIL = :email, YEAR_LEVEL = :yearLevel, BIRTHDATE = :birthDate, age = :age WHERE STUDENT_ID = :studentId';
      $stmt = $this->connect->prepare($sql);
      $stmt->execute([
        'studentId' => $studentId,
        'fname'     => $fname,
        'mname'     => $mname,
        'lname'     => $lname,
        'gender'    => $gender,
        'email'     => $email,
        'yearLevel' => $yearLevel,
        'birthDate' => $birthDate,
        'age'       => $age
      ]);

      return true;
    }

    // Delete User From Database
    public function delete($studentId) {
      $sql = 'DELETE FROM tb_students WHERE STUDENT_ID = :studentId';
      $stmt = $this->connect->prepare($sql);
      $stmt->execute(['studentId' => $studentId]);
      return true;
    }
  }

?>