<?php
/**
 * @var $formErrors array
 */
?>

<?php if (count($formErrors) > 0): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($formErrors as $attribute => $formError): ?>
            <?= $formError ?><br />
        <?php endforeach; ?>
    </div>

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
        <label for="description">Task</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <input type="submit" class="form-control btn-success" value="Create"/>
</form>