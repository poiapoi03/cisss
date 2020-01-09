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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'sec_reg_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'former_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'primary_license',
        'value'=>function($model){ return \app\models\Company::getPrimaryLic($model->primary_license); },
        'filter'=>[
            '20101'=>"Stock Corporation",
            '20201'=>"Non-Stock Corporation",
            '20102'=>"Foreign Stock Corporation",
            '20202'=>"Foreign Non-stock Corporation",
            '10101'=>"General Partnership",
            '10102'=>"Limited Partnership",
            '10103'=>"Professional Partnership",
            '10104'=>"Foreign Partnership"
        ]
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'secondaryLic',
        'format'=>'html',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'status',
    // ],
    [
        'class'=>'\kartik\grid\BooleanColumn',
        'attribute'=>'with_duplicate',
        'trueLabel'=>'Yes',
        'falseLabel'=>'No'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'duplicate_sec_reg_no',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'duplicate_name',
    ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'urlCreator' => function($action, $model, $key, $index) { 
    //             return Url::to([$action,'id'=>$key]);
    //     },
    //     'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
    //     'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
    //     'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
    //                       'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
    //                       'data-request-method'=>'post',
    //                       'data-toggle'=>'tooltip',
    //                       'data-confirm-title'=>'Are you sure?',
    //                       'data-confirm-message'=>'Are you sure want to delete this item'], 
    // ],

];   