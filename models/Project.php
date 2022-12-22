<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $name
 * @property string $note
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['note'], 'string', 'max' => 2000],
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
            'note' => 'Note',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
    
    public static function getProjectList()
    {
        $projects = self::find()
                ->select(["name"])
                ->orderBy('name')                                
                ->column();
        $list = [];         
        $list[-1] = '';
        foreach($projects as $project) {
            $list[$project] = $project;
        }        
        return $list;
    }
}
