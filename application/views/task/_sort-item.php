<?php
/**
 * @var $attribute string
 * @var $title string
 * @var $orderBy string
 * @var $link string
 * @var $sort array
 */
?>
<a href="<?=$link?>" style="font-size:14px; color:black;"><?=$title?>
    <i class="fa fa-angle-<?=array_key_exists($attribute,$sort) ? $sort[$attribute] == "DESC" ? "up": "down": "up"?>"></i>
</a>
