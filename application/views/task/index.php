<?php
/**
 * @var $tasks \App\Models\Task[]
 * @var $controller \Framework\AbstractController
 * @var $totalPages int
 * @var $currentPage int
 * @var $sortAttributes array
 * @var $sort array
 * @var $formAlert array
 */

?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
    </ol>
</nav>

<h1>Tasks</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create</h5>
                <?= $controller->renderContent('_create', ['formAlert' => $formAlert]) ?>
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