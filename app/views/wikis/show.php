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
<a href="<?php echo URLROOT; ?>/wikis/index2" class="bg-red-500 text-white px-4 py-2 mt-10 inline-flex items-center"><i
        class="fa fa-backward mr-2"></i> Back</a>

<div
    class="container mx-auto mt-8 p-6 bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 rounded-lg shadow-lg text-white">
    <h1 class="text-4xl font-extrabold mb-4">
        <?php echo $data['wiki']->title; ?>
    </h1>

    <div class="mb-4 text-gray-200">
        <p>Created by:
            <?php echo $data['wiki']->author_name; ?>
        </p>
        <p>Created on:
            <?php echo $data['wiki']->created_at; ?>
        </p>
    </div>

    <p class="text-lg text-gray-100 mb-6">
        <?php echo $data['wiki']->content; ?>
    </p>

    <p class="text-gray-300 mb-6">Category:
        <?php echo $data['wiki']->category_name; ?>
    </p>

    <div class="mb-6">
        <span class="font-bold text-gray-200">Tags:</span>
        <?php foreach ($data['wiki']->tags as $tag): ?>
            <span class="inline-block bg-blue-700 rounded-full px-3 py-1 text-white text-sm font-semibold mr-2 mb-2">
                <?php echo $tag; ?>
            </span>
        <?php endforeach; ?>
    </div>
    <!-- Ajoutez d'autres détails du wiki si nécessaire -->
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>