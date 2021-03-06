<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComplectationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Complectations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complectation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Complectation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            
            [
                'attribute'=>'frame_id',
                'label' => 'Frame',
                'content'=>function($data){
                    return (empty($data->frame) === false) ? $data->frame->title : 'No set';
                }
                
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
