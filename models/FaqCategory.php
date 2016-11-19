<?php

namespace usesgraphcrt\faq\models;

use Yii;

class FaqCategory extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'faq_category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
        ];
    }

    public function getFaq()
    {
        return $this->hasMany(Faq::className(), ['faq_id' => 'id'])
            ->viaTable('{{%faq_faq_to_category}}', ['category_id' => 'id']);
    }

    public static function buildTextTree($id = null, $level = 1, $ban = [])
    {
        $return = [];

        $prefix = str_repeat('--', $level);
        $level++;

        if(empty($id)) {
            $categories = FaqCategory::find()->where('parent_id = 0 OR parent_id is null')->asArray()->all();
        } else {
            $categories = FaqCategory::find()->where(['parent_id' => $id])->asArray()->all();
        }

        foreach($categories as $category) {
            if(!in_array($category['id'], $ban)) {
                $return[$category['id']] = "$prefix {$category['name']}";
                $return = $return + self::buildTextTree($category['id'], $level, $ban);
            }
        }

        return $return;
    }

    public function getChilds()
    {
        return $this->hasMany(FaqCategory::className(), ['parent_id' => 'id']);
    }

    public function getParent()
    {
        return $this->hasOne(FaqCategory::className(), ['id' => 'parent_id']);
    }
} 