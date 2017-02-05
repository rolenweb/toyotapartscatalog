<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Complectation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complectation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'frame_id')->textInput() ?>

    <?= $form->field($model, 'complectation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'period')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grade_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transm')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transm_title')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
