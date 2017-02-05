<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PartsGroups */

$this->title = 'Create Parts Groups';
$this->params['breadcrumbs'][] = ['label' => 'Parts Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
