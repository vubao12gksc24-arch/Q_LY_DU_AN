<?php
class CustomerModel
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // lấy toàn bộ roles
    public function getAll()
    {
        $sql = "SELECT * FROM customers ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // lấy 1 khách hàng theo id
    public function getByID($id)
    {
        $sql = "SELECT c.*, 
                       uc.fullname as creator_name, 
                       uu.fullname as updater_name 
                FROM customers c
                LEFT JOIN users uc ON c.created_by = uc.id
                LEFT JOIN users uu ON c.updated_by = uu.id
                WHERE c.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // thêm mới khách hàng
    public function create($name, $email, $phone, $address, $created_by, $passport, $gender, $citizen_id)
    {
        $sql = "INSERT INTO `customers`
        ( `name`, `email`, `phone`, `address`, `created_by`, `created_at`, `updated_at`, `gender`, `passport`, `citizen_id`) 
        VALUES 
        (:name, :email, :phone, :address, :created_by, NOW(), NOW(), :gender, :passport, :citizen_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":created_by", $created_by);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":passport", $passport);
        $stmt->bindParam(":citizen_id", $citizen_id);
        return $stmt->execute();
    }
    // cập nhật khách hàng
    public function update($id, $name, $email, $phone, $address, $updated_by, $gender, $passport, $citizen_id)
    {
        $sql = "UPDATE customers 
        SET 
            name = :name, 
            email = :email, 
            phone = :phone, 
            address = :address, 
            updated_by = :updated_by,
            gender = :gender,
            passport = :passport,
            citizen_id = :citizen_id,
            updated_at = NOW()
        WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":updated_by", $updated_by);
        $stmt->bindParam(":gender", $gender);
        $stmt->bindParam(":passport", $passport);
        $stmt->bindParam(":citizen_id", $citizen_id);
        return $stmt->execute();
    }
    // xoá khách hàng
    
}
