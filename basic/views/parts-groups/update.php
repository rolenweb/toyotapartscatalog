<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartsGroups */

$this->title = 'Update Parts Groups: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Parts Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="parts-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
