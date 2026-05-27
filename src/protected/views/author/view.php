<?php

/* @var $this AuthorController */
/* @var $author Author */
/* @var $subscription Subscription */

$canManage = !Yii::app()->user->isGuest;
$canSubscribe = Yii::app()->user->isGuest;

$this->breadcrumbs = [
	'Авторы' => ['index'],
	$author->fullName,
];

$menu = [];
$menu[] = ['label' => 'Список', 'url' => ['index']];
if ($canManage) {
	$menu[] = ['label' => 'Создать', 'url' => ['create']];
	$menu[] = ['label' => 'Обновть', 'url' => ['update', 'id' => $author->id]];
	$menu[] = [
		'label' => 'Удалить',
		'url' => '#',
		'linkOptions' => [
			'submit' => ['delete', 'id' => $author->id],
			'confirm' => 'Вы уверены, что хотите удалить этого автора?'
		]
	];
}
$this->menu = $menu;
?>

<?php $this->widget('zii.widgets.CDetailView', [
	'data' => $author,
	'attributes' => [
		'id',
		'name',
		'surname',
		'patronymic',
		[
			'label' => 'Книги',
			'type' => 'raw',
			'value' => function() use($author) {
				$html = '';
				foreach ($author->books as $book) {
					$html .= CHtml::link(CHtml::encode($book->title), ['book/view', 'id' => $book->id]) . '<br>';
				}

				return $html;
			},
		],
	],
]); ?>

<?php if ($canSubscribe): ?>
	<br>
	<?php if (Yii::app()->user->hasFlash('success')): ?>
		<p class="success"><?=Yii::app()->user->getFlash('success'); ?></p>
	<?php endif; ?>

	<div class="form">
	<?php
		$form = $this->beginWidget('CActiveForm', [
			'enableAjaxValidation' => false,
		]);
	?>
		<div class="row">
			<?=$form->labelEx($subscription, 'phone'); ?>
			<?=$form->textField($subscription, 'phone', ['size' => 60, 'maxlength' => 255]); ?>
			<?=$form->error($subscription, 'phone'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Подписаться на новые книги автора'); ?>
		</div>
	<?php $this->endWidget(); ?>
	</div>
<?php endif; ?>
