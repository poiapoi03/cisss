<?php

namespace app\controllers;
use yii\rest\ActiveController;
use Yii;
use yii\rest\Controller;
use yii\data\ActiveDataProvider;
use yii\httpclient\Client;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\base\ErrorException;
use Ramsey\Uuid\Uuid;

class ApiController extends ActiveController 
{
    public $modelClass = 'app\models\ContactForm';
    public $user_password;

    public function __construct($id, $module, $config = [])
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        parent::__construct($id, $module, $config);
    }
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'insert-company' => ['post'],
                    'add-infraction' => ['post'],
                ],
            ],
            'authenticator' => [
                'class' => HttpBearerAuth::className(),
            ]
        ];
    }


    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'],$actions['index'],$actions['update'],$actions['view']);

        // customize the data provider preparation with the "prepareDataProvider()" method
       // $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function actionAddInfraction()
    {
        try{
            if(!$this->checkRole())
            {
                $this->returnError('INVALID USER'); 
            }
        
            $request = Yii::$app->request;
            $post = $request->bodyParams;

            $data = $post['sec_reg_no'];
            
            if($data=="")
            {
                $this->returnError('INVALID DATA'); 
            }else{
                ini_set('memory_limit', '256M');
                return $this->addInfraction($post);
            }

        }catch (ErrorException $e){
            $this->returnError($e->getMessage()); 
        }
    }

    private function addInfraction($data)
    {
        try{
                $fld_status_code_fk = 134;
                if(isset($data['post_review_status_id'])){
                    switch($data['post_review_status_id'])
                    {
                        case 7: //For Compliance - Amendment
                                $fld_status_code_fk = 131;
                                break;
                        case 8: //For Compliance - Petition
                                $fld_status_code_fk = 132;
                                break;
                        case 10: //For Compliance - Other
                                $fld_status_code_fk = 133;
                                break;
                    }
                }
                $empid = ''; 
                switch($data['office'])
                {
                    case 1: $empid = "001"; $office_id = "0103010200"; break; //main office - crmd - cprd
                    case 2: $empid = "002"; $office_id = "0103030000"; break; //eo baguio    
                    case 3: $empid = "005"; $office_id = "0103040000"; break; //eo iloilo    
                    case 4: $empid = "008"; $office_id = "0103050000"; break; //eo CDO    
                    case 5: $empid = "007"; $office_id = "0103060000"; break; //eo cebu    
                    case 6: $empid = "009"; $office_id = "0103070000"; break; //eo davao    
                    case 7: $empid = "010"; $office_id = "0103080000"; break; //eo zamboanga    
                    case 8: $empid = "004"; $office_id = "0103090000"; break; //eo legazpi 
                    case 9: $empid = "003"; $office_id = "0103100000"; break; //eo tarlac    
                    case 10: $empid = "006"; $office_id = "0103110000"; break; //eo bacolod    
                }
                
                $model = new \app\models\TblNegativeList;
                $model->fld_sec_reg_no_fk = $data['sec_reg_no'];
                $model->fld_status_code_fk = $fld_status_code_fk;
                $model->fld_remarks = $data['remarks'] .'<br>';
                $model->fld_cleared = 0;
                $model->fld_neg_date  = date('Y-m-d H:i:s');
                $model->fld_date_cleared = date('Y-m-d');
                $model->fld_source_office = $office_id;
                $model->fld_source_specialist = '|'.$empid.'|';
                $model->save(false);

        }catch (ErrorException $e){
            $this->returnError($e->getMessage()); 
        }
    }


    public function actionInsertCompany()
    {
        try{
            if(!$this->checkRole())
            {
                $this->returnError('INVALID USER'); 
            }
        
            $request = Yii::$app->request;
            $post = $request->bodyParams;

            $data = $post['sec_reg_no'];
            
            if($data=="")
            {
                $this->returnError('INVALID DATA'); 
            }else{
                ini_set('memory_limit', '256M');
                return $this->insertCompany($post);
            }

        }catch (ErrorException $e){
            $this->returnError($e->getMessage()); 
        }
    }

    private function insertCompany($data)
    {
        try{
            $model = \app\models\Company::findOne(['fld_sec_reg_no'=>$data['sec_reg_no']]);

            if($model == null)
            {
                $model = new \app\models\Company;
                $model->fld_sec_reg_no = $data['sec_reg_no'];
                $model->fld_sec_reg_name = $data['company_name'];//fullname
                $model->fld_orig_sec_reg_name = '';
                $model->fld_primary_license = \app\models\Company::getPrimaryCode($data['type']);
                $model->fld_secondary_license  = '';
                $model->fld_office_code_fk = '';
                $model->fld_emp_id = '';
                $model->fld_entity_code_fk = 'REGISTERED';
                $model->save(false);

                if(isset($data['onesec']))
                {
                    if($data['onesec'] == 1)
                    {
                        $model = \app\models\TblNegativeList::findOne(['fld_sec_reg_no_fk'=>$data['sec_reg_no'],'fld_status_code_fk'=>134,'fld_cleared'=>0]);
                        if($model == null)
                        {
                            $data['remarks'] = 'For Post Audit';
                            $this->addInfraction($data);
                        }
                    }
                }

            }

        }catch (ErrorException $e){
            $this->returnError($e->getMessage()); 
        }
    }

    public function checkRole()
    {
        
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        
        $userRole = '';
        foreach ($role as $each) {
           $userRole .= $each->name;
        }
      
        if($userRole == "API user")
        {
            return true;
        }else{
            return false;
        }
    }

    
  
    public function returnError($message)
    {
        echo json_encode(array('error'=>$message),JSON_PRETTY_PRINT);
        exit;
    }


}
