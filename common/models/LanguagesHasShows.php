<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages_has_shows".
 *
 * @property integer $lang_id
 * @property integer $show_id
 * @property string $title
 * @property string $description
 *
 * @property Language $lang
 * @property Show $show
 */
class LanguagesHasShows extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages_has_shows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['lang_id', 'show_id', 'title'], 'required'],
            [['lang_id', 'show_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['show_id'], 'exist', 'skipOnError' => true, 'targetClass' => Show::className(), 'targetAttribute' => ['show_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'show_id' => 'Show ID',
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
    public function getShow()
    {
        return $this->hasOne(Show::className(), ['id' => 'show_id']);
    }

    /**
     * @param $post
     * @param $lang
     * @param $model_id
     */
    public function add($post, $lang, $model_id){

        foreach($lang as $item){
            $model = new LanguagesHasShows();
            $model->lang_id = $item->id;
            $model->show_id = $model_id;
            $model->title = $post['lang']['title_'.$item->id];
            $model->description = $post['lang']['description_'.$item->id];
            $model->save();
        }
    }

    /**
     * @param $model_id
     */
    public function remove($model_id){
        LanguagesHasShows::deleteAll(['show_id' => $model_id]);
    }
}
