<?php

/* @var $this AuthorController */
/* @var $model Author */
/* @var $form CActiveForm */

?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', [
        'enableAjaxValidation' => false,
    ]); ?>

    <?=$form->errorSummary($model) ?>

    <div class="row">
        <?=$form->labelEx($model, 'name') ?>
        <?=$form->textField($model, 'name', ['size' => 60, 'maxlength' => 255]) ?>
        <?=$form->error($model, 'name') ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'surname') ?>
        <?=$form->textField($model, 'surname', ['size' => 60, 'maxlength' => 255]) ?>
        <?=$form->error($model, 'surname') ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'patronymic') ?>
        <?=$form->textField($model, 'patronymic', ['size' => 60, 'maxlength' => 255]) ?>
        <?=$form->error($model, 'patronymic') ?>
    </div>

    <div class="row buttons">
        <?=CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить') ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->