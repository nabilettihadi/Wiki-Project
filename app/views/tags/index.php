<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <title>
        <?php echo SITENAME; ?>
    </title>
</head>

<body>

    <body class="font-sans bg-gray-200">

        <!-- Admin Dashboard Section -->
        <section class="flex h-screen">

            <!-- Sidebar Section -->
            <!-- Sidebar Section -->
            <div class="lg:hidden">
    <button id="burgerBtn" class="text-white">
        <i class="fa fa-bars"></i>
    </button>
</div>
            <aside class="w-1/4 bg-indigo-800 text-white p-8" style="position: fixed; top: 0; height: 100vh;">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-4xl font-extrabold text-gray-800">
                        <?php echo $_SESSION['user_name']; ?>
                    </h2>

                </div>
                <nav>
                    <ul class="space-y-4">
                        <li>
                            <a href="<?php echo URLROOT; ?>/categories/index2"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <!-- Utilisation de couleurs Tailwind -->
                                <span class="mr-2">📁</span>
                                Manage Categories
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT; ?>/tags/index2"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <!-- Utilisation de couleurs Tailwind -->
                                <span class="mr-2">🏷️</span>
                                Manage Tags
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT; ?>/wikis/index1"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <!-- Utilisation de couleurs Tailwind -->
                                <span class="mr-2">📚</span>
                                Manage Wikis
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT; ?>/wikis/index"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <!-- Utilisation de couleurs Tailwind -->
                                <span class="mr-2">📊</span>
                                Dashboard Stats
                            </a>
                        </li>
                        <li>
                           
                                <a href="<?php echo URLROOT; ?>/tags/add"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <span class="mr-2">➕</span> <!-- Icône de porte ouverte, vous pouvez changer cela -->
                                Add Tag
                            </a>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo URLROOT; ?>/users/logout"
                                class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                                <span class="mr-2">🚪</span> <!-- Icône de porte ouverte, vous pouvez changer cela -->
                                Logout
                            </a>
                        </li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content Section -->
            <div class="w-3/4 p-8  rounded-md shadow-md"> <!-- Utilisation de couleurs Tailwind -->

                <!-- Main Content Section -->

                <!-- Dashboard Section -->
                <section class="container ml-80 my-8">
                <div class="row mb-3">
                                <div class="col-md-6 ">
                                    <h1 class="text-2xl font-semibold">Tags</h1>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="<?php echo URLROOT; ?>/tags/add" class="btn btn-primary">
                                        <i class="fa fa-pencil"></i> Ajouter Tag
                                    </a>
                                </div>


                    <div class="flex flex-row flex-wrap gap-20  bg-gray-200">
                        <?php foreach ($data['tags'] as $tag): ?>
                            <div
                                class="w-full max-w-sm bg-indigo-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex justify-end px-4 pt-4">
                                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                                        type="button">
                                        <span class="sr-only">Open dropdown</span>
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 16 3">
                                            <path
                                                d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                        </svg>
                                    </button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown"
                                        class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                        <ul class="py-2" aria-labelledby="dropdownButton">
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
                                                    Data</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center pb-10">
                                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                        src="https://cdn.shopify.com/app-store/listing_images/fe222c0ac4c5bc493a66b0f2f401cdb2/icon/CJvW-v_htPsCEAE=.png"
                                        alt="Bonnie image" />
                                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                                        <?php echo $tag->tagName; ?>
                                    </h5>
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        <?php echo $tag->categoryName; ?>
                                    </span>
                                    <div class="flex flex-col mt-4 md:mt-6">
                                        <form class="flex items-center"
                                            action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tagId; ?>"
                                            method="post">
                                            <input type="text" name="tag_name"
                                                class="form-input border border-gray-300 rounded-md"
                                                value="<?php echo $tag->tagName; ?>">
                                            <button type="submit" class="btn btn-success ml-2">Enregistrer</button>
                                        </form>
                                        <form class="flex items-center"
                                            action="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tagId; ?>"
                                            method="post">
                                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </section>

            </div>
        </section>

    </body>

    <?php require APPROOT . '/views/inc/footer.php'; ?>