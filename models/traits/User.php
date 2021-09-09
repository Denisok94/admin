<?php

namespace denisok94\admin\models\traits;

use Yii;
use denisok94\admin\models\AuthItem;

trait User
{
    public $authKey;

    //	public function getRole()
    //		{
    //		return $this->hasMany(AuthItem::className(), ['name' => 'auth_item_name'])->viaTable('notice_type_2_role', ['notice_type_id' => 'id']);
    //		return $this->hasOne(\app\models\AuthItem::className(), ['user_id' => 'id'])->viaTable('auth_assignment', ['notice_type_id' => 'id']);
    //		}

    public function getRole()
    {
        return $this->hasOne(AuthItem::class, ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->fname = trim($this->fname);
            $this->mname = trim($this->mname);
            $this->lname = trim($this->lname);
            if ($insert) {
                $this->sign_up_dt = (new \DateTime())->format('Y-m-d H:i:s');
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'id' => $id,
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'access_token' => $token,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password passw ord to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    static public function createPassword($password)
    {
        return \Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
