<?php
namespace pistol88\review\models;

use yii;

class Review extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%review}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'item_id', 'vote'], 'integer'],
            [['item_id', 'name'], 'required'],
            [['text', 'active', 'pluses', 'minuses'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        return [
            'customer' => ['item_id', 'vote', 'text', 'pluses', 'minuses', 'name'],
            'admin' => array_keys($this->attributeLabels()),
			'default' => array_keys($this->attributeLabels()),
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'name' => 'Имя',
            'text' => 'Текст',
            'date' => 'Дата',
            'active' => 'Активность',
            'item_id' => 'Продукт',
            'pluses' => 'Плюсы',
            'minuses' => 'Минусы',
            'vote' => 'Оценка',
        ];
    }
}