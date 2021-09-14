<?php

use yii\helpers\Html;

// $this->title = 'User Profile';
$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('_leftprofile', [
            'Uid' => $Uid,
            'profile' => $profile,
            'Roles' => $Roles,
            'userAssigned' => $userAssigned,
        ]) ?>
    </div>
    <!-- /.col -->
    <div class="col-md-10">
        <div class="nav-tabs-custom">
            <?= $this->render('_custom', [
                'Uid' => $Uid,
                'user' => $user,
                'profile' => $profile,
            ]) ?>
        </div> <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->