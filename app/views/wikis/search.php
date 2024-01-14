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
            <section class="container ml-80 my-8">
                <div class="wikis-list">
                    <div class="flex flex-row flex-wrap gap-20 bg-gray-200">
                        <?php foreach ($data['wikis'] as $wiki): ?>
                            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg"
                                    alt="Sunset in the mountains">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl">
                                        <?php echo $wiki->title; ?>
                                    </div>
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex">
                                            <?php if ($wiki->author_id == $_SESSION['user_id']): ?>
                                                <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->wiki_id; ?>"
                                                    class="text-blue-500 hover:text-blue-700 mr-2">
                                                    <i class="fas fa-edit"></i> Modifier
                                                </a>
                                                <form class="d-inline"
                                                    action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->wiki_id; ?>"
                                                    method="post"
                                                    onsubmit="return confirm('Are you sure you want to delete this wiki?');">
                                                    <button type="submit" class="mt-2 text-red-600">Supprimer</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-base break-words">
                                        <?php echo (strlen($wiki->content) > 100) ? substr($wiki->content, 0, 50) . '...' : $wiki->content; ?>
                                    </p>
                                    <p class="card-text"><strong>Catégorie:</strong>
                                        <?php echo $wiki->category_name; ?>
                                    </p>
                                </div>
                                <div class="px-3 pt-4 pb-2">
                                    <?php foreach ($wiki->tags as $tag): ?>
                                        <span
                                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                            #
                                            <?php echo $tag; ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="px-6 pt-4 pb-2">
                                    <a href="<?php echo URLROOT; ?>/wikis/show/<?php echo $wiki->wiki_id; ?>"
                                        class="inline-block bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
    </script>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>