<?php
/* @var $this BookController */
/* @var $model Book */

$canManage = !Yii::app()->user->isGuest;

$this->pageTitle = 'Книги';

$this->breadcrumbs = [
    'Книги' => ['index'],
];

$menu = [];
if ($canManage) {
    $menu[]= ['label' => 'Создать', 'url' => ['create']];
}

$this->menu= $menu;
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'book-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => [
        'id',
        'title',
        'year',
        'isbn',
        [
            'name' => 'main_page_photo_url',
            'type' => 'raw',
            'value' => static fn(Book $book) => CHtml::link($book->main_page_photo_url, $book->main_page_photo_url, ["target"=>"_blank"]),
            'filter' => false,
        ],
        [
            'name' => 'Авторы',
            'value' => static fn(Book $book) => $book->authorsString,
            'filter' => false,
        ],
        [
            'class' => 'CButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'update' => ['visible' => static fn() => $canManage],
                'delete' => ['visible' => static fn() => $canManage],
            ],
        ],
    ],
)); ?>


