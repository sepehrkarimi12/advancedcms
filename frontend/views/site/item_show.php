 <div class="blog-post">
            <h1 class="blog-post-title"><a href="<?= \yii\helpers\url::to([
            	'post/show',
            	'id'=>$model->id]);
            	 ?>">
            	<?= $model->title ?></a></h1>
            <p class="blog-post-meta"><?= \Yii::$app->formatter->asDate($model->create_time,'long') ?>
            	<a href="#"><?= $model->author->username ?></a>
            </p>
           <p><?= mb_substr($model->content,0,50) ?></p>
</div>