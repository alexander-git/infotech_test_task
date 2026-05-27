<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $allAuthors array */

$canManage = !Yii::app()->user->isGuest;

$this->breadcrumbs = [
    'Книги' => ['index'],
    $model->title => ['view', 'id' => $model->id],
    'Обновить'
];

$menu = [];
$menu[] = ['label' => 'Список', 'url' => ['index']];
if ($canManage) {
    $menu[] = ['label' => 'Создать', 'url' => ['create']];
}

$menu[] = ['label' => 'Просмотр', 'url' => ['view', 'id' => $model->id]];
$this->menu = $menu;

?>

<?php $this->renderPartial('_form', ['model' => $model, 'allAuthors' => $allAuthors]); ?>