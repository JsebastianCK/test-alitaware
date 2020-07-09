<?php

namespace app\controllers;

use app\components\WebService;
use app\models\Usuario;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class UsuarioController extends Controller
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
        $usuario = new Usuario();
        $dataProvider = new ActiveDataProvider([
            'query' => Usuario::find()
        ]);

        return $this->render('index', [
            'usuarios' => $dataProvider,
            'usuario' => $usuario
        ]);
    }

    public function actionView($id)
    {
        $usuario = Usuario::findOne($id);
        $ultimaUbicacion = $usuario->ultimaubicacion;
        $ubicacion = [];

        if($ultimaUbicacion) {
            $ubicacion = WebService::getUbicacion($ultimaUbicacion->latitude, $ultimaUbicacion->longitude);
        }
        return $this->render('view', [
            'usuario' => $usuario,
            'ultimaUbicacion' => $ultimaUbicacion,
            'ubicacion' => $ubicacion
        ]);
    }

    /**
     * Devuelve los usuarios cuyo nombre y apellido
     * sean parecidos a $q
     * @param string $q Filtro para la busqueda de usuarios
     */
    public function actionUsuarioslist($q)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '' , 'text' => '']];
        if (!is_null($q)) {
            $usuarios = Usuario::find()
                ->select([
                    "idUsuario AS id",
                    "CONCAT(surname, ', ', name) AS text"
                ])
                ->where(["LIKE", "CONCAT(surname, ', ', name)", $q])
                ->limit(5)
                ->asArray();
            $usuarios = $usuarios->createCommand()->queryAll();
            $out['results'] = array_values($usuarios);
        }

        return $out;
    }
}
