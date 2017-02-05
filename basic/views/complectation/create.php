<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Complectation */

$this->title = 'Create Complectation';
$this->params['breadcrumbs'][] = ['label' => 'Complectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectation-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
