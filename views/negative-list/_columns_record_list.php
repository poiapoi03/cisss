<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_neg_id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_sec_reg_no_fk',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'companyDetails',
        'value'=>'companyDetails.fld_sec_reg_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_status_code_fk',
        'value'=>function($model){ return $model->status->fld_status_desc; },
        'filter'=>ArrayHelper::map(\app\models\TblStatus::find()->where(['fld_office_assign'=>Yii::$app->user->identity->dept_id])->asArray()->all(), 'fld_status_id', 'fld_status_desc'),
        //'filter'=>['0'=>'poi','1'=>'oooo']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_remarks',
        'format'=>'raw'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_cleared',
        'value'=>function($model){ return $model->fld_cleared == 0 ? 'NO':'YES'; },
        'filter'=>['0'=>'NO','1'=>'YES']
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_neg_date',
    //     'format'=>['date','php: F d, Y']
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_date_cleared',
    //     'value'=>function($model){
    //         return $model->fld_cleared == 0 ? '': Yii::$app->formatter->asDate($model->fld_date_cleared,'php: F d, Y');
    //     },
   
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_source_office',
    //     'value'=>function($model){ return $model->office;}
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_source_specialist',
        'value'=>function($model){ return $model->specialist;}
    ],
    
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template'=>'{update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to(['negative-list/'.$action,'id'=>$key]);
        },
        'buttons' => [
            'update'=>function($url, $model, $key) {   
                if( $model->fld_cleared == 0 && ($model->fld_source_specialist == '|'.Yii::$app->user->identity->empid.'|' || Yii::$app->user->can('Supervisor'))){  // render your custom button
                    return Html::a('<i class="fa fa-pencil"></i>', ['negative-list/update','id'=>$key], ['class' => 'btn btn-success btn-md','role'=>'modal-remote']);
                }
            }
        ],
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   