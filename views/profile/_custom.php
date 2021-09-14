<?php

use \denisok94\helper\YiiHelper as H;
use yii\helpers\Html;
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#asdasd" data-toggle="tab">Info</a></li>
    <?php if ($Uid == $user->id) { ?>

        <li><a href="#settings" data-toggle="tab">Аккаунт</a></li>
        <li><a href="#profile" data-toggle="tab">Профиль</a></li>

    <?php } ?>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="asdasd">
        <ul style="padding: 0; list-style: none outside none;">
            <?php if (!empty($profile->location)) : ?>
                <li>
                    <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location) ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($profile->website)) : ?>
                <li>
                    <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($profile->public_email)) : ?>
                <li>
                    <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                </li>
            <?php endif; ?>
            <li>
                <i class="glyphicon glyphicon-time text-muted"></i> <?php
                echo H::stampToDt($user->created_at);
                //Yii::t('user', 'Joined on {0, date}', $user->created_at) 
                ?>
            </li>
        </ul>
        <?php if (!empty($profile->bio)) : ?>
            <p><?= Html::encode($profile->bio) ?></p>
        <?php endif; ?>
    </div> <!-- /.tab-pane -->

    <?php if ($Uid == $user->id) { ?>
        <div class="tab-pane" id="settings">

            <?=/*  $this->render('_settings', [
                'Uid' => $Uid,
                'user' => $user,
            ])  */ '' ?>

        </div> <!-- /.tab-pane -->
        <div class="tab-pane" id="profile">

            <?= $this->render('_profile', [
                'Uid' => $Uid,
                'user' => $user,
                'profile' => $profile,
            ]) ?>

        </div> <!-- /.tab-pane -->
    <?php } ?>
</div> <!-- /.tab-content -->