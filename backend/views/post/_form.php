<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-8">
        <div class="post-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'status')->checkBox() ?>

            <?= $form->field($model, 'create_time')->textInput() ?>

            <?= $form->field($model, 'update_time')->textInput() ?>

            <?= $form->field($model, 'author_id')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success col-md-12']) ?>
            </div>        

        </div>
    </div>

    <!-- checkboxes -->
    <div class="col-md-4">
        <?php
        echo Html::checkBoxList('PostCategory',$model->getSelectedCategory(),$model->getAllCategories());
        ?>
    </div>

        <?php ActiveForm::end(); ?>
</div>
