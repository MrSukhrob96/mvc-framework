<?php
/**
 * @var $totalPages int
 * @var $currentPage int
 */
?>
<?php if($totalPages > 1):?>
<nav aria-label="page navigation">
    <ul class="pagination">
        <?php for ($page = 1; $page <= $totalPages;$page++):?>
        <?php $link = \App\Helpers\RequestHelper::setParam('page',$page);?>
        <li class="page-item <?=$page == $currentPage?"active":""?>"><a class="page-link" href="<?=$link?>"><?=$page?></a></li>
        <?php endfor;?>
    </ul>
</nav>
<?php endif;?>