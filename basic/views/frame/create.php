<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Frame */

$this->title = 'Create Frame';
$this->params['breadcrumbs'][] = ['label' => 'Frames', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frame-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
