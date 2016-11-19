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
            [['faq_title', 'faq_text'], 'required'],
            [['faq_id','faq_category_id'], 'integer'],
            [['faq_text'], 'string'],
            [['faq_text'], 'trim'],
            [['faq_title'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'faq_id' => Module::t('faq', 'ID'),
            'faq_category_id' => Module::t('faq','Main Category'),
            'faq_title' => Module::t('faq', 'Header'),
            'faq_text' => Module::t('faq', 'Content'),
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

        if(!empty($this->faq_category_id) && !empty($this->faq_id)) {
            if(!(new \yii\db\Query())
                ->select('*')
                ->from('{{%faq_faq_to_category}}')
                ->where('faq_id ='.$this->faq_id.' AND category_id = '.$this->faq_category_id)
                ->all()) {
                yii::$app->db->createCommand()->insert('{{%faq_faq_to_category}}', [
                    'faq_id' => $this->faq_id,
                    'category_id' => $this->faq_category_id,
                ])->execute();
            }
        }

        return true;
    }
}
