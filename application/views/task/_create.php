<?php
/**
 * @var $formAlert array
 */
?>
<?php if (count($formAlert) > 0): ?>
    <?php foreach ($formAlert as $typeAlert => $alerts): ?>
        <?php if (count($alerts) == 0): continue; endif; ?>
        <div class="alert alert-<?=($typeAlert == "error") ? "danger" : ($typeAlert == "success" ? "success" : "primary")?>" role="alert">
        <?php foreach ($alerts as $alert): ?>
            <?=$alert?> <br />
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

<?php endif; ?>

<form method="POST">
    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" class="form-control" id="username" placeholder="Jakhar" name="username">
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <input type="submit" class="form-control btn-outline-success btn-sm" value="Create"/>
</form>