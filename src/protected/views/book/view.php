<?php
/* @var $this BookController */
/* @var $model Book */

$canManage = !Yii::app()->user->isGuest;

$this->breadcrumbs = [
    'Книги' => ['index'],
    $model->title,
];

$menu = [];
$menu[] = ['label' => 'Список', 'url' => ['index']];
if ($canManage) {
    $menu[] = ['label' => 'Создать', 'url' => ['create']];
    $menu[] = ['label' => 'Обновть', 'url' => ['update', 'id' => $model->id]];
    $menu[] = [
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => [
            'submit' => ['delete', 'id' => $model->id],
            'confirm' => 'Вы уверены, что хотите удалить эту книгу?'
        ]
    ];
}
$this->menu = $menu;

?>

<?php $this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        'id',
        'title',
        'year',
        'isbn',
        'description',
        'main_page_photo_url',
        [
            'label' => 'Авторы',
            'value' => $model->authorsString,
        ],
    ],
]); ?>