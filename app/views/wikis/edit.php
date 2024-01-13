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

<a href="<?php echo URLROOT; ?>/wikis/index2" class="bg-red-500 text-white px-4 py-2 mt-10 inline-flex items-center"><i
        class="fa fa-backward mr-2"></i> Back</a>
<body class="font-sans bg-gray-200">
<div class="flex items-center justify-center my-8">
    <h1 class="text-4xl font-extrabold text-blue-500">Edit Wiki</h1>
</div>

<form action="<?php echo URLROOT; ?>/wikis/edit/<?php echo $data['wiki']->wiki_id; ?>" method="post"
    class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="mb-4">
        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
        <input type="text" name="title"
            class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"
            value="<?php echo $data['wiki']->title; ?>">
    </div>
    <div class="mb-4">
        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
        <textarea name="content"
            class="form-input w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500"><?php echo $data['wiki']->content; ?></textarea>
    </div>
    <div class="mb-4">
        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
        <select name="category_id"
            class="form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo $category->category_id; ?>" <?php echo ($category->category_id == $data['wiki']->category_id) ? 'selected' : ''; ?>>
                    <?php echo $category->category_name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-4">
        <label for="tags" class="block text-sm font-semibold text-gray-700 mb-2">Tags</label>
        <select name="tags[]"
            class="form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500" multiple>
            <?php foreach ($data['tags'] as $tag): ?>
                <option value="<?php echo $tag->tag_id; ?>" <?php echo (property_exists($data['wiki'], 'tags') && is_array($data['wiki']->tags) && in_array($tag->tag_id, $data['wiki']->tags)) ? 'selected' : ''; ?>>
                    <?php echo $tag->tag_name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit"
        class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline-blue">Update
        Wiki</button>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>