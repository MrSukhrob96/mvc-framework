<?php

/**
* @var $formErrors array
 */

?>
<h1>Login</h1>

<?php if (count($formErrors) > 0): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($formErrors as $attribute => $formError): ?>
            <?= $formError ?> <br />
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<form method="POST" action="">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</form>