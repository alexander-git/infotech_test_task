<?php

/* @var $this AuthorController */
/* @var $model Author */

$this->breadcrumbs = [
    'Авторы' => ['index'],
    'Создать',
];

$this->menu = [
    ['label' => 'Список', 'url' => ['index']],
];

?>

<?php $this->renderPartial('_form', ['model' => $model]); ?>

