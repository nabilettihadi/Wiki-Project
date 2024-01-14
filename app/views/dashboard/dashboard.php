<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

    <title>
        <?php echo SITENAME; ?>
    </title>
</head>

<body class="font-sans bg-gray-200">

    <!-- Admin Dashboard Section -->
    <section class="flex flex-col lg:flex-row min-h-screen w-full">

        <!-- Sidebar Section -->
        <aside class="lg:w-1/5 bg-gradient-to-r from-indigo-800 to-indigo-700 text-white p-8 hidden lg:block">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
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
            <button id="mobile-menu-button"
                class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">
                ☰
            </button>
        </div>

        <!-- Main Content Section -->
        <div class="w-3/4 p-8 bg-white rounded-md shadow-md">

            <!-- Dashboard Section -->
            <section class="container mx-auto my-8">

                <!-- Header Section -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-4xl font-extrabold text-gray-800">Welcome BACK</h2>
                </div>

                <!-- Overview Cards Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- ... (rest of your content) ... -->
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php if (isset($data['totalWikis'])): ?>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Wikis</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalWikis']; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['totalTags'])): ?>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Tags</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalTags']; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['totalCategories'])): ?>
                        <div class="bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Categories</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalCategories']; ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>


            </section>
        </div>
    </section>

    <?php require APPROOT . '/views/inc/footer.php'; ?>
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