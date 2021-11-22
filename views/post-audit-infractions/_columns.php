<?php
use yii\helpers\Url;

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
        'filter'=>['131'=>'For Compliance - Amendment','132'=>'For Compliance - Petition for Correction','133'=>'For Compliance - Others']
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_remarks',
        'format'=>'html',
    ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'fld_cleared',
        'trueLabel'=>'Cleared',
        'falseLabel'=>'Not Cleared'
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_neg_date',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_date_cleared',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_source_office',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_source_specialist',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'width'=>'100px',
        'template'=>'{view} {update}',
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip','class'=>'btn btn-warning'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip','class'=>'btn btn-primary'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   