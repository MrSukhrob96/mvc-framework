<?php

/**
 * @var $formErrors array
 */

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= \Framework\Framework::$urlGenerator->generate('home') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sign In</li>
    </ol>
</nav>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Sign In</h3>
        <p class="card-text">Admin only login currently</p>
        <?php if (count($formErrors) > 0): ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach ($formErrors as $attribute => $formError): ?>
                        <?= $formError ?> <br/>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" aria-describedby="emailHelp"
                           placeholder="Username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
</div>