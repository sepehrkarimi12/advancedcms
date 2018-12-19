<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Comment;
use yii\widgets\Pjax;
use yii\captcha\Captcha;

?>
 <div class="blog-post">
      <h1 class="blog-post-title">
            title of post is :<br>
            <a href="<?= \yii\helpers\url::to(['post/show','id'=>$model->id]) ?>"><?= $model->title ?></a>
      </h1>
      <hr>
      <p class="blog-post-meta">
            create_time of post is : <br>
            <?= \Yii::$app->formatter->asDate($model->create_time,'long') ?>
            <hr>
            username of author is (tbl_user) :<br>
            <a href="#"><?= $model->author->username ?></a>
      </p>
      <hr>
      <p>
            content of post is : <br><br>
            <?=$model->content?>
      </p>
      <hr>
      <h2>COMMENTS</h2>

      <div class="panel panel-default">
        <div class="panel-heading">YOUR COMMENT</div>
        <div class="panel-body">
          <?php 
            $Comment=new Comment;
            Pjax::begin(['enablePushState'=>false]);
            $form = ActiveForm::begin([
            	'action'=>'index.php?r=post/add_comment',
            	'enableClientValidation'=>false,
            	'options'=>
                [
                  'data-pjax'=>''
                ]
            ]);
            echo $form->field($Comment,'author');
            echo $form->field($Comment,'email');
            echo $form->field($Comment,'url');
            echo $form->field($Comment,'content')->textArea();
            echo $form->field($Comment,'verifyCode')->widget(Captcha::className());
          ?>

          it should to be hidden (comment[post_id]) : <input type="text" name="Comment[post_id]" value="<?= $model->id ?>" />
          <div class="form-group">
                <?= Html::submitButton('submit',['class'=>'btn btn-primary']) ?>
          </div>

          <?php ActiveForm::end(); ?>
          <?php Pjax::end() ?>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">All</h3>
        </div>
        <div class="panel-body">
          Panel content
        </div>
      </div>

</div>