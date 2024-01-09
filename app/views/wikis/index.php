<!-- views/wikis/index.php -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <h2>Wikis</h2>
    <?php if ($_SESSION['user_role'] === 'admin') : ?>
        <div class="mb-3">
            <a href="<?php echo URLROOT . '/wikis/create'; ?>" class="btn btn-success">Add Wiki</a>
        </div>
    <?php endif; ?>
    <div class="row">
        <?php foreach ($data['wikis'] as $wiki) : ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $wiki->title; ?></h5>
                        <p class="card-text"><?php echo substr($wiki->content, 0, 100) . '...'; ?></p>
                        <a href="<?php echo URLROOT . '/wikis/show/' . $wiki->wiki_id; ?>" class="btn btn-primary">Read More</a>
                        <?php if ($_SESSION['user_role'] === 'admin') : ?>
                            <!-- Ajoutez ici le lien pour l'édition et la suppression du wiki -->
                            <a href="<?php echo URLROOT . '/wikis/edit/' . $wiki->wiki_id; ?>" class="btn btn-secondary">Edit</a>
                            <a href="<?php echo URLROOT . '/wikis/delete/' . $wiki->wiki_id; ?>" class="btn btn-danger">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>