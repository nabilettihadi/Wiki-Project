<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/tags/index2" class="bg-red-500 text-white px-4 py-2 mt-10 inline-flex items-center"><i class="fa fa-backward mr-2"></i> Back</a>

<div class="bg-white mt-5 p-5 rounded-md shadow-md max-w-md mx-auto">
    <h2 class="text-3xl font-bold mb-4">Add Tags</h2>

    <form action="<?php echo URLROOT; ?>/Tags/add" method="post">
        <div class="mb-4">
            <label for="tag_name" class="block text-gray-700 text-sm font-bold mb-2">Tag Name: <sup>*</sup></label>
            <input type="text" name="tag_name" class="w-full p-3 border rounded-md focus:outline-none focus:border-blue-500 transition duration-150 <?php echo (!empty($data['tag_name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['tag_name']; ?>">

            <?php if (!empty($data['tag_name_err'])) : ?>
                <p class="text-red-500 text-xs italic"><?php echo $data['tag_name_err']; ?></p>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Select Category: <sup>*</sup></label>
            <select name="category_id" class="w-full p-3 border rounded-md focus:outline-none focus:border-blue-500 transition duration-150 <?php echo (!empty($data['category_id_err'])) ? 'border-red-500' : ''; ?>">
                <?php foreach ($data['categories'] as $category) : ?>
                    <option value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option>
                <?php endforeach; ?>
            </select>

            <?php if (!empty($data['category_id_err'])) : ?>
                <p class="text-red-500 text-xs italic"><?php echo $data['category_id_err']; ?></p>
            <?php endif; ?>
        </div>

        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">Create</button>
        </div>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

