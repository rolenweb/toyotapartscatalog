<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComplectationOption */

$this->title = 'Update Complectation Option: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Complectation Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="complectation-option-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
