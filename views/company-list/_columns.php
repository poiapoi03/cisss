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
    //     'attribute'=>'fld_id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_sec_reg_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fld_sec_reg_name',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_orig_sec_reg_name',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fld_primary_license',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'secLic',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_office_code_fk',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_emp_id',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fld_entity_code_fk',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'template'=>'{view}',
        'viewOptions'=>['title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   