<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Link;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ParserController extends \yii\web\Controller
{

	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
    	$parsedLinks = Link::find()
    			->where(
    				[
    					'status' => Link::STATUS_PARSED
    				]
    			)->count();

    	$allLinks = Link::find()->count();

    	$process = (empty($allLinks) === false) ? round(($parsedLinks/$allLinks)*100) : 0;
    	

        return $this->render('index',
        	[
        		'allLinks' => $allLinks,
        		'process' => $process,
        	]
        );
    }

}
