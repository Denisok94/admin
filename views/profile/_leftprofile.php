<?php

use yii\helpers\Html;

?>

<!-- Profile Image -->
<div class="box box-primary">
    <div class="box-body box-profile">
        <?= Html::img(GetUsers::img(), ['class' => 'profile-user-img img-responsive img-circle'], ['alt' => 'User profile picture']) ?>
        <h3 class="profile-username text-center"> <?= $this->title ?> </h3>
        <!-- <p class="text-muted text-center"> Блабла </p> -->
        <?php /* = Html::img($profile->getAvatarUrl(230), [
                    'class' => 'profile-user-img img-responsive img-circle',
                    // 'class' => 'img-rounded img-responsive',
                    'alt' => $profile->user->username,
                ]) */ ?>
    </div> <!-- /.box-body -->
</div> <!-- Profile /.box -->

<!-- About Me Box -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Права</h3>
    </div> <!-- /.box-header -->
    <div class="box-body">
        <strong>Должность</strong>
        <p>
            <?php
            if ($Roles) {

                $b = array();
                foreach ($Roles as $key => $value) {
                    $b[] = $key;
                    switch ($key) {
                        case "Админ":
                            echo '<span class="label label-danger">' . $key . '</span> ';
                            break;
                        case "Аналитик":
                            echo '<span class="label label-info">' . $key . '</span> ';
                            break;
                        case "Модератор":
                            echo '<span class="label label-warning">' . $key . '</span> ';
                            break;
                        case "ЦОДД":
                            echo '<span class="label label-success">' . $key . '</span> ';
                            break;
                        default:
                            echo '<span class="label label-primary">' . $key . '</span> ';
                    }
                }
            }
            ?>
        </p>

        <strong>Разрешения</strong>
        <p>
            <?php
            if ($userAssigned) {
                foreach ($userAssigned as $userAssign) {
                    $roleName = $userAssign->roleName; //createdAt
                    $Assigned[] = $roleName; //createdAt
                    if (!in_array($roleName, $b)) {
                        echo $roleName . '<br>'; //createdAt
                    }
                }
            }
            ?>
        </p>
    </div> <!-- /.box-body -->
</div> <!-- About Me /.box -->