<?php
/**
 * @var $tasks \App\Models\Task[]
 * @var $controller \Framework\AbstractController
 * @var $totalPages int
 * @var $currentPage int
 * @var $sortAttributes array
 * @var $sort array
 * @var $formAlert array
 * @var $task \App\Models\Task
 */

?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= \Framework\Framework::$urlGenerator->generate('home') ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update</li>
    </ol>
</nav>

<h1>Tasks</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update</h5>
                <?= $controller->renderContent('_update', ['formAlert' => $formAlert, 'task' => $task]) ?>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <?= $controller->renderContent('_task-list', [
            'tasks' => $tasks,
            'totalPages' => $totalPages,
            'currentPage' => $currentPage,
            'sortAttributes' => $sortAttributes,
            'sort' => $sort
        ]) ?>
    </div>
</div>