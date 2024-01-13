<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

    <title><?php echo SITENAME; ?></title>
</head>

<body class="font-sans bg-gray-200">

    <!-- Admin Dashboard Section -->
    <section class="flex h-screen">

        <!-- Sidebar Section -->
        <aside class="w-1/5 bg-indigo-800 text-white p-8 fixed top-0 h-full overflow-y-auto">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="<?php echo URLROOT; ?>/categories/index2"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                            <span class="mr-2">📁</span>
                            Manage Categories
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/tags/index2"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                            <span class="mr-2">🏷️</span>
                            Manage Tags
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/wikis/index1"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                            <span class="mr-2">📚</span>
                            Manage Wikis
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/wikis/index"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                            <span class="mr-2">📊</span>
                            Dashboard Stats
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/users/logout"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                            <span class="mr-2">🚪</span>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Section -->
        <div class="w-4/5 p-8 ml-auto">

            <!-- Dashboard Section -->
            <section class="container mx-auto my-8">
                <?php flash('wiki_message'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($data['wikis'] as $wiki): ?>
                        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
                            <img class="w-full h-48 object-cover object-center"
                                src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Wiki Image">
                            <div class="px-6 py-4">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-bold text-xl">
                                        <?php echo $wiki->title; ?>
                                    </div>
                                    <div class="flex">
                                        <a href="<?php echo URLROOT; ?>/wikis/archive/<?php echo $wiki->wiki_id; ?>"
                                            class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i> Archiver
                                        </a>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-base break-words">
                                    <?php echo $wiki->content; ?>
                                </p>
                                <p class="card-text"><strong>Category:</strong>
                                    <?php echo $wiki->category_name; ?>
                                </p>
                            </div>
                            <div class="px-6 pt-4 pb-2">
                                <?php foreach ((array)$wiki->tags as $tag): ?>
                                    <span
                                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#<?php echo $tag; ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </section>

</body>

<?php require APPROOT . '/views/inc/footer.php'; ?>

</html>
