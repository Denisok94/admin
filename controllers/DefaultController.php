<?php

namespace denisok94\admin\controllers;

use Yii;
use yii\web\Controller;
use denisok94\admin\models\AuthItem;
use denisok94\admin\models\User;
/**
 * DefaultController
 */
class DefaultController extends Controller
{

    /**
     * Action index
     */
    public function actionIndex($page = 'README.md')
    {
        if (preg_match('/^docs\/images\/image\d+\.png$/', $page)) {
            $file = Yii::getAlias("@denisok94/admin/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
        return $this->render('index', ['page' => $page]);
    }

    public function actionUsers()
    {
        $User = User::find()->asArray()->all();
        return $this->render('user', [
            'User' => $User,
        ]);
    }

    public function actionRbac($type = NULL)
    {
        $type = ($type) ? ($type) : (1);
        $AuthItem = AuthItem::find()->where(['type' => $type])->asArray()->all();

        return $this->render('rbac', [
            'AuthItem' => $AuthItem,
            'type' => $type,
        ]);
    }
}
