<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_post_category".
 *
 * @property int $id
 * @property int $post_id
 * @property int $category_id
 *
 * @property TblPost $post
 * @property TblCategory $category
 */
class PostCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_post_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'category_id'], 'required'],
            [['post_id', 'category_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblPost::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(TblPost::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TblCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return PostCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostCategoryQuery(get_called_class());
    }
}
