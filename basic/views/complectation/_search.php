<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComplectationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complectation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'frame_id') ?>

    <?= $form->field($model, 'complectation') ?>

    <?= $form->field($model, 'engine') ?>

    <?= $form->field($model, 'engine_title') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'body_title') ?>

    <?php // echo $form->field($model, 'grade') ?>

    <?php // echo $form->field($model, 'grade_title') ?>

    <?php // echo $form->field($model, 'transm') ?>

    <?php // echo $form->field($model, 'transm_title') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
