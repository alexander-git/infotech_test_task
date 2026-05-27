<?php

/* @var $this AuthorController */
/* @var $model Author */

$canManage = !Yii::app()->user->isGuest;

$this->pageTitle = 'Авторы';

$this->breadcrumbs = [
    'Авторы' => ['index'],
];

$menu = [];
if ($canManage) {
    $menu[]= ['label' => 'Создать', 'url' => ['create']];
}

$this->menu = $menu;
?>

<?php $this->widget('zii.widgets.grid.CGridView', [
    'id' => 'author-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'surname',
        'name',
        'patronymic',
        [
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => ['visible' => static fn() => $canManage],
                'delete' => ['visible' => static fn() => $canManage],
            ],
        ],
    ],
]); ?>