<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid bg-light">
  <div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body p-5">
          <?php flash('register_success'); ?>
          <h2 class="text-center mb-4">Login</h2>
          <form action="<?php echo URLROOT; ?>/users/login" method="post">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
              <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
              <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success btn-block">Login</button>
              <p class="mt-3">No account? <a href="<?php echo URLROOT; ?>/users/register">Register</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
