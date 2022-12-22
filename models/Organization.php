<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property string $inn
 * @property string $name
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn'], 'required'],
            [['inn'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 200],
            [['inn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inn' => 'Inn',
            'name' => 'Name',
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrganizationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrganizationQuery(get_called_class());
    }
    
    public static function getInnList()
    {
        $models = self::find()
                ->select(["name", "inn"])
                ->orderBy('inn')                
                ->all();
        $list = [];
        $list[-1] = '';      
        foreach($models as $model) {
            $list[$model->inn] = "$model->name ($model->inn)";
        }
        return $list;
    }
}
