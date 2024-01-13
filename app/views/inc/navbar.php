<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <!-- Include Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>
    <?php echo SITENAME; ?>
  </title>
</head>

<body class="font-sans bg-gray-200">

  <nav class="bg-gradient-to-r from-blue-300 to-blue-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
      <a class="text-xl font-bold" href="<?php echo URLROOT; ?>">
        <?php echo SITENAME; ?>
      </a>

      <div class="flex space-x-4">
        <a href="<?php echo URLROOT; ?>/tags/index" class="flex items-center hover:text-gray-300">
          <i class="fa-solid fa-tags mr-1"></i>
          Tags
        </a>
        <a href="<?php echo URLROOT; ?>/categories/index" class="flex items-center hover:text-gray-300">
          <i class="fa-solid fa-folder-open mr-1"></i>
          Category
        </a>

        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="<?php echo URLROOT; ?>/users/logout" class="flex items-center hover:text-gray-300">
            <i class="fa-solid fa-sign-out mr-1"></i>
            Logout
          </a>
        <?php else: ?>
          <a href="<?php echo URLROOT; ?>/users/register" class="flex items-center hover:text-gray-300">
            <i class="fa-solid fa-user-plus mr-1"></i>
            Register
          </a>
          <a href="<?php echo URLROOT; ?>/users/login" class="flex items-center hover:text-gray-300">
            <i class="fa-solid fa-sign-in-alt mr-1"></i>
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container mx-auto">
    <!-- Your content goes here -->
  </div>

</body>

</html>