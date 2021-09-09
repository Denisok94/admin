<?php

namespace denisok94\admin\models;

use Yii;

/**
 * This is the model class for table "variable".
 *
 * @property string $name
 * @property string|null $value
 */
class Variable extends \yii\db\ActiveRecord
{
    use \denisok94\admin\models\traits\Variable;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'variable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'safe'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'value' => 'Value',
        ];
    }
}
