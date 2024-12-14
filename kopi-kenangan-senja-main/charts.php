<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Belanja</title>
  <style>
    body {
      background-color: #f0f4f8;
      color: #2d3748;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .title {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 20px;
      color: #3182ce;
    }

    .cart-section {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .cart-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 20px;
    }

    .cart-item {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
      text-align: left;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .item-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
    }

    .item-info {
      flex-grow: 1;
    }

    .item-name {
      font-size: 1.25rem;
      font-weight: bold;
      color: #2d3748;
    }

    .item-price {
      color: #38a169;
      font-size: 1.1rem;
    }

    .item-description {
      font-size: 0.9rem;
      color: #718096;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .delete-button,
    .order-button {
      padding: 10px 20px;
      margin: 2px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .delete-button {
      background-color: #e53e3e;
      color: #fff;
    }

    .delete-button:hover {
      background-color: #c53030;
    }

    .order-button {
      background-color: #4299e1;
      color: #fff;
    }

    .order-button:hover {
      background-color: #3182ce;
    }

    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 50;
    }

    .hidden {
      display: none;
    }

    .modal-content {
      background: #fff;
      color: #2d3748;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 400px;
      position: relative;
    }

    .modal-close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }

    .label {
      display: block;
      margin: 10px 0 5px;
      color: #2d3748;
    }

    .input {
      width: 100%;
      padding: 8px;
      border: 1px solid #cbd5e0;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    .submit-button {
      width: 100%;
      padding: 10px;
      background-color: #38a169;
      color: #fff;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .submit-button:hover {
      background-color: #2f855a;
    }

    .empty-cart {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      text-align: center;
      color: #718096;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1 class="title">Keranjang Belanja</h1>
    <section id="cart" class="cart-section">
      <div id="cart-items" class="cart-grid"></div>
    </section>
  </div>

  <div id="order-modal" class="modal hidden">
    <form action="../controllers/OrderController.php" method="POST" enctype="multipart/form-data" class="modal-content">
      <button id="order-close" type="button" class="modal-close">&times;</button>

      <input type="hidden" id="menu-id" name="menu_id">

      <label for="orderer_name" class="label">Nama Kamu</label>
      <input type="text" id="orderer_name" name="orderer_name" class="input" required>

      <label for="quantity" class="label">Jumlah Pesanan</label>
      <input type="text" id="quantity" name="quantity" class="input" required>

      <label for="table_number" class="label">Nomor Meja</label>
      <input type="text" id="table_number" name="table_number" class="input" required>

      <button type="submit" class="submit-button">BUAT PESANAN</button>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const cart = JSON.parse(localStorage.getItem("cart")) || [];
      const cartContainer = document.getElementById("cart-items");

      if (cart.length === 0) {
        cartContainer.innerHTML = "<p class='empty-cart'>Keranjang belanja masih kosong</p>";
        return;
      }

      cart.forEach((menu, index) => {
        const item = document.createElement("div");
        item.classList.add("cart-item");

        item.innerHTML = `
          <img src="${menu.image}" alt="${menu.name}" class="item-image">
          <div class="item-info">
            <h3 class="item-name">${menu.name}</h3>
            <p class="item-price">IDR ${menu.price}</p>
            <p class="item-description">${menu.description}</p>
          </div>
          <div class="button-group">
            <button class="delete-button" data-index="${index}">Hapus</button>
            <button class="order-button" data-id="${index}">Pesan Sekarang</button>
          </div>
        `;

        cartContainer.appendChild(item);
      });

      document.querySelectorAll(".delete-button").forEach((button) => {
        button.addEventListener("click", (event) => {
          const index = event.target.dataset.index;
          cart.splice(index, 1);
          localStorage.setItem("cart", JSON.stringify(cart));
          location.reload();
        });
      });

      const orderModal = document.getElementById("order-modal");
      const orderClose = document.getElementById("order-close");
      const menuIdInput = document.getElementById("menu-id");

      document.querySelectorAll(".order-button").forEach((button) => {
        button.addEventListener("click", (event) => {
          const index = event.target.dataset.id;
          menuIdInput.value = index;
          orderModal.classList.remove("hidden");
        });
      });

      orderClose.addEventListener("click", () => {
        orderModal.classList.add("hidden");
      });
    });
  </script>
</body>

</html>