<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Complectation */

$this->title = 'Update Complectation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="complectation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
