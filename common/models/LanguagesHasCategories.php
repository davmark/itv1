<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages_has_categories".
 *
 * @property integer $lang_id
 * @property integer $category_id
 * @property string $title
 * @property string $description
 *
 * @property Language $lang
 * @property Category $category
 */
class LanguagesHasCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages_has_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['lang_id', 'category_id', 'title'], 'required'],
            [['lang_id', 'category_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Language::className(), ['id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @param $post
     * @param $lang
     * @param $model_id
     */
    public function add($post, $lang, $model_id){
        foreach($lang as $item){
            $model = new LanguagesHasCategories();
            $model->lang_id = $item->id;
            $model->category_id = $model_id;
            $model->title = $post['lang']['title_'.$item->id];
            $model->description = $post['lang']['description_'.$item->id];
            $model->save();
        }
    }

    /**
     * @param $model_id
     */
    public function remove($model_id){
        LanguagesHasCategories::deleteAll(['category_id' => $model_id]);
    }
}
