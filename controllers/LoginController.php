<?php

namespace denisok94\admin\controllers;

use Yii;
use yii\web\Controller;
use denisok94\admin\models\LoginForm;

class LoginController extends Controller
{
    /**
     * Login action.
     * /users/login
     * @return Response|string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'main-login';
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
