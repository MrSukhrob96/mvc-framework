<?php
/**
 * @var $totalPages int
 * @var $currentPage int
 * @var $controller \Framework\AbstractController
 * @var $sortAttributes array
 * @var $sort array
 */
foreach ($sortAttributes as $sortAttribute => $data) {
    echo $controller->renderContent('_sort-item', ['attribute' => $sortAttribute,'title' => $data['title'],'link' => $data['link'],'sort' => $sort]);
}
?>
