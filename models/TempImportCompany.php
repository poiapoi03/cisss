<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "temp_import_company".
 *
 * @property int $id
 * @property string $sec_reg_no
 * @property string $name
 * @property string $former_name
 * @property string $primary_license
 * @property string $secondary_license
 * @property string $status
 * @property int $with_duplicate
 * @property string $duplicate_sec_reg_no
 * @property string $duplicate_name
 */
class TempImportCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'temp_import_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'former_name', 'duplicate_name'], 'string'],
            [['with_duplicate'], 'integer'],
            [['sec_reg_no', 'primary_license', 'secondary_license', 'status', 'duplicate_sec_reg_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sec_reg_no' => 'Sec Reg No',
            'name' => 'Name',
            'former_name' => 'Former Name',
            'primary_license' => 'Primary License',
            'secondary_license' => 'Secondary License',
            'status' => 'Status',
            'with_duplicate' => 'With Duplicate',
            'duplicate_sec_reg_no' => 'Duplicate Sec Reg No',
            'duplicate_name' => 'Duplicate Name',
        ];
    }

    public function getSecondaryLic()
    {
        $data = '';
        $sec = trim($this->secondary_license);
        $sec = explode('|', $sec);

        foreach($sec as $row)
        {
            $lic = Tbl2ndLicenseLib::findOne(['fld_ent_id'=>$row]);
            if($lic != null)
            {
                $data .= '>'.$lic->fld_entity_type .'<br>';
            }
        }

        return $data;
    }
}
