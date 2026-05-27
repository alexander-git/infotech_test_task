<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
/* @var $allAuthors array */

?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', [
        'id' => 'book-form',
        'enableAjaxValidation' => false,
    ]);
    ?>

    <?=$form->errorSummary($model); ?>

    <div class="row">
        <?=$form->labelEx($model, 'title'); ?>
        <?=$form->textField($model, 'title', ['size' => 60, 'maxlength' => 255]); ?>
        <?=$form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'year'); ?>
        <?=$form->textField($model, 'year'); ?>
        <?=$form->error($model, 'year'); ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'isbn'); ?>
        <?=$form->textField($model, 'isbn', ['size' => 20, 'maxlength' => 20]); ?>
        <?=$form->error($model, 'isbn'); ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'description'); ?>
        <?=$form->textArea($model, 'description', ['rows' => 6, 'cols' => 50]); ?>
        <?=$form->error($model, 'description'); ?>
    </div>

    <div class="row">
        <?= $form->labelEx($model, 'main_page_photo_url'); ?>
        <?= $form->textField($model, 'main_page_photo_url', ['size' => 60, 'maxlength' => 2048]); ?>
        <?= $form->error($model, 'main_page_photo_url'); ?>
    </div>

    <div class="row">
        <?=$form->labelEx($model, 'authorIds'); ?>
        <?= CHtml::activeListBox(
            $model,
            'authorIds',
            CHtml::listData($allAuthors, 'id', 'fullName'),
            [
                'multiple' => 'multiple',
                'size' => 10,
            ]
        ); ?>

        <?=$form->error($model, 'authorIds'); ?>
    </div>

    <div class="row buttons">
        <?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Обновить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div>