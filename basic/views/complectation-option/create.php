<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComplectationOption */

$this->title = 'Create Complectation Option';
$this->params['breadcrumbs'][] = ['label' => 'Complectation Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectation-option-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
