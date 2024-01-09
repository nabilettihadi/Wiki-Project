<!-- views/wikis/show.php -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2><?php echo $data['wiki']->title; ?></h2>
    <p><?php echo $data['wiki']->content; ?></p>
    <a href="<?php echo URLROOT; ?>/wikis/index" class="btn btn-primary">Back to Wikis</a>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>