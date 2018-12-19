<?php

namespace frontend\controllers;
use frontend\models\Post;
use frontend\models\Comment;
use Yii;

class PostController extends \yii\web\Controller
{
    public function actionShow($id)
	{
		$model=Post::findOne($id);
		return $this->render('../site/show_post',['model'=>$model]);
	}

	public function actionAdd_comment()
	{

		$model=new Comment();
		echo "satrt ";
		if( $model->load(Yii::$app->request->post()) )
		{
			echo "in if ";
			$model->create_time=time();
			$model->status=1;
			if( $model->save() ){
				echo " Your comment saved. ";
			}
			else{
				echo " Sorry try again ";
			}
		}
		echo "end func";

	}

}
