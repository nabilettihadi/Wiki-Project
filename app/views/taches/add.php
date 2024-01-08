<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/taches" class="btn btn-light"><i class="fa fa-backward">Back</i></a>
<div class="card card-body bg-light mt-5">

    <h2>ADD TASK</h2>

    <form action="<?php echo URLROOT; ?>/taches/add" method="post">
        <div class="form-group">
            <label for="Nom_Tache"> Task Name: <sup>*</sup></label>
            <input type="text" name="Nom_Tache" class="form-control form-control-lg <?php echo (!empty($data['Nom_Tache_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['Nom_Tache']; ?>">
            <span class="invalid-feedback"><?php echo $data['Nom_Tache_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="Date_debut"> Start Date: <sup>*</sup></label>
            <input type="date" name="Date_debut" class="form-control form-control-lg <?php echo (!empty($data['date_debut_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date_debut']; ?>">
            <span class="invalid-feedback"><?php echo $data['date_debut_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="Date_fin"> End Date: <sup>*</sup></label>
            <input type="date" name="Date_fin" class="form-control form-control-lg <?php echo (!empty($data['date_fin_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date_fin']; ?>">
            <span class="invalid-feedback"><?php echo $data['date_fin_err']; ?></span>
        </div>

        <div class="form-group">
            <label for="Project_ID"> Project: <sup>*</sup></label>
            <select name="Project_ID" class="form-control form-control-lg <?php echo (!empty($data['project_err'])) ? 'is-invalid' : ''; ?>">
                <option value="" selected disabled>Select Project</option>
                <?php foreach ($data['projets'] as $projet) : ?>
                    <option value="<?php echo $projet->id_Project; ?>"><?php echo $projet->nom_projet; ?></option>
                <?php endforeach; ?>
            </select>
            <span class="invalid-feedback"><?php echo $data['project_err']; ?></span>
        </div>

        <input type="submit" value="Create" class="btn btn-primary btn-block">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
