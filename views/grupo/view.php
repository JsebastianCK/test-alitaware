<?php

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => Url::to('/grupo')];
$this->params['breadcrumbs'][] = "Grupo {$grupo->name}"
?>
<div class="container">
    <?php if($grupo->servicios) { ?>
        <h3>Suscripciones</h3>
        <div class="row">
            <?php foreach($grupo->serviciosadquiridos as $servicioAdquirido){ ?>
                <div class="col-md-6">
                    <?= $this->render('/servicio/_servicio_preview', ['servicioAdquirido' => $servicioAdquirido]) ?>
                </div>
            <?php } ?>
        </div>
        <hr>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fas fa-users"></i>&nbsp;Usuarios del Grupo</div>
                <div class="panel-body" style="padding: 0px">
                    <?= $this->render('/usuario/_usuarios_list', ['usuarios' => $usuarios, 'summary' => '']) ?>
                </div>
            </div>
        </div>
    </div>
</div>