<!-- views/tags/index.php -->
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Tags</h1>
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
    <select id="categoryFilter" class="form-control">
        <option value="">Toutes les catégories</option>
        <?php foreach ($data['categories'] as $category): ?>
            <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div id="tagContainer">
    <!-- La liste des tags sera affichée ici -->
    <?php foreach ($data['tags'] as $tag): ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $tag->tagName; ?></h4>
            <p>Category: <?php echo $tag->categoryName; ?></p>
            <div class="mt-3">
                <!-- Formulaires d'édition et de suppression -->
                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->tagId; ?>" method="post">
                    <div class="form-group">
                        <label for="tag_name">Modifier Tag:</label>
                        <input type="text" name="tag_name" class="form-control" value="<?php echo $tag->tagName; ?>">
                    </div>
                    <input type="submit" value="Enregistrer" class="btn btn-success">
                </form>
                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->tagId; ?>" method="post">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
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
                        tagElement.className = 'card card-body mb-3';
                        tagElement.innerHTML = `
                            <h4 class="card-title">${tag.tagName}</h4>
                            <p>Category: ${tag.categoryName}</p>
                            <div class="mt-3">
                                <!-- Formulaires d'édition et de suppression -->
                                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/edit/${tag.tagId}" method="post">
                                    <div class="form-group">
                                        <label for="tag_name">Modifier Tag:</label>
                                        <input type="text" name="tag_name" class="form-control" value="${tag.tagName}">
                                    </div>
                                    <input type="submit" value="Enregistrer" class="btn btn-success">
                                </form>
                                <form class="d-inline" action="<?php echo URLROOT; ?>/tags/delete/${tag.tagId}" method="post">
                                    <input type="submit" value="Supprimer" class="btn btn-danger">
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

<?php require APPROOT . '/views/inc/footer.php'; ?>
