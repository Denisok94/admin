<?php

namespace denisok94\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use app\models\users\models\Profile;
use denisok94\admin\models\User;

class ProfileController extends Controller
{
    /**
     * Profile action.
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->getId();
        Url::remember('', 'actions-redirect');
        $user    = User::findOne($id);
        $profile = $user->profile;

        if ($profile == null) {
            $profile = Yii::createObject(Profile::class);
            $profile->link('user', $user);
        }

        // $this->performAjaxValidation($profile);

        if ($profile->load(Yii::$app->request->post()) && $profile->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Profile details have been updated'));
            return $this->refresh();
        }
        $Roles = Yii::$app->authManager->getRolesByUser($id);
        $userAssigned = Yii::$app->authManager->getAssignments($id);
        // print_r($id);

        // return $this->redirect('/site/profile');
        return $this->render('index', [
            'Uid' => $id,
            'profile' => $profile,
            'Roles' => $Roles,
            'userAssigned' => $userAssigned,
            'user' => $user,
        ]);
    }
    
    /**
     * Updates an existing User model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $Uid = Yii::$app->user->getId();
        if ($Uid == $id) {
            Url::remember('', 'actions-redirect');
            $user = User::findOne($id);
            $user->scenario = 'update';

            if ($user->load(\Yii::$app->request->post()) && $user->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Account details have been updated');
                return $this->refresh();
            }
        }

        return $this->redirect('/users/profile');
    }

    
    /**
     * Updates an existing profile.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdateProfile($id)
    {
        $Uid = Yii::$app->user->getId();
        if ($Uid == $id) {
            Url::remember('', 'actions-redirect');
            $user    =  User::findOne($id);
            $profile = $user->profile;

            if ($profile == null) {
                $profile = Yii::createObject(Profile::class);
                $profile->link('user', $user);
            }

            if ($profile->load(\Yii::$app->request->post()) && $profile->save()) {
                Yii::$app->getSession()->setFlash('success', 'Profile details have been updated');
                return $this->refresh();
            }
        }
        return $this->redirect('/users/profile');
    }
}
