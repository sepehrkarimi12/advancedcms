<?php
use yii\widgets\ListView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<?php
echo listView::widget([
  'dataProvider'=>$dataProvider,
  'itemView'=>'item_show'//this is item_show file
]);


?>
