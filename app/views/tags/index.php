<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">

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
                <button id="close-mobile-menu"
                    class="text-white p-2 focus:outline-none focus:bg-gray-700 focus:text-white">
                    ✕
                </button>
            </div>
            <div class="flex items-center justify-center h-screen">
                <ul class="list-reset flex flex-col items-center">
                    <li class="nav-mobile-link"><a href="<?php echo URLROOT; ?>/wikis/index">Dashboard</a></li>
                    <li class="nav-mobile-link"><a href="<?php echo URLROOT; ?>/wikis/index1">Manage Wikis</a></li>
                    <li class="nav-mobile-link"><a href="<?php echo URLROOT; ?>/categories/index2">Manage Categories</a>
                    </li>
                    <li class="nav-mobile-link"><a href="<?php echo URLROOT; ?>/tags/index2">Manage Tags</a></li>
                    <li class="nav-mobile-link"><a href="<?php echo URLROOT; ?>/users/logout">Logout</a></li>
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
<section class="container mx-auto lg:ml-5 my-8 max-w-md:mx-auto">

<?php flash('tag_message'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold">Tags</h1>
    <a href="<?php echo URLROOT; ?>/tags/add"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
        <!-- Icon -->
        <i class="fas fa-plus-circle mr-2"></i>
        Ajouter Tag
    </a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($data['tags'] as $tag): ?>
        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
            <img class="w-full h-48 object-cover object-center"
                src="https://cdn.shopify.com/app-store/listing_images/fe222c0ac4c5bc493a66b0f2f401cdb2/icon/CJvW-v_htPsCEAE=.png"
                alt="Bonnie image" />
            <div class="p-6">
                <h5 class="text-xl font-medium text-gray-900 mb-2">
                    <?php echo $tag->tagName; ?>
                </h5>
                <p class="text-sm text-gray-500">
                    <?php echo $tag->categoryName; ?>
                </p>
            </div>
            <div class="p-4">
                <form class="flex items-center mb-2"
                    action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tagId; ?>" method="post">
                    <input type="text" name="tag_name"
                        class="form-input border border-gray-300 rounded-md p-2 mr-2 focus:outline-none focus:border-blue-500"
                        value="<?php echo $tag->tagName; ?>">
                    <button type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Enregistrer
                    </button>
                    <!-- Display error message if it exists -->
                    <?php if (isset($data['title_err']) && !empty($data['title_err'])): ?>
                        <span class="text-red-500 ml-2">
                            <?php echo $data['title_err']; ?>
                        </span>
                    <?php endif; ?>
                </form>

                <form class="flex items-center"
                    action="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tagId; ?>" method="post">
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Supprimer
                    </button>
                </form>
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

