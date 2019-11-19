<?php
/**
 * @var $task array
 */
$statusTitle = "Active";
$statusBadge = "warning";

if($task['status'] == \App\Models\Task::STATUS_INACTIVE){
    $statusTitle ="Inactive";
    $statusBadge = "secondary";
}

if($task['status']== \App\Models\Task::STATUS_COMPLETED){
    $statusTitle ="Completed";
    $statusBadge = "success";
}

?>

<div class="card col-md-12" style="margin-bottom: 10px;">
    <div class="card-body">
        <h5 class="card-title"><?= $task['username'] ?>
        <span class="badge badge-<?=$statusBadge?>"><?=$statusTitle?></span></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= $task['email'] ?></h6>
        <p class="card-text"><?= $task['description'] ?></p>
        <?php if(\Framework\Framework::$auth->getStatus() == "VALID"):?>
        <a href="<?=\Framework\Framework::$urlGenerator->generate('update',['id' => $task['id']])?>" class="btn btn-warning">Update</a>
        <?php endif;?>
        <?= $task['updated_at'] !== null ? '<span class="badge badge-secondary">Updated by admin</span>' : '' ?>
    </div>
</div>