<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<ul>
    <li>
        <?=CHtml::link('Книги', ['book/index'])?>
    </li>
    <li>
        <?=CHtml::link('Авторы', ['author/index'])?>
    </li>
    <li>
        <?=CHtml::link('Отчёты', ['report/years'])?>
    </li>
</ul>

