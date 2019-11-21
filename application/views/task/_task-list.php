<?php
/**
 * @var $tasks \App\Models\Task[]
 * @var $controller \Framework\AbstractController
 * @var $totalPages int
 * @var $currentPage int
 * @var $sortAttributes array
 * @var $sort array
 */
?>
<?php if (count($tasks) > 0): ?>
    <div class="card">
        <div class="card-header">
            <h5>Page <?= $currentPage ?> of <?= $totalPages ?></h5>
            <?= $controller->renderContent('_sort', ['sortAttributes' => $sortAttributes, 'sort' => $sort]) ?>

        </div>
        <div class="card-body">
            <?php foreach ($tasks as $task): ?>
                <?= $controller->renderContent('_task-view', [
                    'task' => $task
                ]) ?>
            <?php endforeach; ?>
            <div class="col-md-12 container">
                <?= $controller->renderContent('_pagination', [
                    'totalPages' => $totalPages,
                    'currentPage' => $currentPage
                ]) ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-primary" role="alert">
        Tasks not found
    </div>
<?php endif; ?>

