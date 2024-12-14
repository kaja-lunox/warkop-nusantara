<?php
require_once __DIR__ . '/../config/connection.php';

class TransactionModel {
    private $conn;

    public function __construct() {
        $db = new Connection();
        $this->conn = $db->openConnection();
    }

    public function transaction($order_id) {
        $sql = "INSERT INTO transactions (order_id) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        
        return $stmt->execute();
    }  

    public function getTransactions() {
        $sql = "
            SELECT 
                t.id AS transaction_id,
                o.orderer_name,
                m.menu_name,
                o.quantity,
                (m.price * o.quantity) AS price,
                t.status
            FROM 
                transactions t
            JOIN 
                orders o ON t.order_id = o.id
            JOIN 
                menus m ON o.menu_id = m.id
            ORDER BY 
                t.created_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result->fetch_all(MYSQLI_ASSOC);
    } 
    
    public function confirmPayment($transaction_id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE transactions SET status = ?, updated_at = NOW() WHERE id = ?");
        $stmt->bind_param("si", $status, $transaction_id);
        return $stmt->execute();
    }
}
?>
