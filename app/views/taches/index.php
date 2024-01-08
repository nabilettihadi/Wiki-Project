<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/projets" class="btn btn-light"><i class="fa fa-backward"> Retour</i></a>
<?php flash('tache_message'); ?>

<div class="container mt-5">
    <div class="row m-1 p-4">
        <div class="col">
            <!-- Search Form -->
            <form action="<?php echo URLROOT; ?>/taches/search" method="post" class="form-inline">
                <div class="form-group mr-2">
                    <input type="text" name="search_query" class="form-control" placeholder="Search tasks">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>

    <div class="row m-1 p-4">
        <div class="col">
            <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                <i class="fa fa-check bg-primary text-white rounded p-2"></i>
                <u>My Todo-s</u>
            </div>
        </div>
    </div>

    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            <div class="row">
                <div class="col">
                    <h4 class="text-center">To Do</h4>
                    <ul class="list-group to-do-list">
                        <?php foreach ($data['taches'] as $tache): ?>
                            <?php if ($tache->statut == 'to_do'): ?>
                                <li class="list-group-item todo-item">
                                    <div class="row px-3 align-items-center todo-item-content rounded">
                                        <div class="col-md-8">
                                            <span class="font-weight-bold">
                                                <?php echo isset($tache->Nome_Tache) ? $tache->Nome_Tache : 'Nom de la tâche non défini'; ?>
                                            </span>
                                            <br>
                                            <span class="text-muted">Deadline:
                                                <?php echo isset($tache->Date_fin) ? $tache->Date_fin : 'Pas de date limite'; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-4 todo-actions">
                                            <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $tache->id_tache; ?>"
                                                method="post" class="delete-form">
                                                <button type="submit" class="fa fa-pencil edit-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Modifier"></button>
                                            </form>

                                            <form class="delete-form"
                                                action="<?php echo URLROOT; ?>/taches/delete/<?php echo $tache->id_tache; ?>"
                                                method="post">
                                                <button type="submit" class="fa fa-trash delete-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Supprimer"></button>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="<?php echo URLROOT; ?>/taches/changeStatus/<?php echo $tache->id_tache; ?>"
                                        method="post" class="mt-2">
                                        <div class="form-group">
                                            <input type="hidden" name="tache_id" value="<?php echo $tache->id_tache; ?>">
                                            <select name="new_status" class="form-control">
                                                <option value="to_do" <?php echo ($tache->statut == 'to_do') ? 'selected' : ''; ?>>To Do</option>
                                                <option value="doing" <?php echo ($tache->statut == 'doing') ? 'selected' : ''; ?>>Doing</option>
                                                <option value="done" <?php echo ($tache->statut == 'done') ? 'selected' : ''; ?>>
                                                    Done</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Changer le statut</button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="text-center">Doing</h4>
                    <ul class="list-group doing-list">
                        <?php foreach ($data['taches'] as $tache): ?>
                            <?php if ($tache->statut == 'doing'): ?>
                                <li class="list-group-item todo-item">
                                    <div class="row px-3 align-items-center todo-item-content rounded">
                                        <div class="col-md-8">
                                            <span class="font-weight-bold">
                                                <?php echo isset($tache->Nome_Tache) ? $tache->Nome_Tache : 'Nom de la tâche non défini'; ?>
                                            </span>
                                            <br>
                                            <span class="text-muted">Deadline:
                                                <?php echo isset($tache->Date_fin) ? $tache->Date_fin : 'Pas de date limite'; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-4 todo-actions">
                                            <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $tache->id_tache; ?>"
                                                method="post" class="delete-form">
                                                <button type="submit" class="fa fa-pencil edit-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Modifier"></button>
                                            </form>

                                            <form class="delete-form"
                                                action="<?php echo URLROOT; ?>/taches/delete/<?php echo $tache->id_tache; ?>"
                                                method="post">
                                                <button type="submit" class="fa fa-trash delete-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Supprimer"></button>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="<?php echo URLROOT; ?>/taches/changeStatus/<?php echo $tache->id_tache; ?>"
                                        method="post" class="mt-2">
                                        <div class="form-group">
                                            <input type="hidden" name="tache_id" value="<?php echo $tache->id_tache; ?>">
                                            <select name="new_status" class="form-control">
                                                <option value="to_do" <?php echo ($tache->statut == 'to_do') ? 'selected' : ''; ?>>To Do</option>
                                                <option value="doing" <?php echo ($tache->statut == 'doing') ? 'selected' : ''; ?>>Doing</option>
                                                <option value="done" <?php echo ($tache->statut == 'done') ? 'selected' : ''; ?>>
                                                    Done</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Changer le statut</button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col">
                    <h4 class="text-center">Done</h4>
                    <ul class="list-group done-list">
                        <?php foreach ($data['taches'] as $tache): ?>
                            <?php if ($tache->statut == 'done'): ?>
                                <li class="list-group-item todo-item">
                                    <div class="row px-3 align-items-center todo-item-content rounded">
                                        <div class="col-md-8">
                                            <span class="font-weight-bold">
                                                <?php echo isset($tache->Nome_Tache) ? $tache->Nome_Tache : 'Nom de la tâche non défini'; ?>
                                            </span>
                                            <br>
                                            <span class="text-muted">Deadline:
                                                <?php echo isset($tache->Date_fin) ? $tache->Date_fin : 'Pas de date limite'; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-4 todo-actions">
                                            <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $tache->id_tache; ?>"
                                                method="post">
                                                <button type="submit" class="fa fa-pencil edit-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Modifier"></button>
                                            </form>

                                            <form class="delete-form"
                                                action="<?php echo URLROOT; ?>/taches/delete/<?php echo $tache->id_tache; ?>"
                                                method="post">
                                                <button type="submit" class="fa fa-trash delete-icon" data-toggle="tooltip"
                                                    data-placement="top" title="Supprimer"></button>
                                            </form>
                                        </div>
                                    </div>
                                    <form action="<?php echo URLROOT; ?>/taches/changeStatus/<?php echo $tache->id_tache; ?>"
                                        method="post" class="mt-2">
                                        <div class="form-group">
                                            <input type="hidden" name="tache_id" value="<?php echo $tache->id_tache; ?>">
                                            <select name="new_status" class="form-control">
                                                <option value="to_do" <?php echo ($tache->statut == 'to_do') ? 'selected' : ''; ?>>To Do</option>
                                                <option value="doing" <?php echo ($tache->statut == 'doing') ? 'selected' : ''; ?>>Doing</option>
                                                <option value="done" <?php echo ($tache->statut == 'done') ? 'selected' : ''; ?>>
                                                    Done</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary">Changer le statut</button>
                                    </form>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-1 p-3">
        <div class="col col-11 mx-auto">
            <form action="<?php echo URLROOT; ?>/taches/add" method="post">
                <input type="submit" value="Ajouter la Tâche" class="btn btn-success mt-3">
            </form>
        </div>
    </div>
</div>

<style>
    body {
        font-family: "Open Sans", sans-serif;
        line-height: 1.6;
    }

    .add-todo-input,
    .edit-todo-input {
        outline: none;
    }

    .add-todo-input:focus,
    .edit-todo-input:focus {
        border: none !important;
        box-shadow: none !important;
    }

    .view-opt-label,
    .date-label {
        font-size: 0.8rem;
    }

    .edit-todo-input {
        font-size: 1.7rem !important;
    }

    .todo-actions {
        visibility: hidden !important;
    }

    .todo-item:hover .todo-actions {
        visibility: visible !important;
    }

    .todo-item.editing .todo-actions .edit-icon {
        display: none !important;
    }

    body {
        font-family: "Open Sans", sans-serif;
        line-height: 1.6;
    }

    .add-todo-input,
    .edit-todo-input {
        outline: none;
    }

    .add-todo-input:focus,
    .edit-todo-input:focus {
        border: none !important;
        box-shadow: none !important;
    }

    .view-opt-label,
    .date-label {
        font-size: 0.8rem;
    }

    .edit-todo-input {
        font-size: 1.7rem !important;
    }

    .todo-actions {
        visibility: hidden !important;
    }

    .todo-item:hover .todo-actions {
        visibility: visible !important;
    }

    .todo-item.editing .todo-actions .edit-icon {
        display: none !important;
    }

    /* Custom styles for the to-do, doing, and done lists */
    .to-do-list,
    .doing-list,
    .done-list {
        min-height: 200px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 10px;
    }

    .todo-item .todo-actions {
        visibility: hidden;
        font-size: 20px;
    }

    .todo-item:hover .todo-actions {
        visibility: visible;
    }

    .todo-actions i {
        margin-right: 10px;
        cursor: pointer;
    }

    .todo-actions i:hover {
        color: red;
        
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(function (form) {
            form.addEventListener('submit', function () {
                // The form will submit without confirmation
            });
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>