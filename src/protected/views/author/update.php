<?php

/* @var $this AuthorController */
/* @var $model Author */

$canManage = !Yii::app()->user->isGuest;

$this->breadcrumbs = [
	'Авторы' => ['index'],
	$model->fullName => ['view', 'id' => $model->id],
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

<?php $this->renderPartial('_form', ['model' => $model]); ?>