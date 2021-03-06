<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Complectation */

$this->title = $model->complectation;
$this->params['breadcrumbs'][] = ['label' => 'Complectations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectation-view">

    
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'Frame',
                'value' => (empty($model->frame) === false) ? $model->frame->title : 'No set',
            ],
            'complectation',
            'engine',
            'engine_title',
            'period',
            'body',
            'body_title',
            'grade',
            'grade_title',
            'transm',
            'transm_title',
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
