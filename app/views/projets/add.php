<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/projets" class="btn btn-light"><i class="fa fa-backward">Back</i></a>
      <div class="card card-body bg-light mt-5">

        <h2>ADD PROJECT</h2>
       
        <form action="<?php echo URLROOT; ?>/projets/add" method="post">
          <div class="form-group">
            <label for="nom_projet"> Project Name: <sup>*</sup></label>
            <input type="text" name="nom_projet" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nom_projet']; ?>">
            <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>
         
          <input type="submit" value="Creat" class="btn  btn-primary btn-block">
        </form>
      </div>
 

<?php require APPROOT . '/views/inc/footer.php'; ?>