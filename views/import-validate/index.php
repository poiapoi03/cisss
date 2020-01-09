<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TempImportCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Excel Import Validation';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <i class="icon fa fa-check"></i>
         <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

<?php 
    $wduplicate = \app\models\TempImportCompany::find()->where(['with_duplicate'=>1])->count();
    $woduplicate = \app\models\TempImportCompany::find()->where(['with_duplicate'=>0])->count();
    $total = \app\models\TempImportCompany::find()->count();

    if($total > 0){
    echo '<h3>Summary</h3>';
    echo '<p>TOTAL: '. $total.'</p>';
    echo '<p>With Duplicate SEC Reg. No. : '.$wduplicate.'</p>';
    echo '<p>No Duplicate : '.$woduplicate.'</p>';
    }

?>
<a class="btn btn-danger" href="<?= Url::to(['/import-data'])?>"><i class="fa fa-arrow-left"></i> Back to Upload Page</a>
<br><hr>
<?php  if($total > 0){ ?>
<div class="temp-import-company-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="fa fa-check"></i> Continue Import to Company Table', ['final-import'],
                    ['data-confirm'=>'Are you sure you want to save data to company table?','title'=> 'Continue Import','class'=>'btn btn-success'])
                    // .
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
                'heading' => '<i class="glyphicon glyphicon-list"></i> ',
                'before'=>'<em>* Companies with duplicate SEC Reg. No. will not be included in the final import. </em>',
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

<?php } ?>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
