<?php

require_once 'config.php';

class Database extends Config
{

    public function readphone($id)
    {
        $sql = "SELECT * FROM members WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function chkPhone($phone)
    {
        $sql = "SELECT * FROM members WHERE phone = :phone";
        $sth = $this->conn->prepare($sql);
        $sth->execute(['phone' => $phone,]);
        if ($sth->rowCount() > 0) {
            return false;
        } else {
            return $phone;
        }
    }

    public function getID($id)
    {
        $sql = "SELECT * FROM dealer WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function chkDealer($phone)
    {
        $sql = "SELECT * FROM dealer WHERE phone = :phone";
        $sth = $this->conn->prepare($sql);
        $sth->execute(['phone' => $phone,]);
        if ($sth->rowCount() > 0) {
            return false;
        } else {
            return $phone;
        }
    }

    public function insdealer($sname, $phone, $branch)
    {
        $sql = "INSERT INTO dealer(sname, phone, branch) VALUES(:sname, :phone, :branch)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'sname' => $sname,
            'phone' => $phone,
            'branch' => $branch,
        ]);
        return true;
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
        return true;
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
        $sql = "SELECT * FROM members WHERE phone = :id";
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