<?php

namespace app\controllers;

use app\models\Grupo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class GrupoController extends Controller
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

    /**
     * Simple verificacion para saber
     * si la base de datos ya esta disponible
     * para ser consultada
     * @param string $action La accion a ejecutarse
     * @return boolean Si la base de datos ya esta lista a ser consultada
     */
    public function beforeAction($action)
    {
        try {
            Yii::$app->db->createCommand("select localtimestamp from dual")->queryScalar();
        } catch(yii\db\Exception $e) {
            return $this->render('/site/db_error');
        }
        return true;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Grupo::find()
        ]);

        return $this->render('index', [
            'grupos' => $dataProvider
        ]);
    }

    /**
     * Muestra un Grupo
     */
    public function actionView($id)
    {
        $grupo = Grupo::findOne($id);
        $usuarios = new ArrayDataProvider([
            'allModels' => $grupo->usuarios,
            'sort' => [
                'attributes' => ['idUsuario', 'name', 'surname'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'grupo' => $grupo,
            'usuarios' => $usuarios,
        ]);
    }
}
