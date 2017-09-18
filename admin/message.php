<div class="msg">
    <?php if (isset($msg) AND ! empty($msg)): ?>
        <div class="alert alert-success fade in">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $msg; ?></strong>
        </div>
    <?php endif; ?>

    <?php if (isset($err) AND ! empty($err)): ?>
        <div class="alert alert-danger fade in">
            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo $err; ?></strong>
        </div>
    <?php endif; ?>
</div>