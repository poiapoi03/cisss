<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
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
        'attribute'=>'user_id',
        'value'=>'user.name',
        'filter'=>ArrayHelper::map(\app\models\User::find()
        ->where(['like','office_id', '010501%', false])
        ->asArray()->all(), 'id', 'name'),
        // 'header'=>'Specialist'
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ent_id',
        'value'=>'secLic.fld_entity_type',
        // 'filter'=>ArrayHelper::map(\app\models\Tbl2ndLicenseLib::find()
        // ->where(['fld_office_code'=>'|0105010000|'])
        // ->asArray()->all(), 'fld_ent_id', 'fld_entity_type'),
        'filter'=>['0001'=>'Financing Company','0002'=>'Lending Company','0029'=>'Foundation','0031'=>'CGFD Accredited Microfin NGOs']
        // 'header'=>'Secondary License'
        // 'filter'=>['0001'=>'Financing Company','0002'=>'Lending Company','0029'=>'Foundation','0031'=>'CGFD Accredited Microfin NGOs'],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'char_assignment',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'type',
        'value'=>function($model){ return $model->type == 1 ? 'Single Character':'Blanket'; }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template'=>'{update}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
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