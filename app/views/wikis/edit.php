<!-- views/wikis/edit.php -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Edit Wiki</h2>
    <form action="<?php echo URLROOT; ?>/wikis/edit/<?php echo $data['wiki']->wiki_id; ?>" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $data['wiki']->title; ?>">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" class="form-control"><?php echo $data['wiki']->content; ?></textarea>
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
                    <option value="<?php echo $tag->tag_id; ?>" <?php echo (in_array($tag->tag_id, $data['selectedTags'])) ? 'selected' : ''; ?>><?php echo $tag->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Wiki</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
