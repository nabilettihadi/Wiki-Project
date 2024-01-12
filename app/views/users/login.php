<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="flex items-center justify-center h-screen bg-gradient-to-r from-blue-500 to-teal-500">
  <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-96 transform transition-transform hover:scale-105">
    <?php flash('register_success'); ?>
    <h2 class="text-4xl font-bold mb-6 text-center text-gray-800">Login</h2>
    <form action="<?php echo URLROOT; ?>/users/login" method="post">
      <div class="mb-4">
        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email: <sup>*</sup></label>
        <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:border-blue-500 bg-gray-100 text-gray-700 rounded-md <?php echo (!empty($data['email_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['email']; ?>">
        <span class="text-red-500 text-sm"><?php echo $data['email_err']; ?></span>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password: <sup>*</sup></label>
        <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 focus:outline-none focus:border-blue-500 bg-gray-100 text-gray-700 rounded-md <?php echo (!empty($data['password_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['password']; ?>">
        <span class="text-red-500 text-sm"><?php echo $data['password_err']; ?></span>
      </div>
      <div class="flex items-center justify-center">
        <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded focus:outline-none focus:shadow-outline-blue hover:bg-blue-600 focus:bg-blue-600 transition-transform transform hover:scale-105">
          Login
        </button>
      </div>
      <div class="mt-4 text-center">
        <a href="<?php echo URLROOT; ?>/users/register" class="text-blue-500 hover:text-blue-700 transition-transform transform hover:scale-105">No account? Register</a>
      </div>
    </form>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>



