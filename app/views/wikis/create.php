<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Create a Wiki</h2>
    <form action="<?php echo URLROOT; ?>/wikis/create" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo isset($data['title']) ? $data['title'] : ''; ?>">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" class="form-control"><?php echo isset($data['content']) ? $data['content'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select name="category_id" class="form-control">
                <?php if (!empty($data['categories'])) : ?>
                    <?php foreach ($data['categories'] as $category) : ?>
                        <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <option value="">No categories available</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tags">Tags:</label>
            <select name="tags[]" class="form-control" multiple>
                <?php foreach ($data['tags'] as $tag) : ?>
                    <option value="<?php echo $tag->tagId; ?>"><?php echo $tag->tagName; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Wiki</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

