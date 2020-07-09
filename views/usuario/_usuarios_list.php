<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= GridView::widget([
    'dataProvider' => $usuarios,
    'pager' => ['options' => ['class' => 'pagination pull-right']],
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    'summary' => (isset($summary)) ? $summary : 'Showing <b>{begin}</b>-<b>{end}</b> of <b>{totalCount}</b> users',
    'columns' => [
        [
            'attribute' => 'idUsuario',
            'format' => 'raw',
            'value' => function($usuario) {
                return Html::a($usuario->idUsuario, Url::to(['/usuario/view', 'id' => $usuario->idUsuario]));
            }
        ],
        'name',
        'surname',
    ],
]); ?>