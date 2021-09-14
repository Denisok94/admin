<?php

namespace denisok94\admin\controllers;

use Yii;
use yii\web\Controller;

class LogoutController extends Controller
{
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionIndex()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
