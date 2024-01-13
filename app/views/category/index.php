<?php require APPROOT . '/views/inc/header.php'; ?>

<?php flash('category_message'); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-4xl font-bold text-blue-800">Categories</h1>
    <a href="<?php echo URLROOT; ?>/Categories/add"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
        <i class="fa fa-pencil"></i> Add Category
    </a>
</div>

<?php if (isset($data['categories']) && is_array($data['categories'])): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($data['categories'] as $category): ?>
            <div class="bg-gradient-to-r from-blue-500 to-blue-800 text-white rounded-lg shadow-lg p-6 mb-6 relative">
                <h4 class="text-2xl font-semibold mb-4">
                    <?php echo $category->category_name; ?>
                </h4>

                <form action="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->category_id; ?>" method="post"
                    class="flex flex-col items-center md:flex-row md:items-center">
                    <input type="hidden" name="id" value="<?php echo $category->category_id; ?>">
                    <label for="category_name" class="text-sm font-semibold text-gray-300 mb-2 md:mb-0 md:mr-4">Edit Category:</label>
                    <input type="text" id="category_name" name="category_name"
                        class="p-2 border border-white border-opacity-40 rounded focus:outline-none focus:border-blue-300 bg-opacity-20 text-gray-800"
                        value="<?php echo $category->category_name; ?>">
                    <input type="submit" value="Save"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-full focus:outline-none focus:shadow-outline-blue mt-2 md:mt-0">
                </form>

                <form action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->category_id; ?>" method="post">
                    <input type="submit" value="Delete"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-full focus:outline-none focus:shadow-outline-red mt-2 md:mt-0">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>

