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
    <section class="flex h-screen">

        <!-- Navbar for Small Screens -->
        <nav class="md:hidden w-full bg-indigo-800 text-white p-4 fixed top-0 z-50">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
                <button id="toggleSidebar" class="focus:outline-none">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Sidebar Section -->
        <aside
            class="w-1/5 bg-indigo-800 text-white p-8 fixed top-0 h-full transition-all duration-300 transform -translate-x-full md:translate-x-0 md:relative md:static">
            <div class="hidden md:flex justify-between items-center mb-4 md:mb-8">
                <h2 class="text-2xl md:text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
                <button id="toggleSidebar" class="md:hidden focus:outline-none">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
            <nav class="hidden md:block">
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
                                class="flex items-center text-base md:text-lg py-2 px-4 rounded hover:bg-indigo-700">
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

        <!-- Main Content Section -->
        <div class="w-3/4 p-4 md:p-8 ml-auto">

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
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.querySelector('aside').classList.toggle('-translate-x-full');
        });
    </script>

</body>

</html>