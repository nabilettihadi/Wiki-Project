<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/taches" class="btn btn-light"><i class="fa fa-backward"> Retour</i></a>

<div class="card card-body bg-light mt-5">
    <h2>EDIT TASK</h2>
    <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $data['id']; ?>" method="post">
        <!-- Task Name -->
        <div class="form-group">
            <label for="Nom_Tache"> Task Name: <sup>*</sup></label>
            <input type="text" name="Nom_Tache" class="form-control form-control-lg <?php echo (!empty($data['Nom_Tache_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Nom_Tache']; ?>">
            <span class="invalid-feedback"><?php echo $data['Nom_Tache_err']; ?></span>
        </div>
        <!-- Start Date -->
        <div class="form-group">
            <label for="Date_debut"> Start Date: <sup>*</sup></label>
            <input type="date" name="Date_debut" class="form-control form-control-lg <?php echo (!empty($data['date_debut_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date_debut']; ?>">
            <span class="invalid-feedback"><?php echo $data['date_debut_err']; ?></span>
        </div>
        <!-- End Date -->
        <div class="form-group">
            <label for="Date_fin"> End Date: <sup>*</sup></label>
            <input type="date" name="Date_fin" class="form-control form-control-lg <?php echo (!empty($data['date_fin_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date_fin']; ?>">
            <span class="invalid-feedback"><?php echo $data['date_fin_err']; ?></span>
        </div>
        <!-- Submit Button -->
        <input type="submit" value="Update Task" class="btn btn-primary btn-block">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
