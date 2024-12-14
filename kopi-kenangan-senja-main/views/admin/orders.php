<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location: ../../index.php");
  exit();
}

$user = $_SESSION['user'];

require_once __DIR__ . '/../../controllers/OrderController.php';

$orderController = new OrderController();
$orders = $orderController->getOrders();
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="../../assets/css/style.css">
  <title>Orders - Warkop Nusantara</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-blue-100 text-gray-200">
  <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-800 bg-opacity-90 py-4 px-6 flex justify-between items-center shadow-md">
    <a href="#" class="text-2xl font-bold italic text-white">
      Warkop<span class="text-blue-500">Nusantara</span>
    </a>
    <div class="flex space-x-4 items-center text-white">
      <span class="hidden md:block font-medium"><?= htmlspecialchars($user['name']); ?></span>
      <a href="#" id="modal-button" class="hover:text-blue-500"><i data-feather="user"></i></a>
      <a href="#" id="menu-button" class="md:hidden hover:text-blue-500"><i data-feather="menu"></i></a>
      <a href="#" id="close-button" class="hidden md:hidden hover:text-blue-500"><i data-feather="x"></i></a>
    </div>
  </nav>

  <div id="menu-modal" class="bg-black bg-opacity-50 absolute top-14 right-4 z-50 hidden">
    <div class="bg-white/60 backdrop-blur-lg py-4 rounded-lg shadow-lg w-48">
      <ul>
        <a href="../profile.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Profile</a>
        <a href="../settings.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Settings</a>
        <a href="../../controllers/LogoutController.php" class="text-gray-700 hover:bg-gray-100 py-2 px-4 block w-full">Logout</a>
      </ul>
    </div>
  </div>

  <?php include __DIR__ . '/../partials/aside.php'; ?>

  <aside class="fixed top-0 h-full w-64 bg-blue-50 text-black shadow-lg z-50 md:hidden sidebar" id="sidenav">
    <nav class="flex flex-col h-full py-8">
      <a href="home.php" class="hover:bg-yellow-100 py-2 px-8">Menu</a>
      <a href="orders.php" class="hover:bg-yellow-100 py-2 px-8">Pesanan</a>
      <a href="transactions.php" class="hover:bg-yellow-100 py-2 px-8">Transaksi</a>
    </nav>
  </aside>

  <div class="container mx-auto mt-32 px-4 md:ml-72">
    <h1 class="text-3xl font-bold text-black mb-6">Daftar Pesanan</h1>
    <div class="overflow-x-auto bg-gray-800 border  rounded-lg shadow-md">
      <table class="min-w-full">
        <thead>
          <tr class="bg-gradient-to-r from-yellow-300 to-orange-500 text-white">
            <th class="px-6 py-3">Nama Pemesan</th>
            <th class="px-6 py-3">Menu</th>
            <th class="px-6 py-3">Jumlah</th>
            <th class="px-6 py-3">Nomor Meja</th>
            <th class="px-6 py-3">Status</th>
            <th class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php if (!empty($orders)): ?>
            <?php foreach ($orders as $order): ?>
              <tr class="border-b hover:bg-gray-100 transition-all duration-200">
                <td class="px-6 py-4 text-black"><?= htmlspecialchars($order['orderer_name']); ?></td>
                <td class="px-6 py-4 text-black"><?= htmlspecialchars($order['menu_name']); ?></td>
                <td class="px-6 py-4 text-black"><?= htmlspecialchars($order['quantity']); ?></td>
                <td class="px-6 py-4 text-black"><?= htmlspecialchars($order['table_number']); ?></td>
                <td class="px-6 py-4 <?= $order['status'] === 'waiting confirmation' ? 'text-blue-500' : ($order['status'] === 'confirmed' ? 'text-blue-500' : ($order['status'] === 'process' ? 'text-purple-500' : 'text-green-500')); ?>">
                  <?= htmlspecialchars($order['status']); ?>
                </td>
                <td class="px-6 py-4">
                  <?php if ($order['status'] === "waiting confirmation"): ?>
                    <form action="../../controllers/ConfirmOrderController.php" method="POST">
                      <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                      <input type="hidden" name="status" value="confirmed">
                      <button type="submit" class="bg-blue-500 hover:bg-yellow-600 text-white text-xs font-semibold py-1 px-3 rounded-full">
                        Confirm
                      </button>
                    </form>
                  <?php elseif ($order['status'] === "confirmed"): ?>
                    <form action="../../controllers/ConfirmOrderController.php" method="POST">
                      <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                      <input type="hidden" name="status" value="process">
                      <button type="submit" class="bg-green hover:bg-blue-600 text-white text-xs font-semibold py-1 px-3 rounded-full">
                        Process
                      </button>
                    </form>
                  <?php elseif ($order['status'] === "process"): ?>
                    <form action="../../controllers/ConfirmOrderController.php" method="POST">
                      <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                      <input type="hidden" name="status" value="delivered">
                      <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white text-xs font-semibold py-1 px-3 rounded-full">
                        Deliver
                      </button>
                    </form>
                  <?php elseif ($order['status'] === "delivered"): ?>
                    <span class="text-green-500">Completed</span>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center px-6 py-4 text-gray-500">Belum ada pesanan</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    feather.replace();

    const toggleButton = document.getElementById('menu-button');
    const sideNav = document.getElementById('sidenav');
    const closeMenu = document.getElementById("close-button");

    toggleButton.addEventListener('click', () => {
      sideNav.classList.toggle('visible');
      toggleButton.classList.toggle('hidden');
      closeMenu.classList.toggle('hidden');
    });

    closeMenu.addEventListener('click', () => {
      sideNav.classList.toggle('visible');
      toggleButton.classList.toggle('hidden');
      closeMenu.classList.toggle('hidden');
    });

    const modalButton = document.getElementById('modal-button');
    const menuModal = document.getElementById('menu-modal');

    modalButton.addEventListener('click', () => {
      menuModal.classList.toggle('hidden');
    });
  </script>
</body>

</html>