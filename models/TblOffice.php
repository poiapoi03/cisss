<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_office".
 *
 * @property string $fld_officecode
 * @property string $fld_officecodename
 * @property string $fld_officename
 * @property string $fld_head
 * @property string $fld_head_position
 * @property string $fld_asst
 * @property string $fld_asst_position
 * @property string $fld_floor This will adjusts signatories and image alignments. Single Line Address*Address1*Address2*Signatory Alignment*Logo Adjustment
 * @property string $fld_address1
 * @property string $fld_address2
 * @property string $fld_rcc
 * @property int $fld_office_loc 1 - Main Office
 */
class TblOffice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_office';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_admindb');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fld_officecode', 'fld_officecodename', 'fld_officename', 'fld_head', 'fld_head_position', 'fld_asst', 'fld_asst_position', 'fld_floor', 'fld_address1', 'fld_address2', 'fld_rcc', 'fld_office_loc'], 'required'],
            [['fld_officecodename', 'fld_officename', 'fld_head', 'fld_head_position', 'fld_asst', 'fld_asst_position', 'fld_address1', 'fld_address2'], 'string'],
            [['fld_office_loc'], 'integer'],
            [['fld_officecode'], 'string', 'max' => 10],
            [['fld_floor'], 'string', 'max' => 15],
            [['fld_rcc'], 'string', 'max' => 12],
            [['fld_officecode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_officecode' => 'Fld Officecode',
            'fld_officecodename' => 'Fld Officecodename',
            'fld_officename' => 'Fld Officename',
            'fld_head' => 'Fld Head',
            'fld_head_position' => 'Fld Head Position',
            'fld_asst' => 'Fld Asst',
            'fld_asst_position' => 'Fld Asst Position',
            'fld_floor' => 'Fld Floor',
            'fld_address1' => 'Fld Address1',
            'fld_address2' => 'Fld Address2',
            'fld_rcc' => 'Fld Rcc',
            'fld_office_loc' => 'Fld Office Loc',
        ];
    }
}
