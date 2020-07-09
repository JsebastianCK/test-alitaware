<?php
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

$urlRedireccion = Url::to(['usuario/view', 'id' => '']);
$this->params['breadcrumbs'][] = 'Usuarios';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <?= Select2::widget([
                'name' => 'usuario',
                'data' => [],
                'options' => [
                    'placeholder' => 'Busqueda de usuarios',
                    'multiple' => false
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'minimumInputLength' => 1,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Esperando resultados...'; }"),
                    ],
                    'ajax' => [
                        'url' => Url::to('usuario/usuarioslist'),
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {q:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(usuario) { return usuario.text; }'),
                    'templateSelection' => new JsExpression('function (usuario) { return usuario.text; }'),
                ],
                'pluginEvents' => [
                    "select2:select" => "function({params}) { window.location.href = '{$urlRedireccion}'+params.data.id }",
                 ]
            ]); ?>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_usuarios_list', ['usuarios' => $usuarios]) ?>
        </div>
    </div>
</div>
<?php
$this->registerJs("
$('.select2-results__options').click('li', handleClick);

function handleClick(e) {
    alert('epa');
}
",
View::POS_READY)

?>