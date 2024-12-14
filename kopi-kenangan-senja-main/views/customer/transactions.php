<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit();
}

$user = $_SESSION['user'];

require_once __DIR__ . '/../../controllers/TransactionController.php';

$transactionController = new TransactionController();
$transactions = $transactionController->getTransactions();
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
    <title>Transactions - Warkop Nusantara</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-blue-100">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-800 bg-opacity-90 py-4 px-6 flex justify-between items-center shadow-md">
        <a href="#" class="text-2xl font-bold italic text-white">
            Warkop<span class="text-blue-500"> Nusantara</span>
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

    <aside class="fixed top-0 h-full w-64 bg-white text-black shadow-lg z-50 md:hidden sidebar" id="sidenav">
        <nav class="flex flex-col h-full py-8">
            <a href="home.php" class="hover:bg-yellow-100 py-2 px-8">Menu</a>
            <a href="orders.php" class="hover:bg-yellow-100 py-2 px-8">Pesanan</a>
            <a href="transactions.php" class="hover:bg-yellow-100 py-2 px-8">Transaksi</a>
        </nav>
    </aside>

    <div class="container mx-auto mt-32 px-4 md:ml-72">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Transaksi</h1>
        <div class="overflow-x-auto bg-white border rounded-lg shadow-md">
            <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-left">
                        <th class="px-6 py-3 border">Menu</th>
                        <th class="px-6 py-3 border">Jumlah</th>
                        <th class="px-6 py-3 border">Harga</th>
                        <th class="px-6 py-3 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($transactions)): ?>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-6 py-4"><?= htmlspecialchars($transaction['menu_name']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($transaction['quantity']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($transaction['price']); ?></td>
                                <td class="px-6 py-4 text-green-500">
                                    <?= htmlspecialchars($transaction['status']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center px-6 py-4 text-gray-500">Belum ada transaksi</td>
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