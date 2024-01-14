<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex bg-gray-100 p-4 w-72 space-x-4 rounded-lg mb-4">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-30" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
    <input id="searchInput" class="bg-gray-100 outline-none" type="text"
        placeholder="Rechercher par titre, tags, catégorie ou contenu..." />
</div>

<div id="searchResults"></div>
<div id="searchResultsContainer">
    <?php flash('wiki_message'); ?>


    <div class="flex flex-row flex-wrap md:mx-auto gap-20  bg-gray-200">

        <?php foreach ($data['wikis'] as $wiki): ?>
            <div class="max-w-sm rounded overflow-hidden shadow-lg ">
                <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center mb-2">
                        <div class="font-bold text-xl">
                            <?php echo $wiki->title; ?>
                        </div>
                        <div class="flex">
                            <?php if ($wiki->author_id == $_SESSION['user_id']): ?>
                                <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->wiki_id; ?>"
                                    class="text-blue-500 hover:text-blue-700 mr-2">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                                <form class="d-inline"
                                    action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->wiki_id; ?>" method="post"
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
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#
                        <?php echo implode(', ', (array) $wiki->tags); ?>
                    </span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
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
    <?php require APPROOT . '/views/inc/footer.php'; ?>