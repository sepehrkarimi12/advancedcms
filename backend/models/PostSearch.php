<?php
namespace backend\models;
use backend\models\Post;
use yii\base\Model;
use yii\data\activeDataProvider;

class PostSearch extends Post
{
    public function rules()
    {
        return [
            [['tags','status'],'safe'],
        ];
    }    

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query=Post::find();
        $dataPrivider= new activeDataProvider([
            'query'=>$query
        ]);

        if( !($this->load($params) && $this->validate()) )
        {
            return $dataPrivider;
        }

        $query->andFilterWhere(['like','tags',$this->tags])
              ->andFilterWhere(['like','status',$this->status]);


        return $dataPrivider;

    }

}




?>