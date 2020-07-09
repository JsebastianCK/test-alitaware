<?php
$this->params['breadcrumbs'][] = 'Grupos';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('_grupos_list', ['grupos' => $grupos]) ?>
        </div>
    </div>
</div>