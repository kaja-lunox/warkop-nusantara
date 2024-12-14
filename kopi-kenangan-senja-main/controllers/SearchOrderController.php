<?php
// session_start();
require_once __DIR__ . '/../models/OrderModel.php';

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function searchOrder()
    {
        $search = $_POST['search'] ?? '';

        $orders = $this->orderModel->searchOrder($search);

        foreach ($orders as $order) {
            echo "
                <tr class='border-b hover:bg-gray-50 transition-all duration-200'>
                    <td class='px-6 py-4 text-gray-700'>" . htmlspecialchars($order['orderer_name']) . "</td>
                    <td class='px-6 py-4 text-gray-700'>" . htmlspecialchars($order['menu_name']) . "</td>
                    <td class='px-6 py-4 text-gray-700'>" . htmlspecialchars($order['quantity']) . "</td>
                    <td class='px-6 py-4 text-gray-700'>" . htmlspecialchars($order['table_number']) . "</td>
                    <td class='px-6 py-4 text-green-600 font-semibold'>" . htmlspecialchars($order['status']) . "</td>
                </tr>
            ";
        }

        if (empty($orders)) {
            echo "<tr>
                    <td colspan='5' class='text-center px-6 py-4 text-gray-500'>Tidak ada pesanan ditemukan</td>
                  </tr>";
        }
    }
}
