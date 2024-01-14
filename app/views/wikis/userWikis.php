<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <title>
        <?php echo SITENAME; ?>
    </title>
</head>

<body class="font-sans bg-gray-200">

    <!-- Admin Dashboard Section -->
    <section class="flex flex-col lg:flex-row min-h-screen">

        <!-- Sidebar Section -->
        <aside class="lg:w-1/5 bg-indigo-800 text-white p-8 hidden lg:block">
            <div class="mb-8">
                <h2 class="text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
            </div>
            <nav>
                <ul class="space-y-4">
                    <?php
                    $navItems = [
                        ['url' => URLROOT . '/wikis/index2', 'icon' => '🏠', 'text' => 'Home'],
                        ['url' => URLROOT . '/wikis/userWikis', 'icon' => '📚', 'text' => 'Mes wikis'],
                        ['url' => URLROOT . '/wikis/add', 'icon' => '➕', 'text' => 'Add wiki'],
                        ['url' => URLROOT . '/users/logout', 'icon' => '🚪', 'text' => 'Logout']
                    ];

                    foreach ($navItems as $item):
                        ?>
                        <li>
                            <a href="<?php echo $item['url']; ?>"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <span class="mr-2">
                                    <?php echo $item['icon']; ?>
                                </span>
                                <?php echo $item['text']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>

        <!-- Mobile Navigation (Hamburger Menu) -->
        <nav id="mobile-menu" class="lg:hidden fixed inset-0 bg-gray-800 bg-opacity-75 z-50 hidden">
            <div class="flex justify-end p-4">
                <button id="close-mobile-menu"
                    class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">✕</button>
            </div>
            <div class="flex items-center justify-center h-screen">
                <ul class="list-reset flex flex-col items-center space-y-4">
                    <?php foreach ($navItems as $item): ?>
                        <li class="nav-mobile-link">
                            <a href="<?php echo $item['url']; ?>" class="text-white hover:text-gray-300">
                                <?php echo $item['text']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>

        <!-- Mobile Navbar (Hamburger) -->
        <div class="lg:hidden">
            <button id="mobile-menu-button"
                class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">☰</button>
        </div>

        <!-- Main Content Section -->
        <div class="p-8 rounded-md shadow-md overflow-x-hidden h-screen">

            <!-- Dashboard Section -->
            <section class="container mx-auto my-8">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                    <?php foreach ($data['userWikis'] as $wiki): ?>
                        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
                            <img class="w-full h-48 object-cover object-center"
                                src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Wiki Image">
                            <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">
                                    <?php echo $wiki->title; ?>
                                </div>
                                <p class="text-gray-700 text-base mb-4">
                                    <?php echo $wiki->content; ?>
                                </p>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-700 text-sm">
                                            <?php if (property_exists($wiki, 'category_name')): ?>
                                                <strong>Catégorie:</strong>
                                                <?php echo $wiki->category_name; ?>
                                            <?php endif; ?>
                                        </p>
                                        <div class="mt-2">
                                            <?php if (property_exists($wiki, 'tags') && is_array($wiki->tags)): ?>
                                                <?php foreach ($wiki->tags as $tag): ?>
                                                    <span
                                                        class="inline-block bg-indigo-300 rounded-full px-2 text-white text-xs font-semibold mr-2 mb-2">
                                                        <?php echo $tag->tag_name; ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->wiki_id; ?>"
                                            class="text-blue-500 hover:text-blue-700 mr-2">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <form class="inline"
                                            action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->wiki_id; ?>"
                                            method="post"
                                            onsubmit="return confirm('Are you sure you want to delete this wiki?');">
                                            <button type="submit" class="text-red-600">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </section>

        </div>
    </section>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        document.getElementById('close-mobile-menu').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.add('hidden');
        });
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });
    </script>

</body>

</html>