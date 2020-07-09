<?php
use yii\helpers\Url;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => '<h2>Datos de la Suscripcion</h2>',
    'id' => 'modal-service'
]);
Modal::end();
?>
<style>
  .link-service {
    text-decoration: none;
  }
  .link-service:hover {
    text-decoration: none;
  }
  .preview-service {
    color: white;
    background-color: #17a2b8 !important;
    box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
    transition: 0.15s ease-out;
  }
  .preview-service:hover { 
    cursor: pointer;
    box-shadow: 0 0 1px rgba(0,0,0,.125),1px 3px 6px rgba(0,0,0,.2);

  }
</style>
<a href="<?= Url::to(['servicio/details', 'idServicio' => $servicioAdquirido->idServicio, 'idGrupo' => $servicioAdquirido->idGrupo]) ?>" class="link-service">
  <div class="panel panel-default preview-service">
    <div class="panel-body">
      <i class="fas fa-tag detail pull-right"></i>
      <b><?= $servicioAdquirido->servicio->name ?></b>
      <br>
      <span><i class="fas fa-user"></i>&nbsp;<?= $servicioAdquirido->usuario->nombreCompleto ?></span>
      <span class="pull-right"><?= $servicioAdquirido->date ?></span>
    </div>
  </div>
</a>
<?php
$this->registerJs("
  $('.link-service').click(handleClickService);

  function handleClickService(e){
    e.preventDefault();
    $('#modal-service').find('.modal-body').html('');
    $('#modal-service').modal('show').find('.modal-body').load($(this).attr('href'));
  }
")
?>