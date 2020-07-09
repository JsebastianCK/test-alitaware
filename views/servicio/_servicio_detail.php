<?php
    $servicio = $servicioAdquirido->servicio;
    $grupo = $servicioAdquirido->grupo;
    $usuario = $servicioAdquirido->usuario;
    $descuento = $servicioAdquirido->obtenerPrecioFinal() != $servicio->price;
?>
<style>
    .flex {
        display: flex;
        flex-direction: column;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <p><b>Servicio: </b><?= $servicio->name ?></p>
            <p><b>Grupo: </b><?= $grupo->name ?></p>
            <p><b>Usuario: </b><?= $usuario->nombrecompleto ?></p>
            <p><b>Fecha Suscripcion: </b><?= $servicioAdquirido->date ?></p>
        </div>
    </div>
    <hr>
    <?php if($descuento) { ?>
        <span class="pull-right flex">
            <del>$<?= $servicio->price ?></del>
            $<?= $servicioAdquirido->obtenerPrecioFinal() ?>
        </span>
        <br>
        <p><b>Valor de la Suscripcion </b></p>
    <?php } ?>
</div>