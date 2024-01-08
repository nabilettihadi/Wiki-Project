<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('projet_message'); ?>

<div class="row mb-3">
    <div class="col-md-6">
        <h1>Projets</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?php echo URLROOT; ?>/projets/add" class="btn btn-primary">
            <i class="fa fa-pencil"></i> Ajouter Projet
        </a>
    </div>
</div>

<?php
$user_id = $_SESSION['user_id'];

foreach ($data['projets'] as $projet):
    if ($projet->userId != $user_id) {
        continue;
    }
    ?>

    <div class="card card-body mb-3">
        <h4 class="card-title"><?php echo $projet->nom_projet; ?></h4>

        <div class="bg-light p-2 mb-3">
            Créé par <?php echo $projet->name; ?> le <?php echo $projet->projetCreated; ?>
        </div>

        <a href="<?php echo URLROOT; ?>/taches/index/<?php echo $projet->projetId; ?>" class="btn btn-primary">Tâches</a>

        <?php if ($projet->userId == $_SESSION['user_id']): ?>
            <div class="mt-3">
                <a href="<?php echo URLROOT; ?>/projets/edit/<?php echo $projet->projetId; ?>" class="btn btn-dark">Modifier</a>

                <form class="d-inline" action="<?php echo URLROOT; ?>/projets/delete/<?php echo $projet->projetId; ?>" method="post">
                    <input type="submit" value="Supprimer" class="btn btn-danger">
                </form>
            </div>
        <?php endif; ?>
    </div>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
