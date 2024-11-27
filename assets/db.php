<?php

require_once 'config.php';

class Database extends Config
{
    public function chkPhone($phone)
    {
        $sql = "SELECT * FROM members WHERE phone = :phone";
        $sth = $this->conn->prepare($sql);
        $sth->execute(['phone' => $phone,]);
        if ($sth->rowCount() > 0) {
            // var_dump($sth->fetchAll(PDO::FETCH_ASSOC));
            return false;
        } else {
            return $phone;
        }
    }

    public function insert($fname, $phone, $mtype, $skills)
    {
        $sql = "INSERT INTO members(fullname, phone, membertype, skills) VALUES(:fname, :phone, :mtype, :skills)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'fname' => $fname,
            'phone' => $phone,
            'mtype' => $mtype,
            'skills' => $skills,
        ]);
        return $this->conn->lastInsertId(); // คืนค่า lastInsertId แทนการคืนค่า true
    }


    public function read()
    {
        $sql = "SELECT * FROM members ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function readOne($id)
    {
        $sql = "SELECT * FROM members WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function update($id, $fname, $phone, $mtype)
    {
        $sql = "UPDATE members SET fullname = :fname, phone = :phone, membertype = :mtype WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'fname' => $fname,
            'phone' => $phone,
            'mtype' => $mtype,
            'id' => $id,
        ]);
        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM members WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }
}
