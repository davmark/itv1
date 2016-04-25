<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories_tvs".
 *
 * @property string $category_id
 * @property string $tv_id
 *
 * @property Categories $category
 * @property Tvs $tv
 */
class CategoriesTvs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories_tvs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'tv_id'], 'required'],
            [['category_id', 'tv_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'tv_id' => 'Tv ID',
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
    public function getTv()
    {
        return $this->hasOne(Tv::className(), ['id' => 'tv_id']);
    }

    public function add($tv_id, $cat_id){

        if(!empty($tv_id)){
            foreach($tv_id as $id){
                if(!empty($tv_id)) {
                    $modelCatTV = new CategoriesTvs();
                    $modelCatTV->category_id = $cat_id;
                    $modelCatTV->tv_id = $id;
                    $modelCatTV->save();
                }
            }
        }
    }

    public function remove($cat_id){
        CategoriesTvs::deleteAll(['category_id' => $cat_id]);
    }

}
