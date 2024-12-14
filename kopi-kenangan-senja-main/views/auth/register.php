<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Warkop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-300 font-sans">
    <?php session_start(); ?>
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-amber-800">Warkop Nusantara</h2>
            <p class="text-center text-sm text-amber-600">Daftar Buat Dapetin Promo</p>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert bg-green text-white p-4 rounded mb-4">
                    <?= $_SESSION['message']['text']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <form action="../../controllers/RegisterController.php" method="POST" class="mt-6 space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-amber-800">Nama:</label>
                    <input type="text" name="name" id="name" required
                        class="w-full px-4 py-2 mt-1 text-sm text-amber-900 bg-amber-50 border border-amber-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-amber-800">Email:</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-2 mt-1 text-sm text-amber-900 bg-amber-50 border border-amber-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-amber-800">Password:</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 mt-1 text-sm text-amber-900 bg-amber-50 border border-amber-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                </div>
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-amber-800">Konfirmasi Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" required
                        class="w-full px-4 py-2 mt-1 text-sm text-amber-900 bg-amber-50 border border-amber-300 rounded-md focus:ring-amber-500 focus:border-amber-500">
                </div>
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-semibold text-white bg-amber-800 rounded-md hover:bg-amber-900">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</body>

</html>