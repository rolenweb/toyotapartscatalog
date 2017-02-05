<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ModelCar */

$this->title = 'Create Model Car';
$this->params['breadcrumbs'][] = ['label' => 'Model Cars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-car-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
