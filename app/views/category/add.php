<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/tags/index"
    class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full inline-flex items-center mt-10">
    <i class="fas fa-arrow-left mr-2"></i> Back
</a>
<div class="max-w-md mx-auto mt-10 p-6 bg-gradient-to-r from-blue-500 to-blue-800 rounded-lg shadow-lg text-gray-800">
    <h2 class="text-3xl font-extrabold mb-6 text-white">Create a New Category</h2>

    <form action="<?php echo URLROOT; ?>/Categories/add" method="post">
        <div class="mb-6">
            <label for="category_name" class="block text-sm font-semibold text-gray-200 mb-2">Category Name:
                <sup>*</sup></label>
            <input type="text" name="category_name"
                class="w-full p-3 bg-white bg-opacity-20 border border-white border-opacity-40 rounded focus:outline-none focus:border-blue-300"
                value="<?php echo $data['category_name']; ?>">

            <?php if (!empty($data['category_name_err'])): ?>
                <p class="text-red-300 text-xs italic mt-2">
                    <?php echo $data['category_name_err']; ?>
                </p>
            <?php endif; ?>
        </div>

        <button type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline-blue">
            Create
        </button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>