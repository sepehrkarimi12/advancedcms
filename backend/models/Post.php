<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $author_id
 *
 * @property TblComment[] $tblComments
 * @property TblUser $author
 * @property TblPostCategory[] $tblPostCategories
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'author_id' => Yii::t('app', 'Author ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblComments()
    {
        return $this->hasMany(TblComment::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPostCategories()
    {
        return $this->hasMany(PostCategory::className(), ['post_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public function getAllCategories()
    {
        $all= \backend\models\Category::find()->all();
        return \yii\helpers\ArrayHelper::map($all,'id','title');
    }

    public function getSelectedCategory()
    {
        $selected=[];
        if($this->isNewRecord != 1)
        {
            // $selected=\yii\helpers\ArrayHelper::getColumn(
            //     \backend\models\PostCategory::findAll(['post_id'=>$this->id]),
            //     function($element){
            //         return $element['category_id'];
            //     }
            // );
            $arr=\backend\models\PostCategory::findAll(['post_id'=>$this->id]);
            $selected=\yii\helpers\ArrayHelper::getColumn($arr,'category_id');
        }

        return $selected;
    }

    public function afterSave($insert,$changedAttributes)
    {
        $selected=Yii::$app->request->post('PostCategory');
        // print_r($selected);
        // exit();
        \backend\models\PostCategory::deleteAll(['post_id'=>$this->id]);
        $insert_data=[];
        if($selected!=null){
            foreach ($selected as $v) {
                $insert_data[]=[$this->id,$v];
            }
        }

        if($insert_data!=null){
            Yii::$app->db->createCommand()->batchInsert(
                'tbl_post_category',
                ['post_id','category_id'],
                $insert_data
            )->execute();
        }


    }

}

//
