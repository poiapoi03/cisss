<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_negative_list".
 *
 * @property int $fld_neg_id
 * @property string $fld_sec_reg_no_fk
 * @property string $fld_status_code_fk
 * @property string $fld_remarks
 * @property int $fld_cleared
 * @property string $fld_neg_date
 * @property string $fld_date_cleared
 * @property string $fld_source_office
 * @property string $fld_source_specialist
 */
class TblNegativeList extends \yii\db\ActiveRecord
{

    public $addRemarks;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_negative_list';
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
            [['fld_sec_reg_no_fk', 'fld_status_code_fk', 'fld_source_office', 'fld_source_specialist'], 'required'],
            [['fld_remarks', 'fld_source_office', 'fld_source_specialist'], 'string'],
            [['fld_cleared'], 'integer'],
            [['fld_neg_date', 'fld_date_cleared','fld_status_code_fk','addRemarks'], 'safe'],
            [['fld_sec_reg_no_fk'], 'string', 'max' => 20],
            [['fld_status_code_fk'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fld_neg_id' => 'Fld Neg ID',
            'fld_sec_reg_no_fk' => 'Fld Sec Reg No Fk',
            'fld_status_code_fk' => 'Infraction Type',
            'fld_remarks' => 'Remarks',
            'fld_cleared' => 'Cleared',
            'fld_neg_date' => 'Date Added',
            'fld_date_cleared' => 'Date Cleared',
            'fld_source_office' => 'Source Office',
            'fld_source_specialist' => 'Source Specialist',
            'addRemarks' => 'Additional Remarks',
        ];
    }

    public function beforeSave($insert) {
        date_default_timezone_set('Asia/Manila');
        if ($insert) {

           $this->fld_neg_date = date('Y-m-d');
           $this->fld_cleared = 0;
           $this->fld_remarks = '<b>'.date('d F Y').': </b>'. $this->fld_remarks .'<br>';
        }else{
            if($this->fld_cleared == 1)
            {
                $this->fld_date_cleared = date('Y-m-d H:i:s');
                if($this->addRemarks == "")
                {
                    $this->fld_remarks .= '<b>'.date('d F Y').': </b>No Remarks.<br>';
                }else{
                    $this->fld_remarks .= '<b>'.date('d F Y').': </b>'.$this->addRemarks.'<br>';
                }
            }else{
                if($this->addRemarks != "")
                {
                
                    $this->fld_remarks .= '<b>'.date('d F Y').': </b>'.$this->addRemarks.'<br>';
                }
            
            }
        }

        return parent::beforeSave($insert);

    }

    public function getStatus()
    {
        return $this->hasOne(TblStatus::className(), ['fld_status_id' => 'fld_status_code_fk']);
    }

    public function getCompanyDetails()
    {
        return $this->hasOne(Company::className(), ['fld_sec_reg_no' => 'fld_sec_reg_no_fk']);
    }


    public function getOffice()
    {
        $data = str_replace('|','', $this->fld_source_office);
        $office = TblOffice::findOne(['fld_officecode'=>$data]);

        return $office->fld_officecodename;
    }

    public function getSpecialist()
    {
        $data = str_replace('|','', $this->fld_source_specialist);
        $office = TblAuthUser::findOne(['fld_empid'=>$data]);

        return $office->fld_name;
    }

    public function getSpecialistInitital()
    {
        $data = str_replace('|','', $this->fld_source_specialist);
        $office = TblAuthUser::findOne(['fld_empid'=>$data]);

        return $office->fld_initial;
    }

    public function getInfractions($office, $company, $type) //type 1 = specific code, type 2 = wildcard
    {
        $result = [];
        if($type == 1){
            $data = TblNegativeList::find()->where(['fld_sec_reg_no_fk'=>$company,'fld_source_office'=>$office,'fld_cleared'=>0])->all();
        }else{
            $data = TblNegativeList::find()->where(['LIKE', 'fld_source_office', $office.'%', false])
                        ->andWhere(['fld_sec_reg_no_fk'=>$company,'fld_cleared'=>0])->all();
        }
       
        if($data == null)
        {
            array_push($result, 'Cleared');
            return $result;
        }else{
            foreach($data as $row){
                array_push($result,  [$row->status->fld_status_desc . ' -'.$row->specialistInitital => $row->fld_remarks]);
            }
            
            return $result;
        }
        
        
    }

    
}
