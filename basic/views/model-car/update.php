<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ModelCar */

$this->title = 'Update Model Car: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Model Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="model-car-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
