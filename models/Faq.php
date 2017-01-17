<?php

namespace usesgraphcrt\faq\models;

use Yii;
use usesgraphcrt\faq\Module;
use yii\db\ActiveRecord;
use yii\db\Query;

class Faq extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%faq_faq}}';
    }

    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['id','category_id','sort'], 'integer'],
            [['text'], 'string'],
            [['text'], 'trim'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Module::t('faq', 'ID'),
            'category_id' => Module::t('faq','Main Category'),
            'title' => Module::t('faq', 'Header'),
            'text' => Module::t('faq', 'Content'),
            'sort' => Module::t('faq','Sorting'),
        ];
    }

    public function getFaqCategory()
    {
        return $this->hasOne(FaqCategory::className(), ['id' => 'category_id']);
    }

    public function getFaqCategories()
    {
        return $this->hasMany(FaqCategory::className(), ['id' => 'category_id'])
            ->viaTable('{{%faq_faq_to_category}}', ['faq_id' => 'id']);
    }

    public function afterSave($insert,$changedAttributes) {
        parent::afterSave($insert,$changedAttributes);
        // $category = Category::findOne($this->category_id);

        if(!empty($this->category_id) && !empty($this->id)) {
            if(!(new \yii\db\Query())
                ->select('*')
                ->from('{{%faq_faq_to_category}}')
                ->where('faq_id ='.$this->id.' AND category_id = '.$this->category_id)
                ->all()) {
                yii::$app->db->createCommand()->insert('{{%faq_faq_to_category}}', [
                    'faq_id' => $this->id,
                    'category_id' => $this->category_id,
                ])->execute();
            }
        }

        return true;
    }
}
