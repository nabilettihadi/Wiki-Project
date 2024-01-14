<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title><?php echo SITENAME; ?></title>
</head>

<body class="font-sans bg-gray-200">
    <?php flash('category_message'); ?>
    
    <!-- Admin Dashboard Section -->
    <section class="flex flex-col lg:flex-row min-h-screen">

        <!-- Sidebar Section -->
        <aside class="lg:w-1/5 bg-gradient-to-r from-indigo-800 to-indigo-700 text-white p-8 hidden lg:block">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold"><?php echo $_SESSION['user_name']; ?></h2>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li><a href="<?php echo URLROOT; ?>/categories/index2" class="nav-link">Categories</a></li>
                    <li><a href="<?php echo URLROOT; ?>/tags/index2" class="nav-link">Tags</a></li>
                    <li><a href="<?php echo URLROOT; ?>/wikis/index1" class="nav-link">Wikis</a></li>
                    <li><a href="<?php echo URLROOT; ?>/wikis/index" class="nav-link">Dashboard</a></li>
                    <li><a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">Logout</a></li>
                </ul>
            </nav>
        </aside>

<!-- Mobile Navigation (Hamburger Menu) -->
<nav id="mobile-menu" class="lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
    <div class="flex justify-end p-4">
        <button id="close-mobile-menu" class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">
            ✕
        </button>
    </div>
    <div class="flex items-center justify-center h-screen">
        <ul class="list-reset flex flex-col items-center space-y-4">
            <li class="nav-mobile-link">
                <a href="<?php echo URLROOT; ?>/wikis/index" class="text-white hover:text-gray-300">Dashboard</a>
            </li>
            <li class="nav-mobile-link">
                <a href="<?php echo URLROOT; ?>/wikis/index1" class="text-white hover:text-gray-300">Manage Wikis</a>
            </li>
            <li class="nav-mobile-link">
                <a href="<?php echo URLROOT; ?>/categories/index2" class="text-white hover:text-gray-300">Manage Categories</a>
            </li>
            <li class="nav-mobile-link">
                <a href="<?php echo URLROOT; ?>/tags/index2" class="text-white hover:text-gray-300">Manage Tags</a>
            </li>
            <li class="nav-mobile-link">
                <a href="<?php echo URLROOT; ?>/users/logout" class="text-white hover:text-gray-300">Logout</a>
            </li>
        </ul>
    </div>
</nav>


        <!-- Mobile Navbar (Hamburger) -->
        <div class="lg:hidden">
            <button id="mobile-menu-button" class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">☰</button>
        </div>
        
        <!-- Main Content Section -->
        <div class="lg:ml-5 my-8 max-w-md:mx-auto w-full">
            <div class="flex justify-between items-center mb-8 mt-4">
                <h1 class="text-4xl font-bold text-blue-800">Categories</h1>
                <a href="<?php echo URLROOT; ?>/Categories/add" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    <i class="fas fa-plus-circle mr-2"></i> Add Category
                </a>
            </div>

            <?php if (isset($data['categories']) && is_array($data['categories'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($data['categories'] as $category): ?>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-800 text-white rounded-lg shadow-lg p-4 md:p-6 relative mb-4">
                            <h4 class="text-2xl font-semibold mb-4"><?php echo $category->category_name; ?></h4>
                            
                            <form action="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->category_id; ?>" method="post" class="flex flex-col items-center md:flex-row md:items-center">
                                <input type="hidden" name="id" value="<?php echo $category->category_id; ?>">
                                <label for="category_name" class="text-sm font-semibold text-gray-300 mb-2 md:mb-0 md:mr-4">Edit Category:</label>
                                <input type="text" id="category_name" name="category_name" class="p-2 border border-white border-opacity-40 rounded focus:outline-none focus:border-blue-300 bg-opacity-20 text-gray-800" value="<?php echo $category->category_name; ?>">
                                <input type="submit" value="Save" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full focus:outline-none focus:shadow-outline-blue mt-2 md:mt-0">
                            </form>

                            <form action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->category_id; ?>" method="post">
                                <input type="submit" value="Delete" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full focus:outline-none focus:shadow-outline-red mt-2 md:mt-0">
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        document.getElementById('close-mobile-menu').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
    </script>
</body>

</html>
