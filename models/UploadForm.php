<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $excelFile;

    public function rules()
    {
        return [
            [['excelFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'xlsx'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->excelFile->saveAs('file_uploads/' . $this->excelFile->baseName . '.' . $this->excelFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function digest()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        // $filePath = Yii::getAlias('@app/web/uploads/'.$this->excelFile->baseName. '.' . $this->excelFile->extension);
        $filePath = Yii::getAlias('@app/web/file_uploads/'.$this->excelFile->baseName. '.' . $this->excelFile->extension);

        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        Yii::$app->db->createCommand('TRUNCATE temp_import_company')->query();

        $reader->open($filePath);
        $x = 0;
        foreach ($reader->getSheetIterator() as $sheet) {
            
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        $cells = $row->getCells();
                        #echo $cells[1].'<br>';
                        if($cells[1] == "")
                        {
                            break;
                        }
                        //echo $cells[1];exit;
                        $data = \app\models\Company::findOne(['fld_sec_reg_no'=>trim($cells[0])]);

                        $model = new \app\models\TempImportCompany;
                        $model->sec_reg_no = $cells[0];
                        $model->name =  $cells[1];
                        $model->former_name = isset($cells[7]) ? $cells[7]:'';
                        $model->primary_license = \app\models\Company::getPrimaryCode($cells[2]);
                        $model->secondary_license = \app\models\Company::setSecondaryLicense($cells[1]); 
                        $model->status = $cells[5];

                        if($data !== null)
                        {
                            $model->with_duplicate = 1;
                            $model->duplicate_sec_reg_no = $data->fld_sec_reg_no;
                            $model->duplicate_name = $data->fld_sec_reg_name;
                        }else{
                            $model->with_duplicate = 0;
                        }
                        $model->save(false);


                        // if($this->checkIfNotExist($cells[0],$cells[1],$this->excelFile->baseName)){
                        //     $model = new \app\models\Company;
                        //     $model->fld_sec_reg_no = $cells[0];
                        //     $model->fld_sec_reg_name = $cells[1];
                        //     $model->fld_orig_sec_reg_name = $cells[2];
                        //     $model->fld_primary_license = \app\models\Company::getPrimaryCode($cells[3]);
                        //     $model->fld_secondary_license = '';
                        //     $model->fld_office_code_fk = ''; 
                        //     $model->fld_emp_id = '';
                        //     $model->fld_entity_code_fk = $cells[4];
                        //     //$model->save(false);

                        // }

                        
                    }
                    $x++;
                
            }
          
        }
        $reader->close();
    }

    public function setSecondaryLicense($name)
    {

    }

    public function checkIfNotExist($secno,$name,$file)
    {
        $data = \app\models\Company::findOne(['fld_sec_reg_no'=>trim($secno)]);

          
            // if($data !== null)
            // {
                

                
            
            //     // $result = 'Excel: '.$secno.'|'.$name."\n";
            //     // $result .= 'CIS-URDB: '.$data->fld_sec_reg_no.'|'.$data->fld_sec_reg_name."\n";

            //     // $fileData = Yii::getAlias('@app/web/duplicates/'.$file .'.txt');
                
            //     // if(!is_file($fileData)){
                    
            //     //     file_put_contents($fileData, $result);
            //     // }else{
                
            //     //     file_put_contents($fileData, $result,FILE_APPEND);
            //     // }

            //     //return false;

            // }
           $model->save(false);
    }
}