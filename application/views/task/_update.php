<?php
/**
 * @var $formErrors array
 * @var $task \App\Models\Task
 */
?>
<?php if (count($formErrors) > 0): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($formErrors as $attribute => $formError): ?>
            <?= $formError ?>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<?php if (!is_a($task, \App\Models\Task::class)) {
    return;
} ?>

<form method="POST">
    <div class="form-group">
        <label for="email">Status</label>
        <select name="status" class="form-control">
            <option value="<?= \App\Models\Task::STATUS_INACTIVE ?>" <?= ($task->getStatus() == \App\Models\Task::STATUS_INACTIVE) ? "selected" : "" ?>>
                Inactive
            </option>
            <option value="<?= \App\Models\Task::STATUS_ACTIVE ?>" <?= ($task->getStatus() == \App\Models\Task::STATUS_ACTIVE) ? "selected" : "" ?>>
                Active
            </option>
            <option value="<?= \App\Models\Task::STATUS_COMPLETED ?>" <?= ($task->getStatus() == \App\Models\Task::STATUS_COMPLETED) ? "selected" : "" ?>>
                Completed
            </option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Task</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= $task->getDescription() ?></textarea>
    </div>
    <input type="submit" class="form-control btn-warning" value="Update"/>
</form>