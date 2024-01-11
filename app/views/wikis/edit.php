<!-- views/wikis/edit.php -->
<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Edit Wiki</h1>
    </div>
</div>

<form action="<?php echo URLROOT; ?>/wikis/edit/<?php echo $data['wiki']->wiki_id; ?>" method="post">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $data['wiki']->title; ?>">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control"><?php echo $data['wiki']->content; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select name="category_id" class="form-select">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category->category_id; ?>" <?php echo ($category->category_id == $data['wiki']->category_id) ? 'selected' : ''; ?>><?php echo $category->category_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select name="tags[]" class="form-select" multiple>
            <?php foreach ($data['tags'] as $tag): ?>
                <option value="<?php echo $tag->tag_id; ?>" <?php echo (property_exists($data['wiki'], 'tags') && is_array($data['wiki']->tags) && in_array($tag->tag_id, $data['wiki']->tags)) ? 'selected' : ''; ?>><?php echo $tag->tag_name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Wiki</button>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
