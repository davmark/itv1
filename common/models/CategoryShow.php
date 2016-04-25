<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories_shows".
 *
 * @property string $category_id
 * @property string $show_id
 *
 * @property Categories $category
 * @property Shows $show
 */
class CategoryShow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'categories_shows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'show_id'], 'required'],
            [['category_id', 'show_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'show_id' => 'Show ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShow()
    {
        return $this->hasOne(Show::className(), ['id' => 'show_id']);
    }

    public function add($cat_id, $show_id){

        if(!empty($cat_id)){
            foreach($cat_id as $id){
                $modelCatTV = new CategoryShow();
                $modelCatTV->category_id = $id;
                $modelCatTV->show_id = $show_id;
                $modelCatTV->save();
            }
        }
    }

    public function remove($show_id){
        CategoryShow::deleteAll(['show_id' => $show_id]);
    }
}
