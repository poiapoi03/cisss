<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_company".
 *
 * @property int $fld_id
 * @property string $fld_sec_reg_no
 * @property string $fld_sec_reg_name
 * @property string $fld_orig_sec_reg_name
 * @property string $fld_primary_license 10 - Partnership; 20 - Corporation; Stock - 101; Non-Stock - 201
 * @property string $fld_secondary_license
 * @property string $fld_office_code_fk
 * @property string $fld_emp_id
 * @property string $fld_entity_code_fk
 */
class Company extends \yii\db\ActiveRecord
{

    public $secLic;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_company';
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
            [['fld_sec_reg_no', 'fld_sec_reg_name',  'fld_primary_license', 'fld_entity_code_fk'], 'required'],
            ['fld_sec_reg_no','unique'],
            [['fld_office_code_fk', 'fld_emp_id'], 'string'],
            [['fld_sec_reg_no', 'fld_sec_reg_name', 'fld_orig_sec_reg_name'], 'string', 'max' => 250],
            [['fld_secondary_license', 'secLic'], 'safe'],
            [['fld_primary_license'], 'string', 'max' => 5],
            [['fld_entity_code_fk'], 'string', 'max' => 50],
            
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
                $data = '';
                if($this->secLic != ""){
                    foreach($this->secLic as $row)
                    {
                        $data .= '|'.sprintf('%04d',$row);
                    }
                    $data .= '|';
                    $this->fld_secondary_license = $data;
                }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_id' => 'Fld ID',
            'fld_sec_reg_no' => 'SEC Reg. No.',
            'fld_sec_reg_name' => 'Company Name',
            'fld_orig_sec_reg_name' => 'Former Name',
            'fld_primary_license' => 'Primary License',
            'fld_secondary_license' => 'Secondary License',
            'fld_office_code_fk' => 'Office Code',
            'fld_emp_id' => 'Emp ID',
            'fld_entity_code_fk' => 'STATUS',
            'secLic' => 'Secondary License',
            'secondaryLic' => 'Secondary License',
        ];
    }

    public function getSecLic($input = null)
    {
        if($input == null){
            $data = str_replace('|','',$this->fld_secondary_license);
            $result = Tbl2ndLicenseLib::findOne(['fld_ent_id'=> $data]);
        }else{
            $result = Tbl2ndLicenseLib::findOne(['fld_ent_id'=> $input]);
        }
       
        

        return strtoupper($result->fld_entity_type);
    }
    
    public function getPrimaryLicList()
    {
        return [
            '20101'=>"Stock Corporation",
            '20201'=>"Non-Stock Corporation",
            '20102'=>"Foreign Stock Corporation",
            '20202'=>"Foreign Non-stock Corporation",
            '10101'=>"General Partnership",
            '10102'=>"Limited Partnership",
            '10103'=>"Professional Partnership",
            '10104'=>"Foreign Partnership"
        ];
    }

    public function getEntityStatus()
    {
        return [
           'REGISTERED'=>'REGISTERED',
           'REVOKED'=>'REVOKED',
           'SUSPENDED'=>'SUSPENDED',
           'DISSOLVED'=>'DISSOLVED',
           'CANCELLED'=>'CANCELLED'
        ];
    }

    public function getSecondaryLic()
    {
        $data = '';
        $sec = trim($this->fld_secondary_license);
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

    public function getPrimaryCode($input)
    {
        $data = '';
        switch ($input)
        {
            case 'Foreign Non-stock': $data = '20202';
                break;
            case 'Foreign Non-Stock Corporation': $data = '20202';
                break;
            case 'Foreign Partnership': $data = '10104';
                break;
            case 'Foreign Stock': $data = '20102';
                break;
            case 'Foreign Stock Corporation': $data = '20102';
                break;
            case 'General Partnership': $data = '10101';
                break;
            case 'Limited Partnership': $data = '10102';
                break;
            case 'Non-stock Corporation': $data = '20201';
                break;
            case 'Non-Stock Corporation': $data = '20201';
                break;
            case 'Professional Partnership': $data = '10103';
                break;
            case 'Stock Corporation': $data = '20101';
                break;

            default: $data='for checking';
        }

        return $data;
    }

    public function getPrimaryLic($input)
    {
        $data = '';
        switch ($input) {
            case '20101':
                $data = "Stock Corporation";# code...
                break;
            case '20201':
                $data = "Non-Stock Corporation";# code...
                break;
            case '20102':
                $data = "Foreign Stock Corporation";# code...
                break;
            case '20202':
                $data = "Foreign Non-stock Corporation";# code...
                break;
            case '10101':
                $data = "General Partnership";# code...
                break;
            case '10102':
                $data = "Limited Partnership";# code...
                break;
            case '10103':
                $data = "Professional Partnership";# code...
                break;
            case '10104':
                $data = "Foreign Partnership";# code...
                break;
            
            default:
                # code...
                $data="";
                break;
        }

        return $data;
    }

    public function getSecLicList($input)
    {
        $data = explode('|', $input);
        $result = '';
        foreach($data as $row)
        {
            if($row != "")
            {
                $result .= $this->getSecLic($row) .', ';
            }
        }

        return rtrim($result,', ');
    }
}
