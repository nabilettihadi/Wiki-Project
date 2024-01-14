<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <title>
        <?php echo SITENAME; ?>
    </title>
</head>

<body class="font-sans bg-gray-200">

    <!-- Admin Dashboard Section -->
    <section class="flex flex-col lg:flex-row min-h-screen">

        <!-- Sidebar Section -->
        <aside class="lg:w-1/5 bg-gradient-to-r from-indigo-800 to-indigo-700 text-white p-8 hidden lg:block">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="<?php echo URLROOT; ?>/categories/index2" class="nav-link">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/tags/index2" class="nav-link">Tags</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/wikis/index1" class="nav-link">Wikis</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/wikis/index" class="nav-link">Dashboard</a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/users/logout" class="nav-link">Logout</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Mobile Navigation (Hamburger Menu) -->
        <nav id="mobile-menu" class="lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
            <div class="flex justify-end p-4">
                <button id="close-mobile-menu"
                    class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">
                    ✕
                </button>
            </div>
            <div class="flex items-center justify-center h-screen">
                <ul class="list-reset flex flex-col items-center space-y-4">
                    <li class="nav-mobile-link">
                        <a href="<?php echo URLROOT; ?>/wikis/index"
                            class="text-white hover:text-gray-300">Dashboard</a>
                    </li>
                    <li class="nav-mobile-link">
                        <a href="<?php echo URLROOT; ?>/wikis/index1" class="text-white hover:text-gray-300">Manage
                            Wikis</a>
                    </li>
                    <li class="nav-mobile-link">
                        <a href="<?php echo URLROOT; ?>/categories/index2" class="text-white hover:text-gray-300">Manage
                            Categories</a>
                    </li>
                    <li class="nav-mobile-link">
                        <a href="<?php echo URLROOT; ?>/tags/index2" class="text-white hover:text-gray-300">Manage
                            Tags</a>
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

        <!-- Content Section -->
        <section class="container mx-auto my-8 p-4 lg:ml-0 lg:mr-8 lg:pl-4">
            <?php flash('wiki_message'); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($data['wikis'] as $wiki): ?>
                    <div
                        class="max-w-sm mx-auto bg-white rounded overflow-hidden shadow-lg transition-transform transform hover:scale-103">
                        <img class="card-image w-full" src="https://v1.tailwindcss.com/img/card-top.jpg"
                            alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-xl card-title">
                                    <?php echo $wiki->title; ?>
                                </div>
                                <div class="flex">
                                    <a href="<?php echo URLROOT; ?>/wikis/archive/<?php echo $wiki->wiki_id; ?>"
                                        class="text-red-500 hover:text-red-700">
                                        Archive
                                    </a>
                                </div>
                            </div>
                            <p class="text-gray-700 text-base break-words card-content">
                                <?php echo $wiki->content; ?>
                            </p>
                            <p class="card-category"><strong>Category:</strong>
                                <?php echo $wiki->category_name; ?>
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <?php foreach ((array) $wiki->tags as $tag): ?>
                                <span class="tag">#
                                    <?php echo $tag; ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

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