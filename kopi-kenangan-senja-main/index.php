<?php
session_start();

require_once 'controllers/MenuController.php';
$menuController = new MenuController();
$menus = $menuController->getMenus();
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
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Warkop Nusantara</title>
</head>

<body class="bg-gray-900 text-white font-poppins">
  <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-800 bg-opacity-80 py-4 px-6 flex justify-between items-center border-b border-gray-700">
    <a href="#" class="text-2xl font-bold italic text-white">Warkop<span class="text-blue-500"> Nusantara</span></a>
    <div class="hidden md:flex space-x-6">
      <a href="#home" class="hover:text-blue-500">Home</a>
      <a href="#about" class="hover:text-blue-500">Tentang Kami</a>
      <a href="#menu" class="hover:text-blue-500">Menu</a>
      <a href="#products" class="hover:text-blue-500">Produk</a>
      <a href="#contact" class="hover:text-blue-500">Kontak</a>
    </div>
    <div class="flex space-x-4">
      <a href="#" id="search-menu" class="hover:text-blue-500"><i data-feather="search"></i></a>
      <a href="charts.php" id="shopping-cart-button" class="hover:text-blue-500"><i data-feather="shopping-cart"></i></a>
      <a href="#" id="menu-button" class="md:hidden hover:text-blue-500"><i data-feather="menu"></i></a>
      <a href="#" class="hidden md:hidden hover:text-blue-500" id="close-button"><i data-feather="x"></i></a>
    </div>
    <div class="absolute top-full right-7 bg-white px-4 py-2 w-80 text-gray-900 flex items-center hidden" id="search-form">
      <input type="search" id="search-box" placeholder="Search here..." class="w-full p-2 focus:outline-none" id="search-button">
      <label for="search" class="cursor-pointer"><i data-feather="search"></i></label>
    </div>
  </nav>

  <aside class="fixed top-0 h-full w-64 bg-white text-black shadow-lg z-50 md:hidden sidebar" id="sidenav">
    <nav class="flex flex-col h-full space-y-4 p-8">
      <a href="#home" class="hover:text-blue-500">Home</a>
      <a href="#about" class="hover:text-blue-500">Tentang Kami</a>
      <a href="#menu" class="hover:text-blue-500">Menu</a>
      <a href="#products" class="hover:text-blue-500">Produk</a>
      <a href="#contact" class="hover:text-blue-500">Kontak</a>
    </nav>
  </aside>

  <section id="home" class="min-h-screen bg-cover bg-center flex items-center justify-center" style="background-image: url('assets/img/foto (1).jpg');">
    <div class="bg-black bg-opacity-50 p-10 text-center rounded-lg mx-6">
      <h1 class="text-4xl font-bold mb-4">Mari Nikmati Secangkir <span class="text-blue-500">Kopi</span></h1>
      <p class="text-lg">Temukan cita rasa autentik yang menggugah selera <br>Nikmati suasana nyaman bersama teman dan keluarga hanya di Warkop NYC.</p>
      <div class="mt-6 flex gap-3 justify-center">
        <a href="orders.php" class="p-3 bg-white text-gray-900 hover:bg-gray-400">Lihat Pesanan</a>
        <button id="login-button" class="p-3 bg-green hover:bg-blue-400">Masuk</button>
      </div>
    </div>
  </section>

  <div id="login-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-12 z-50 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
    <form action="../controllers/LoginController.php" method="POST" enctype="multipart/form-data" class="relative bg-white/60 backdrop-blur-lg p-6 rounded-lg shadow-lg w-full max-w-md">
      <button id="login-close" type="button" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
        <i data-feather="x"></i>
      </button>

      <?php if (isset($_SESSION['message'])): ?>
        <div class="alert bg-green text-white p-4 rounded mb-4">
          <?= $_SESSION['message']['text']; ?>
        </div>
        <?php unset($_SESSION['message']); ?>
      <?php endif; ?>

      <label for="email" class="block mt-2">Email</label>
      <input type="text" id="email" name="email" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <label for="password" class="block mt-4">Password</label>
      <input type="password" id="password" name="password" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <span class="text-gray-900">Don't have an account? <a href="views/auth/register.php" class="text-blue-600">Sign up</a></span>

      <button type="submit" class="mt-4 w-full py-2 bg-blue-500 hover:bg-yellow-400 text-white font-semibold rounded-lg transition duration-300 ease-in-out">LOGIN</button>
    </form>
  </div>

  <section id="about" class="py-20 px-6 bg-gray-800">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold text-white">
        <span class="text-blue-500">Tentang</span> Kami
      </h2>
    </div>
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-start gap-8">
      <!-- Bagian Gambar -->
      <div class="md:w-1/2">
        <img src="assets/img/foto2 (1).jpeg" alt="Tentang Kami" class="rounded-lg shadow-lg w-full max-w-md ml-0">
      </div>
      <!-- Bagian Teks -->
      <div class="md:w-1/2 text-white space-y-6 md:pl-10">
        <p class="text-lg">
          Warkop NYC adalah tempat nongkrong favorit bagi pecinta kopi dan makanan ringan khas Indonesia. Dengan suasana yang hangat dan ramah, kami menghadirkan pengalaman yang menghubungkan budaya nusantara ke tengah hiruk-pikuk kota besar.
        </p>
        <p class="text-lg">
          Kami berkomitmen untuk menyajikan kopi terbaik, makanan tradisional yang lezat, serta layanan yang memuaskan. Warkop NYC adalah tempat di mana kenangan indah bersama teman dan keluarga tercipta.
        </p>
      </div>
    </div>
  </section>


  <section id="menu" class="py-20 px-6 bg-gray-900">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold"><span class="text-blue-500">Menu</span> Kami</h2>
      <p>Kami menyajikan berbagai pilihan kopi dan makanan khas Indonesia yang siap memanjakan lidah Anda.
        Dari kopi hitam pekat hingga kudapan tradisional, semuanya dibuat dengan bahan berkualitas terbaik.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <?php foreach ($menus as $menu): ?>
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-center flex flex-col items-center">
          <div class="flex justify-center gap-4 mb-4">
            <a
              href="#"
              class="text-blue-500 bg-gray-900 p-3 rounded-full hover:bg-blue-500 hover:text-gray-900 transition duration-300 ease-in-out add-to-cart"
              data-id="<?= $menu['id']; ?>"
              data-name="<?= $menu['menu_name']; ?>"
              data-price="<?= $menu['price']; ?>"
              data-description="<?= $menu['description']; ?>"
              data-image="storage/images/<?= $menu['menu_image']; ?>">
              <i data-feather="shopping-cart"></i>
            </a>
            <button
              class="order-button bg-blue-500 p-3 hover:bg-yellow-400 transition duration-300 ease-in-out flex items-center justify-center"
              data-id="<?= $menu['id']; ?>">
              Pesan Sekarang
            </button>
          </div>
          <img src="storage/images/<?= $menu['menu_image']; ?>" alt="<?= $menu['menu_name']; ?>" class="rounded-lg mb-4 w-full h-48 object-cover">
          <h3 class="text-xl font-semibold text-white"><?= $menu['menu_name']; ?></h3>
          <p class="text-blue-500 mt-2">IDR <?= $menu['price']; ?></p>
          <p class="text-gray-400 mt-2"><?= $menu['description']; ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div id="order-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center px-12 z-50 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
    <form action="../controllers/OrderController.php" method="POST" enctype="multipart/form-data" class="relative bg-white/60 backdrop-blur-lg p-6 rounded-lg shadow-lg w-full max-w-md">
      <button id="order-close" type="button" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800">
        <i data-feather="x"></i>
      </button>

      <input type="hidden" id="menu_id" name="menu_id">

      <label for="orderer_name" class="block mt-2">Nama Kamu</label>
      <input type="text" id="orderer_name" name="orderer_name" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <label for="quantity" class="block mt-4">Jumlah Pesanan</label>
      <input type="text" id="quantity" name="quantity" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <label for="table_number" class="block mt-4">Nomor Meja</label>
      <input type="text" id="table_number" name="table_number" class="w-full p-2 mt-1 focus:outline-none text-gray-900" required>

      <button type="submit" class="mt-4 w-full py-2 bg-blue-500 hover:bg-yellow-400 text-white font-semibold rounded-lg transition duration-300 ease-in-out">BUAT PESANAN</button>
    </form>
  </div>

  <section id="contact" class="py-20 px-6 bg-gray-900">
    <div class="text-center mb-10">
      <h2 class="text-3xl font-bold"><span class="text-blue-500">Kontak</span> Kami</h2>
      <p>Jika Anda memiliki pertanyaan atau membutuhkan informasi lebih lanjut <br>jangan ragu untuk menghubungi kami melalui email di sidqinaser@gmail.com. Kami akan dengan senang hati membantu Anda!

      </p>
    </div>
    <div class="md:flex md:space-x-6">
      <iframe class="w-full md:w-1/2 h-64 rounded-lg mb-6 md:mb-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126899.51606762772!2d107.07185948280143!3d-6.314868889497205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699a97cdfd23f3%3A0xa467efa8d683cc31!2sCikarang%2C%20Kabupaten%20Bekasi%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1729477296601!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen="" loading="lazy"></iframe>
      <div class="md:w-1/2">
        <form class="bg-gray-800 p-6 rounded-lg shadow-lg">
          <div class="mb-4">
            <label for="name" class="block text-sm font-semibold mb-1">Nama</label>
            <input type="text" id="name" placeholder="Nama" class="w-full p-2 text-gray-900 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-semibold mb-1">Email</label>
            <input type="email" id="email" placeholder="Email" class="w-full p-2 text-gray-900 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div class="mb-4">
            <label for="message" class="block text-sm font-semibold mb-1">Pesan</label>
            <textarea id="message" rows="4" placeholder="Tulis pesan..." class="w-full p-2 text-gray-900 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500"></textarea>
          </div>
          <button type="submit" class="w-full bg-blue-500 text-gray-900 font-semibold py-2 rounded-lg hover:bg-yellow-400 transition duration-300">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </section>

  <footer class="bg-gray-800 py-6 text-center">
    <p class="text-gray-400">&copy; 2024 Warkop Nusantara. All rights reserved.</p>
    <div class="mt-2 text-center">
      <a href="#" class="text-gray-400 hover:text-blue-500 mx-2">Privacy Policy | Terms of Service</a>
    </div>
  </footer>

  <script src="assets/js/script.js"></script>

  <script>
    feather.replace();

    document.addEventListener("DOMContentLoaded", () => {
      const buttons = document.querySelectorAll(".add-to-cart");

      buttons.forEach((button) => {
        button.addEventListener("click", (event) => {
          event.preventDefault();

          const menu = {
            id: button.dataset.id,
            name: button.dataset.name,
            price: button.dataset.price,
            description: button.dataset.description,
            image: button.dataset.image,
          };

          let cart = JSON.parse(localStorage.getItem("cart")) || [];

          const existingMenuIndex = cart.findIndex(item => item.id === menu.id);
          if (existingMenuIndex === -1) {
            cart.push(menu);
          } else {
            alert(`${menu.name} sudah ada di keranjang`);
            return;
          }

          localStorage.setItem("cart", JSON.stringify(cart));

          alert(`${menu.name} telah ditambahkan ke keranjang`);

          window.location.href = "charts.php";
        });
      });
    });

    const loginButton = document.getElementById('login-button');
    const loginModal = document.getElementById('login-modal');
    const loginClose = document.getElementById('login-close');

    loginButton.addEventListener('click', function() {
      loginModal.classList.remove('opacity-0', 'pointer-events-none');
      loginModal.classList.add('opacity-100', 'pointer-events-auto');
    });

    loginClose.addEventListener('click', function() {
      loginModal.classList.remove('opacity-100', 'pointer-events-auto');
      loginModal.classList.add('opacity-0', 'pointer-events-none');
    });

    const orderModal = document.getElementById('order-modal');
    const orderClose = document.getElementById('order-close');
    const menuIdInput = document.getElementById('menu_id');

    document.addEventListener('click', function(event) {
      if (event.target.classList.contains('order-button')) {
        const menuId = event.target.getAttribute('data-id');

        menuIdInput.value = menuId;

        orderModal.classList.remove('opacity-0', 'pointer-events-none');
        orderModal.classList.add('opacity-100', 'pointer-events-auto');
      }
    });

    orderClose.addEventListener('click', function() {
      orderModal.classList.remove('opacity-100', 'pointer-events-auto');
      orderModal.classList.add('opacity-0', 'pointer-events-none');
    });
  </script>
</body>

</html>