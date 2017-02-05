<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ComplectationOption */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Complectation Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectation-option-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
            [
                'label' => 'Complectation',
                'value' => (empty($model->complectation) === false) ? $model->complectation->complectation : 'No set',
            ],
            'title',
            'description',
            
            [
                'label' => 'Created',
                'value' => date("d/m/Y",$model->created_at),
            ],
            [
                'label' => 'Updated',
                'value' => date("d/m/Y",$model->updated_at),
            ],
        ],
    ]) ?>

</div>
