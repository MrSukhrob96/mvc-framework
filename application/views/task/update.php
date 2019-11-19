<?php
/**
 * @var $tasks \App\Models\Task[]
 * @var $controller \Framework\AbstractController
 * @var $totalPages int
 * @var $currentPage int
 * @var $sortAttributes array
 * @var $sort array
 * @var $formErrors array
 * @var $task \App\Models\Task
 */

?>
<h1>Tasks             <a class="btn btn-success" href="<?=\Framework\Framework::$urlGenerator->generate('home')?>">Create</a>
</h1>

<div class="row">
    <div class="col-md-6">
        <h3>Update</h3>
        <?= $controller->renderContent('_update',['formErrors' => $formErrors,'task' => $task]) ?>

    </div>
    <div class="col-md-6">
        <?php if(count($tasks) > 0):?>
        <h3>Page <?= $currentPage ?> of <?= $totalPages ?></h3>
        <?= $controller->renderContent('_sort', ['sortAttributes' => $sortAttributes, 'sort' => $sort]) ?>

        <?php foreach ($tasks as $task): ?>
            <?= $controller->renderContent('_task-view', [
                'task' => $task
            ]) ?>
        <?php endforeach; ?>

        <?= $controller->renderContent('_pagination', [
            'totalPages' => $totalPages,
            'currentPage' => $currentPage
        ]) ?>
        <?php else:?>
            <h2>Task not founded</h2>
        <?php endif; ?>
    </div>
</div>