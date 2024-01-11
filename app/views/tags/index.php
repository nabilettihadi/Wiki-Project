<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

  <title><?php echo SITENAME; ?></title>
</head>
<body>

<div class="flex h-screen bg-gray-100">
    <!-- Sidebar Section -->
    <aside class="w-1/4 bg-indigo-800 text-white p-8">
        <div class="mb-8">
            <h2 class="text-3xl font-semibold">Admin Dashboard</h2>
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
                    <a href="<?php echo URLROOT; ?>/wikis/index"
                        class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                        <span class="mr-2">📚</span>
                        Manage Wikis
                    </a>
                </li>
                <li>
                    <a href="dashboard.php" class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                        <span class="mr-2">📊</span>
                        Dashboard Stats
                    </a>
                </li>
                <li>
                <a href="<?php echo URLROOT; ?>/users/logout" class="flex items-center text-lg py-2 px-4 rounded hover:bg-indigo-700">
                    <span class="mr-2">🚪</span> <!-- Icône de porte ouverte, vous pouvez changer cela -->
                    Logout
                </a>
            </li>

            </ul>
        </nav>
    </aside>

    <!-- Main Content Section -->
    <div class="w-3/4 p-8 bg-gray-200 rounded-md shadow-md">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="text-2xl font-semibold">Tags</h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo URLROOT; ?>/tags/add" class="btn btn-primary">
                    <i class="fa fa-pencil"></i> Ajouter Tag
                </a>
            </div>
        </div>

        <!-- Ajoutez la liste déroulante pour la catégorie -->
        <div class="mb-4">
            <label for="categoryFilter" class="form-label">Filtrer par catégorie:</label>
            <select id="categoryFilter" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($data['categories'] as $category): ?>
                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="tagContainer">
            <!-- La liste des tags sera affichée ici -->
            <?php foreach ($data['tags'] as $tag): ?>
                <div class="card bg-white shadow-md mb-3 p-4">
                    <h4 class="text-xl font-semibold mb-2"><?php echo $tag->tagName; ?></h4>
                    <p class="text-gray-600">Category: <?php echo $tag->categoryName; ?></p>
                    <div class="mt-3 flex space-x-2">
                        <!-- Formulaires d'édition et de suppression -->
                        <form class="flex items-center" action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tagId; ?>" method="post">
                            <input type="text" name="tag_name" class="form-input border border-gray-300 rounded-md" value="<?php echo $tag->tagName; ?>">
                            <button type="submit" class="btn btn-success ml-2">Enregistrer</button>
                        </form>
                        <form class="flex items-center" action="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tagId; ?>" method="post">
                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script>
            document.getElementById('categoryFilter').addEventListener('change', function () {
                filterTagsByCategory(this.value);
            });

            function filterTagsByCategory(categoryId) {
                fetch('<?php echo URLROOT; ?>/tags/filterByCategory', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'category_id=' + categoryId
                })
                    .then(response => response.json())
                    .then(data => {
                        // Mettez à jour la liste des tags
                        const tagContainer = document.getElementById('tagContainer');
                        tagContainer.innerHTML = ''; // Effacez le contenu existant

                        if (data.tags.length > 0) {
                            data.tags.forEach(tag => {
                                const tagElement = document.createElement('div');
                                tagElement.className = 'card bg-white shadow-md mb-3 p-4';
                                tagElement.innerHTML = `
                                    <h4 class="text-xl font-semibold mb-2">${tag.tagName}</h4>
                                    <p class="text-gray-600">Category: ${tag.categoryName}</p>
                                    <div class="mt-3 flex space-x-2">
                                        <!-- Formulaires d'édition et de suppression -->
                                        <form class="flex items-center" action="<?php echo URLROOT; ?>/tags/edit/${tag.tagId}" method="post">
                                            <input type="text" name="tag_name" class="form-input border border-gray-300 rounded-md" value="${tag.tagName}">
                                            <button type="submit" class="btn btn-success ml-2">Enregistrer</button>
                                        </form>
                                        <form class="flex items-center" action="<?php echo URLROOT; ?>/tags/delete/${tag.tagId}" method="post">
                                            <button type="submit" class="btn btn-danger ml-2">Supprimer</button>
                                        </form>
                                    </div>
                                `;
                                tagContainer.appendChild(tagElement);
                            });
                        } else {
                            tagContainer.innerHTML = '<p>Aucun tag trouvé pour cette catégorie.</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        </script>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>