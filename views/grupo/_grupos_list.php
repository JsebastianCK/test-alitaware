<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= GridView::widget([
    'dataProvider' => $grupos,
    'id' => 'groups-table',
    'pager' => ['options' => ['class' => 'pagination pull-right']],
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    'columns' => [
        [
            'attribute' => 'idGrupo',
            'format' => 'raw',
            'headerOptions' => ['style'   => 'width: 10%'],
            'value' => function($grupo) {
                return Html::a($grupo->idGrupo, Url::to(['grupo/view', 'id' => $grupo->idGrupo]));
            }
        ],
        'name',
        [
            'label' => 'Cant. Integrantes',
            'headerOptions' => ['style'   => 'width: 45%'],
            'value' => function($grupo) {
                return $grupo->cantidadusuarios;
            }
        ],
    ],
]); ?>