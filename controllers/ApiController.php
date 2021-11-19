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
                    'handler' => ['post'],
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
                $model->fld_primary_license = \app\models\Company::getPrimaryCode($data['type']);
                $model->fld_entity_code_fk = 'REGISTERED';
                $model->save(false);

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
