<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblNegativeListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

if($this->title ==""){
    $this->title = 'Infraction Records';
    $this->params['breadcrumbs'][] = $this->title;
}

CrudAsset::register($this);

// echo Yii::$app->user->can('Specialist');
// echo Yii::$app->user->can('Supervisor');
?>

<div class="tbl-negative-list-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns_record_list.php'),
            'toolbar'=> [
                ['content'=> '',
                    // Html::a('<i class="glyphicon glyphicon-plus"></i> Add Infraction', ['/negative-list/create','cid'=>$model->fld_sec_reg_no],
                    // ['role'=>'modal-remote','title'=> 'Create new Tbl Negative Lists','class'=>'btn btn-warning'])
                    //.
                    
                    // '{toggleData}'.
                    // '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> Infraction List',
                // 'before'=>Html::a('<i class="fa fa-print"></i> Print Corporate Status Summary', ['/negative-list/print-summary','id'=>$model->fld_sec_reg_no],
                // ['data-pjax'=>0, 'class'=>'btn btn-default ', 'title'=>'Print','target'=>'_blank']),
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
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
