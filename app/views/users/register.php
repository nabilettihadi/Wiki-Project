<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid bg-light min-vh-100">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <div class="card shadow">
        <div class="card-body p-5">
          <h2 class="text-center mb-4">Create An Account</h2>
          <p class="text-center">Please fill out this form to register with us</p>
          <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="form-group">
              <label for="username">Name:</label>
              <input type="text" name="username" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>">
              <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
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
            <div class="row">
              <div class="col">
                <button type="submit" class="btn btn-success btn-block">Register</button>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col text-center">
                <p>Have an account? <a href="<?php echo URLROOT; ?>/users/login">Login</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>


