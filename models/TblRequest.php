<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_request".
 *
 * @property int $fld_id
 * @property string $fld_req_no
 * @property string $fld_sec_reg_no
 * @property string $fld_co_name
 * @property int $fld_entity_type 1 - Stock; 2 - Non-stock
 * @property string $fld_req_party
 * @property string $fld_address
 * @property string $fld_contactno
 * @property string $fld_purpose
 * @property string $fld_office
 * @property int $fld_status
 * @property string $fld_text_ext
 * @property string $fld_encoder
 * @property string $fld_req_timestamp
 * @property string $fld_req_empid
 * @property string $fld_eva_timestamp
 * @property string $fld_eva_empid
 * @property string $fld_pri_timestamp
 * @property string $fld_pri_empid
 * @property string $fld_rel_timestamp
 * @property string $fld_rel_empid
 * @property string $fld_orno
 * @property string $fld_ordate
 * @property string $fld_oramount
 * @property string $fld_signatory
 * @property string $fld_printed_by
 */
class TblRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_request';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_cisurdb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fld_req_no', 'fld_sec_reg_no', 'fld_co_name', 'fld_entity_type', 'fld_req_party', 'fld_address', 'fld_contactno', 'fld_purpose', 'fld_office', 'fld_status', 'fld_text_ext', 'fld_encoder', 'fld_req_empid', 'fld_eva_empid', 'fld_pri_empid', 'fld_rel_empid', 'fld_orno', 'fld_ordate', 'fld_oramount', 'fld_signatory', 'fld_printed_by'], 'required'],
            [['fld_co_name', 'fld_req_party', 'fld_address', 'fld_purpose', 'fld_text_ext', 'fld_encoder', 'fld_orno', 'fld_printed_by'], 'string'],
            [['fld_entity_type', 'fld_status'], 'integer'],
            [['fld_req_timestamp', 'fld_eva_timestamp', 'fld_pri_timestamp', 'fld_rel_timestamp', 'fld_ordate'], 'safe'],
            [['fld_oramount'], 'number'],
            [['fld_req_no', 'fld_signatory'], 'string', 'max' => 14],
            [['fld_sec_reg_no', 'fld_contactno'], 'string', 'max' => 20],
            [['fld_office', 'fld_req_empid', 'fld_eva_empid', 'fld_pri_empid', 'fld_rel_empid'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_id' => 'Fld ID',
            'fld_req_no' => 'Fld Req No',
            'fld_sec_reg_no' => 'Fld Sec Reg No',
            'fld_co_name' => 'Fld Co Name',
            'fld_entity_type' => 'Fld Entity Type',
            'fld_req_party' => 'Fld Req Party',
            'fld_address' => 'Fld Address',
            'fld_contactno' => 'Fld Contactno',
            'fld_purpose' => 'Fld Purpose',
            'fld_office' => 'Fld Office',
            'fld_status' => 'Fld Status',
            'fld_text_ext' => 'Fld Text Ext',
            'fld_encoder' => 'Fld Encoder',
            'fld_req_timestamp' => 'Fld Req Timestamp',
            'fld_req_empid' => 'Fld Req Empid',
            'fld_eva_timestamp' => 'Fld Eva Timestamp',
            'fld_eva_empid' => 'Fld Eva Empid',
            'fld_pri_timestamp' => 'Fld Pri Timestamp',
            'fld_pri_empid' => 'Fld Pri Empid',
            'fld_rel_timestamp' => 'Fld Rel Timestamp',
            'fld_rel_empid' => 'Fld Rel Empid',
            'fld_orno' => 'Fld Orno',
            'fld_ordate' => 'Fld Ordate',
            'fld_oramount' => 'Fld Oramount',
            'fld_signatory' => 'Fld Signatory',
            'fld_printed_by' => 'Fld Printed By',
        ];
    }
}
