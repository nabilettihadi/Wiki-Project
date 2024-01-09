<!-- views/wikis/delete.php -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
    <h2>Delete Wiki</h2>
    <p>Are you sure you want to delete this wiki?</p>
    <form action="<?php echo URLROOT; ?>/wikis/delete/<?php echo $data['wiki']->wiki_id; ?>" method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="<?php echo URLROOT . '/wikis/show/' . $data['wiki']->wiki_id; ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>