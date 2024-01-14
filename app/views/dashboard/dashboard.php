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

<body class="font-sans bg-gradient-to-r from-gray-100 via-gray-300 to-gray-200">

    <section class="flex h-screen">

        <aside class="w-1/5 bg-gradient-to-b from-indigo-700 to-indigo-800 text-white p-8"
            style="position: sticky; top: 0; height: 100vh;">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-extrabold">
                    <?php echo $_SESSION['user_name']; ?>
                </h2>
            </div>
            <nav>
                <ul class="space-y-4">
                    <li>
                        <a href="<?php echo URLROOT; ?>/categories/index2"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <span class="mr-2">📁</span> Manage Categories
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/tags/index2"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <span class="mr-2">🏷️</span> Manage Tags
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/wikis/index1"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <span class="mr-2">📚</span> Manage Wikis
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <span class="mr-2">📊</span> Dashboard Stats
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URLROOT; ?>/users/logout"
                            class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <span class="mr-2">🚪</span> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Section -->
        <div class="w-3/4 p-8 bg-white rounded-md shadow-md">

            <!-- Dashboard Section -->
            <section class="container mx-auto my-8">

                <!-- Header Section -->
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-4xl font-extrabold text-gray-800">Welcome BACK</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">Total Entities: <span
                                class="font-bold text-indigo-600">500</span></span>
                        <span class="text-gray-600">Active Entities: <span
                                class="text-green-500 font-bold">350</span></span>
                    </div>
                </div>

                <!-- Overview Cards Section -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- ... (rest of your content) ... -->
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <?php if (isset($data['totalWikis'])): ?>
                        <div class="bg-blue-500 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Wikis</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalWikis']; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['totalTags'])): ?>
                        <div class="bg-green-300 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Tags</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalTags']; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($data['totalCategories'])): ?>
                        <div class="bg-yellow-600 p-6 rounded-md shadow-md text-white">
                            <h3 class="text-lg font-semibold mb-4">Total Categories</h3>
                            <p class="text-3xl font-bold">
                                <?php echo $data['totalCategories']; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-800">Recent Activities</h3>
                    <!-- Include a more interactive list or timeline of recent activities here -->
                    <div class="bg-gray-100 p-6 rounded-md shadow-md">
                        <ul class="space-y-4">
                            <!-- ... (rest of your content) ... -->
                        </ul>
                    </div>
                </div>

            </section>
        </div>
    </section>

</body>

<?php require APPROOT . '/views/inc/footer.php'; ?>

</html>