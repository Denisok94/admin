<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Разрешения';
// $this->params['breadcrumbs'][] = ['label' => "Админка", 'url' => '/admin-bar'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <?= $this->render('_menu', [
                'active' => "rbac$type",
            ]) ?>
            <div class="tab-content">
                <div class="tab-pane active" id="activity">
                    <?php print_r($AuthItem); ?>
                </div>
            </div>
        </div>
    </div>
</div>