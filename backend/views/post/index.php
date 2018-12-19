<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
            	'attribute'=>'tags',
            	'label'=>'tAGS',
            	'format'=>'text',
            	'value'=>function($row)
            	{
            		return mb_substr($row->tags,0,50);
            	}
            ],

            [
                'attribute'=>'title',
                'options'=>['class'=>'bg-danger'],
            ],

            [
                'attribute'=>'content',
                'value'=>function($row)
                {
                    return mb_substr($row->content, 0,50);
                }
            ],
            // 'content:ntext',
            // 'tags:ntext',
            'status',
            //'create_time:datetime',
            //'update_time:datetime',
            //'author_id',

            [   
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>
</div>
