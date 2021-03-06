<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Released Requests for Certificate of No Derogatory';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<?php 
if(Yii::$app->user->isGuest)
{
    
    echo '<div class="col-md-10 col-md-offset-1" style="margin-top:50px;">';
}
?>
<div class="tbl-request-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>'',
                    // Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    // ['role'=>'modal-remote','title'=> 'Create new Tbl Requests','class'=>'btn btn-default']).
                    // Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    // ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                    // '{toggleData}'.
                    // '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Released Requests for Certificate of No Derogatory',
                // 'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                // 'after'=>BulkButtonWidget::widget([
                //             'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                //                 ["bulk-delete"] ,
                //                 [
                //                     "class"=>"btn btn-danger btn-xs",
                //                     'role'=>'modal-remote-bulk',
                //                     'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                //                     'data-request-method'=>'post',
                //                     'data-confirm-title'=>'Are you sure?',
                //                     'data-confirm-message'=>'Are you sure want to delete this item'
                //                 ]),
                //         ]).                        
                //         '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>

<?php 
if(Yii::$app->user->isGuest)
{
    echo '</div>';
    echo '<div class="clearfix"></div>';
}
?>

<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

