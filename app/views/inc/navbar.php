<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha384-lz84iMOYO5FRb0l/rL7P+hgP5aBcXMRJSn1XY3uYm5XcZ9tpBkdTEU1TlGquUqK1"
    crossorigin="anonymous">

  <title>
    <?php echo SITENAME; ?>
  </title>
</head>

<body class="font-sans bg-gray-200">

  <!-- Navbar -->
  <nav class="bg-gradient-to-r from-blue-300 to-blue-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center lg:hidden">
      <a class="text-xl font-bold" href="<?php echo URLROOT; ?>">
        <?php echo SITENAME; ?>
      </a>

      <!-- Hamburger icon -->
      <button id="toggleMenu" class="text-white">
        <i class="fas fa-bars"></i>
      </button>
    </div>

    <!-- Navigation links for larger screens -->
    <div class="hidden lg:flex lg:items-center lg:justify-between">
      <a class="text-xl font-bold" href="<?php echo URLROOT; ?>">
        <?php echo SITENAME; ?>
      </a>

      <div class="flex space-x-4">
        <a href="<?php echo URLROOT; ?>/tags/index" class="flex items-center hover:text-gray-300">
          <i class="fas fa-tags mr-1"></i>
          Tags
        </a>
        <a href="<?php echo URLROOT; ?>/categories/index" class="flex items-center hover:text-gray-300">
          <i class="fas fa-folder-open mr-1"></i>
          Category
        </a>

        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="<?php echo URLROOT; ?>/users/logout" class="flex items-center hover:text-gray-300">
            <i class="fas fa-sign-out-alt mr-1"></i>
            Logout
          </a>
        <?php else: ?>
          <a href="<?php echo URLROOT; ?>/users/register" class="flex items-center hover:text-gray-300">
            <i class="fas fa-user-plus mr-1"></i>
            Register
          </a>
          <a href="<?php echo URLROOT; ?>/users/login" class="flex items-center hover:text-gray-300">
            <i class="fas fa-sign-in-alt mr-1"></i>
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Hamburger menu for smaller screens -->
  <div id="mobileMenu" class="hidden lg:hidden bg-gradient-to-r from-blue-300 to-blue-800 text-white p-4">
    <div class="flex flex-col space-y-4">
      <a href="<?php echo URLROOT; ?>/tags/index" class="hover:text-gray-300">
        <i class="fas fa-tags mr-1"></i>
        Tags
      </a>
      <a href="<?php echo URLROOT; ?>/categories/index" class="hover:text-gray-300">
        <i class="fas fa-folder-open mr-1"></i>
        Category
      </a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?php echo URLROOT; ?>/users/logout" class="hover:text-gray-300">
          <i class="fas fa-sign-out-alt mr-1"></i>
          Logout
        </a>
      <?php else: ?>
        <a href="<?php echo URLROOT; ?>/users/register" class="hover:text-gray-300">
          <i class="fas fa-user-plus mr-1"></i>
          Register
        </a>
        <a href="<?php echo URLROOT; ?>/users/login" class="hover:text-gray-300">
          <i class="fas fa-sign-in-alt mr-1"></i>
          Login
        </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="container mx-auto">
    <!-- Your content goes here -->
  </div>

  <script>
    // Toggle mobile menu
    document.getElementById('toggleMenu').addEventListener('click', function () {
      document.getElementById('mobileMenu').classList.toggle('hidden');
    });
  </script>

</body>

</html>