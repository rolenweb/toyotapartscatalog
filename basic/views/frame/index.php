<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FrameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Frames';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frame-index">

    <p class="text-right">
        <?= Html::a('Create Frame', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'model_id',
                'label' => 'Created',
                'content'=>function($data){
                    return (empty($data->modelCar) === false) ? $data->modelCar->title : 'No set';
                }
                
            ],
            'title',
            [
                'attribute'=>'created_at',
                'label' => 'Created',
                'content'=>function($data){
                    return date("d/m/Y H:i:s",$data->created_at);
                }
                
            ],
            [
                'attribute'=>'updated_at',
                'label' => 'Updated',
                'content'=>function($data){
                    return date("d/m/Y H:i:s",$data->updated_at);
                }
                
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
