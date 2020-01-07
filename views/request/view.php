<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblRequest */
?>
<div class="tbl-request-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fld_id',
            'fld_req_no',
            'fld_sec_reg_no',
            'fld_co_name:ntext',
            'fld_entity_type',
            'fld_req_party:ntext',
            'fld_address:ntext',
            'fld_contactno',
            'fld_purpose:ntext',
            'fld_office',
            'fld_status',
            'fld_text_ext:ntext',
            'fld_encoder:ntext',
            'fld_req_timestamp',
            'fld_req_empid',
            'fld_eva_timestamp',
            'fld_eva_empid',
            'fld_pri_timestamp',
            'fld_pri_empid',
            'fld_rel_timestamp',
            'fld_rel_empid',
            'fld_orno:ntext',
            'fld_ordate',
            'fld_oramount',
            'fld_signatory',
            'fld_printed_by:ntext',
        ],
    ]) ?>

</div>
