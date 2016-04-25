<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property string $id
 * @property string $url
 * @property string $path
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url',], 'required'],
            [['url', 'path'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'path' => 'Path',
        ];
    }
}
