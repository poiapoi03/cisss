<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company List Assignment';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$assignment = \app\models\Assignment::find()->where(['user_id'=>\Yii::$app->user->id,'type'=>1])->all();
$assignment_range = \app\models\Assignment::find()->where(['user_id'=>\Yii::$app->user->id,'type'=>2])->all();

$tab_items = array();

foreach($assignment as $data)
{
    $tab_items[] = ['label'=> $data->char_assignment, 'content'=>$this->render('list', ['char'=>$data->char_assignment, 'ent'=>$data->ent_id])];
// break;
}

foreach($assignment_range as $data)
{
    $range_data = explode('-', $data->char_assignment);
    $range = range($range_data[0],$range_data[1]);
    
    foreach($range as $row)
    {
        $tab_items[] = ['label'=> $row, 'content'=>$this->render('list', ['char'=>$row, 'ent'=>$data->ent_id])];
    }
}


sort($tab_items);
echo TabsX::widget([
    'items'=>$tab_items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
?>