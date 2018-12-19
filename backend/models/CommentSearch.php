<?php
namespace backend\models;

use backend\models\Comment;
use yii\base\Model;
use yii\data\activeDataProvider;
/**
* 
*/
class CommentSearch extends Comment
{
    public $post_title;
    
    public function rules()
    {
        return[
            [['author','post_title','content'],'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query=Comment::find();
        $query->joinWith('post');

        $dataProvider=new activeDataProvider([
            'query'=>$query
        ]);

        if( !( $this->load($params) && $this->validate() ) )
        {
            return $dataProvider;
        }

        $query->andFilterWhere(['like','author',$this->author])
              ->andFilterWhere(['like','tbl_post.title',$this->post_title])
              ->andFilterWhere(['like','tbl_comment.content',$this->content]); 
        return $dataProvider;
    }

}


?>