<?php

namespace denisok94\admin\controllers;

use Yii;
use yii\web\Controller;
use denisok94\admin\models\SignupForm;

class SignupController extends Controller
{
    /**
     * Форма регистрации.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        $this->layout = 'main-login';
        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
