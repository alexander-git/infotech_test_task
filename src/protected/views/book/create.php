<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $allAuthors array */

$this->breadcrumbs = [
    'Книги' => ['index'],
    'Создать',
];

$this->menu = [
    ['label' => 'Книги', 'url' => ['index']],
];
?>

<?php $this->renderPartial('_form', ['model' => $model, 'allAuthors' => $allAuthors]); ?>