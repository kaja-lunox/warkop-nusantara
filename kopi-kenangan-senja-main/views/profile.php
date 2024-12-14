<?php
require_once '../models/UserModel.php';

session_start();

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $name = $user['name'];
    $email = $user['email'];
    $profilePicture = 'https://via.placeholder.com/150';
} else {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="../assets/images/ptpn6.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-white-900 font-sans leading-normal tracking-normal text-gray-200">
    <div class="max-w-md mx-auto mt-16 p-8 bg-gray-800 rounded-xl shadow-2xl">
        <h1 class="text-3xl font-bold text-center text-white mb-8">Profile</h1>

        <div class="flex items-center justify-center mb-8">
            <img src="<?= $profilePicture; ?>" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-600">
        </div>

        <div class="mb-6">
            <label for="name" class="block text-gray-300 font-semibold">Name</label>
            <div class="mt-2 p-3 bg-gray-700 text-gray-200 rounded-lg">
                <?php echo $name; ?>
            </div>
        </div>

        <div class="mb-6">
            <label for="email" class="block text-gray-300 font-semibold">Email</label>
            <div class="mt-2 p-3 bg-gray-700 text-gray-200 rounded-lg">
                <?php echo $email; ?>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="#" class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-blue-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                Update Profile
            </a>
        </div>
    </div>
</body>

</html>