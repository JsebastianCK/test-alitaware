<?php

namespace app\controllers;

use app\models\Servicio;
use app\models\ServicioAdquirido;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class ServicioController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionDetails($idServicio, $idGrupo)
    {
        $servicioAdquirido = ServicioAdquirido::find()
                    ->where(['idServicio' => $idServicio])
                    ->andWhere(['idGrupo' => $idGrupo])
                    ->one();

        return $this->renderAjax('_servicio_detail', [
            'servicioAdquirido' => $servicioAdquirido
        ]);
    }
}
