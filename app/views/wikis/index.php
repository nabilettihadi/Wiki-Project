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
    <section class="flex">

        <!-- Sidebar Section -->
        <!-- Sidebar Section -->
        <aside class="w-1/5 bg-indigo-800 text-white p-8 fixed top-0 h-full">
            <div class="flex justify-between items-center mb-8">
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

        <!-- Main Content Section -->
        <div class="ml-72 p-8 rounded-md shadow-md overflow-x-hidden h-screen">
            <div class="mb-4">
                <input id="searchInput" class="bg-gray-100 p-4 w-full md:w-72 rounded-md outline-none"
                    placeholder="Rechercher par titre, tags, catégorie ou contenu..." />
            </div>

            <div id="searchResultsContainer"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <?php if (!empty($data['wikis'])): ?>
                    <?php foreach ($data['wikis'] as $wiki): ?>
                        <div class="max-w-sm rounded overflow-hidden shadow-lg">
                            <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                            <div class="px-6 py-4">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-bold text-xl">
                                        <?php echo $wiki->title; ?>
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
                                <span
                                    class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                    #
                                    <?php echo implode(', ', (array) $wiki->tags); ?>
                                </span>
                            </div>
                            <div class="flex justify-between items-center px-6 pt-4 pb-2">
                                <a href="<?php echo URLROOT; ?>/wikis/show/<?php echo $wiki->wiki_id; ?>"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                                    Read More
                                </a>
                                <?php if ($wiki->author_id == $_SESSION['user_id']): ?>
                                    <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->wiki_id; ?>"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 ml-2 transition">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form class="d-inline"
                                        action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->wiki_id; ?>" method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this wiki?');">
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 ml-2 transition">Supprimer</button>
                                    </form>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="no-results-message col-span-full">No results found.</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- Display search results here -->
        <div id="searchResults" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"></div>

    </section>

    <!-- Ajoutez cette balise de script avant la fermeture du corps body -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const searchResultsContainer = document.getElementById('searchResultsContainer');
            const searchResults = document.getElementById('searchResults');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.trim();

                // Check if the search term is empty
                if (searchTerm === '') {
                    // Perform AJAX request to retrieve all wikis
                    const xhrAllWikis = new XMLHttpRequest();

                    xhrAllWikis.open('GET', `<?php echo URLROOT; ?>/Wikis/allWikis`, true);

                    xhrAllWikis.onload = function () {
                        if (xhrAllWikis.status >= 200 && xhrAllWikis.status < 400) {
                            // Success! Handle the response and update the content
                            const response = JSON.parse(xhrAllWikis.responseText);
                            // Update the content based on the response
                            updateSearchResults(response);
                        } else {
                            // Error handling
                            console.error('Request failed');
                        }
                    };

                    xhrAllWikis.onerror = function () {
                        // Network error
                        console.error('Network error');
                    };

                    xhrAllWikis.send();

                    return;
                }

                // Perform AJAX request for the search term
                const xhr = new XMLHttpRequest();

                xhr.open('GET', `<?php echo URLROOT; ?>/Wikis/search?search=${searchTerm}`, true);

                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        // Success! Handle the response and update the content
                        const response = JSON.parse(xhr.responseText);
                        // Update the content based on the response
                        updateSearchResults(response);
                    } else {
                        // Error handling
                        console.error('Request failed');
                    }
                };

                xhr.onerror = function () {
                    // Network error
                    console.error('Network error');
                };

                xhr.send();
            });

            function updateSearchResults(results) {
                // Clear the existing wiki cards
                searchResultsContainer.innerHTML = '';

                if (results.length > 0) {
                    // Display the search results
                    results.forEach(result => {
                        const resultElement = document.createElement('div');
                        resultElement.classList.add('max-w-sm', 'rounded', 'overflow-hidden', 'shadow-lg');

                        resultElement.innerHTML = `
                        <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-bold text-xl">${result.title}</div>
                            </div>
                            <p class="text-gray-700 text-base break-words">${result.content}</p>
                            <p class="card-text"><strong>Catégorie:</strong>${result.category_name}</p>
                        </div>
                        <div class="px-3 pt-4 pb-2">
                            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                #${result.tags || 'None'}
                            </span>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                        <div class="flex justify-between items-center px-6 pt-4 pb-2">
                            <a href="<?php echo URLROOT; ?>/wikis/show/${result.wiki_id}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">
                                Read More
                            </a>
                            ${result.author_id == <?php echo $_SESSION['user_id']; ?> ? `
                                <a href="<?php echo URLROOT; ?>/wikis/edit/${result.wiki_id}" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700 ml-2 transition">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form id="deleteForm${result.wiki_id}" class="d-inline" action="<?php echo URLROOT; ?>/wikis/delete/${result.wiki_id}" method="post">
                                    <button type="submit" class="mt-2 bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 transition delete-wiki">Supprimer</button>
                                </form>
                            ` : ''}
                        </div>
</div>

                    `;

                        searchResultsContainer.appendChild(resultElement);
                    });
                } else {
                    // Display a message when no results are found
                    const noResultsMessage = document.createElement('p');
                    noResultsMessage.textContent = 'No results found.';
                    searchResultsContainer.appendChild(noResultsMessage);
                }
            }
        });
    </script>


    <?php require APPROOT . '/views/inc/footer.php'; ?>
</body>

</html>

