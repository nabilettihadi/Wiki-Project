<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Ajouter un Wiki</h1>
    </div>
</div>

<form action="<?php echo URLROOT; ?>/wikis/add" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Contenu</label>
        <textarea name="content" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Catégorie</label>
        <select name="category_id" id="categoryId" class="form-select">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <input type="text" name="tags" class="form-control">

        <div id="tagsContainer"></div>
    </div>
    <div class="pt-1 mb-3 d-flex mt-2 justify-content-end">
        <button class="btn btn-primary btn-md btn-block" type="submit" name="submit">Valider</button>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectedTags = [];
        var tagsContainer = document.getElementById("tagsContainer");
        var categorySelect = document.getElementById("categoryId");

        function updateTags() {
            tagsContainer.innerHTML = "";

            var categoryId = categorySelect.value;
            var tags = <?php echo json_encode($data['categoryTags']); ?>[categoryId];

            if (tags) {
                tags.forEach(function (tag) {
                    var tagButton = document.createElement("button");
                    tagButton.textContent = tag.tag_name;
                    tagButton.type = "button";
                    tagButton.classList.add("bg-blue-200", "text-blue-800", "text-sm", "font-medium", "me-2", "cursor-pointer", "px-3", "py-1", "rounded");
                    tagButton.dataset.tagId = tag.tag_id;

                    tagButton.addEventListener("click", function () {
                        this.classList.toggle("bg-blue-500");
                        var index = selectedTags.indexOf(tag.tag_id);
                        if (index === -1) {
                            selectedTags.push(tag.tag_id);
                        } else {
                            selectedTags.splice(index, 1);
                        }
                        selectedTagsInput.value = JSON.stringify(selectedTags);
                    });

                    tagsContainer.appendChild(tagButton);
                });
            }
        }

        updateTags();

        categorySelect.addEventListener("change", function () {
            selectedTags = [];
            updateTags();
        });
    });

    function ToDetailWiki(element) {
        var wikiId = element.getAttribute('data-wiki-id');
        var wikiUrl = "<?php echo URLROOT . '/WikiController/singleWiki/'; ?>" + wikiId;
        window.location.href = wikiUrl;
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>

