<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>S-D</b>enis</a>
    </div> <!-- /.login-logo -->
    <div class="login-box-body">
        <h2><?= Html::encode($this->title) ?></h2>

        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

        <?= $form
            ->field($model, 'username', [
                'template' => '{label}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-user form-control-feedback"></span></div>{hint}{error}'
            ])
            ->label('Логин')
            ->textInput(['autofocus' => true]) ?>

        <?= $form
            ->field($model, 'email', [
                'template' => '{label}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-envelope form-control-feedback"></span></div>{hint}{error}'
            ])
            ->label('Почта') ?>

        <?= $form
            ->field($model, 'password', [
                'template' => '{label}<div class="form-group has-feedback">{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span></div>{hint}{error}'
            ])
            ->label('Пароль')
            ->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div> <!-- /.login-box-body -->
</div><!-- /.login-box -