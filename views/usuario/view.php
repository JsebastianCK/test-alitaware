<?php

use yii\helpers\Url;

$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => Url::to('/usuario')];
$this->params['breadcrumbs'][] = $usuario->nombreCompleto;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $usuario->nombreCompleto ?></h2>
        </div>
        <?php if($ultimaUbicacion) { ?>
            <div class="col-md-12">
                <span><b>Departamento:</b>&nbsp;<?= $ubicacion['ubicacion']['departamento']['nombre'] ?></span>
                <br>
                <span><b>Municipio:</b>&nbsp;<?= $ubicacion['ubicacion']['municipio']['nombre'] ?></span>
                <br>
                <span><b>Provincia:</b>&nbsp;<?= $ubicacion['ubicacion']['provincia']['nombre'] ?></span>
                <span class="pull-right">Ultima Úbicacion Registrada: <?= $ultimaUbicacion->date ?></span>
            </div>
            <div class="col-md-12">
                <?php
                    $center = new dosamigos\leaflet\types\LatLng(['lat' => $ultimaUbicacion->latitude, 'lng' => $ultimaUbicacion->longitude]);
                    $marker = new \dosamigos\leaflet\layers\Marker(['latLng' => $center, 'popupContent' => $usuario->nombreCompleto]);
    
                    $tileLayer = new \dosamigos\leaflet\layers\TileLayer([
                        'urlTemplate' => 'https://a.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    ]);
    
                    $leaflet = new \dosamigos\leaflet\LeafLet([
                        'center' => $center, // set the center
                    ]);
    
                    $leaflet->addLayer($marker)      // add the marker
                            ->addLayer($tileLayer);  // add the tile layer
    
                    echo \dosamigos\leaflet\widgets\Map::widget(['leafLet' => $leaflet]);
                ?>
            </div>
        <?php } ?>
    </div>
</div>