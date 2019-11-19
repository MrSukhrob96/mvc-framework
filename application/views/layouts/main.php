<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="<?= \Framework\Framework::$urlGenerator->generate('home') ?>">Task Manager
            (mini)</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?= \Framework\Framework::$urlGenerator->generate('home') ?>">Home
                    </a>
                </li>
                <?php if (\Framework\Framework::$auth->getStatus() !== "VALID"): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= \Framework\Framework::$urlGenerator->generate('login') ?>">Login</a>
                    </li>
                <?php endif; ?>

                <?php if (\Framework\Framework::$auth->getStatus() == "VALID"): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= \Framework\Framework::$urlGenerator->generate('logout') ?>">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Page Content -->
<div class="container" style="width: 800px;">
    <div class="row">
        <div class="col-lg-12">
            <?= $content ?>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>