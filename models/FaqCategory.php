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
            [['id', 'parent_id','sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'sort' => 'Сортировка',
        ];
    }

    public function getFaq()
    {
        return $this->hasMany(Faq::className(),['category_id' => 'id']);
    }

    public static function buldTree($parent_id = null)
    {
        $return = [];

        if(empty($parent_id)) {
            $categories = FaqCategory::find()->where('parent_id = 0 OR parent_id is null')->orderBy(["name"=>SORT_ASC])->asArray()->all();
        } else {
            $categories = FaqCategory::find()->where(['parent_id' => $parent_id])->orderBy(["name"=>SORT_ASC])->asArray()->all();
        }

        foreach($categories as $level1) {
            $return[$level1['id']] = $level1;
            $return[$level1['id']]['childs'] = self::buldTree($level1['id']);
        }

        return $return;
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