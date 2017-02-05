<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PartsGroups */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Parts Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parts-groups-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            
            [
                'label' => 'Complectation',
                'value' => (empty($model->complectation) === false) ? $model->complectation->complectation : 'No set',
            ],
            
            [
                'label' => 'Created',
                'value' => $model->typeName(),
            ],
            'title',
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
    <p class="text-right">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
