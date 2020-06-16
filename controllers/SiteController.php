<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Company;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionUpdateFoundation()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        $filePath = Yii::getAlias('@app/web/foundations.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);

        $reader->open($filePath);
        $x = 0;
        echo 'start<br>';
        foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        $cells = $row->getCells();
                        if($cells[1] == "")
                        {
                            break;
                        }
                        $model = \app\models\Company::findOne(['fld_sec_reg_no'=>$cells[0]]);
                       
                        if($model != null)
                        {
                            // if(!strpos($model->fld_secondary_license, '0029')){
                            //     echo "'".$model->fld_sec_reg_no . '[' . $model->fld_sec_reg_name .'[' .$model->fld_secondary_license .'<br>';
                            //     if($model->fld_secondary_license == "")
                            //     {
                            //         $model->fld_secondary_license = '|0029|';
                            //     }else{
                            //         $model->fld_secondary_license .= '0029|';
                            //     }
                            //     $model->save(false);
                            // }

                        }else{
                            echo $cells[0] . '|' . $cells[1] .'<br>';
                            $model = new \app\models\Company;
                            $model->fld_sec_reg_no = $cells[0];
                            $model->fld_sec_reg_name = $cells[1];
                            $model->fld_orig_sec_reg_name = '';
                            $model->fld_primary_license = '';
                            $model->fld_secondary_license = '|0029|';
                            $model->fld_office_code_fk = '';
                            $model->fld_emp_id = '';
                            $model->fld_entity_code_fk = 'REGISTERED';
                            $model->save(false);
                        }
                    }
                    $x++;
                
            }
          
        }
        echo 'end';
        $reader->close();
        exit;
    }

    //step 4
    public function actionUpdateSecondaryLic()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        $filePath = Yii::getAlias('@app/web/CRMD_VALIDATED.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);

        $reader->open($filePath);
        $x = 0;
        echo 'start<br>';
        foreach ($reader->getSheetIterator() as $sheet) {
            if($sheet->getName() == 'FOUNDATION' || $sheet->getName() == 'MICROFINANCE' || $sheet->getName() == 'LENDING' || $sheet->getName() == 'FINANCING'){
                echo $sheet->getName() . '<br>';
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        $cells = $row->getCells();
                        if($cells[1] == "")
                        {
                            break;
                        }
                        $secLic = '';
                        switch ($sheet->getName()) {
                            case 'FOUNDATION':
                                $secLic = '0029';
                                break;
                            case 'MICROFINANCE':
                                $secLic = '0030';
                                break;
                            case 'LENDING':
                                $secLic = '0002';
                                break;
                            case 'FINANCING':
                                $secLic = '0001';
                                break;
                            
                            default:
                                # code...
                                break;
                        }

                        if($cells[12] == "YES"){
                            $model = Company::findOne(['fld_sec_reg_no'=>$cells[1]]);
                            if($model != null)
                            {
                                if($model->fld_secondary_license != "")
                                {
                                    if (strpos($model->fld_secondary_license, $secLic) !== false) {
                                    // echo 'true';
                                    }else{
                                        $model->fld_secondary_license .=  $secLic .'|';  
                                    }
                                }else{
                                    $model->fld_secondary_license =  '|'.$secLic .'|'; 
                                }
                                
                                $model->save(false);
                            }
                        }
                       
                        
                        //exit;


                    }
                    $x++;
                }
            }
          
        }
        echo 'end';
        $reader->close();

    }

    //step 3
    public function actionUpdateCompanyTable()
    {

        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        $filePath = Yii::getAlias('@app/web/CRMD_VALIDATED.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);

        $reader->open($filePath);
        $x = 0;
        echo 'start<br>';
        foreach ($reader->getSheetIterator() as $sheet) {
            if($sheet->getName() == 'FOR INSERT'){
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        $cells = $row->getCells();
                        if($cells[0] == "")
                        {
                            break;
                        }
                        $model = new \app\models\Company;
                        $model->fld_sec_reg_no = $cells[0];
                        $model->fld_sec_reg_name = $cells[1];
                        $model->fld_orig_sec_reg_name = $cells[2];
                        $model->fld_primary_license = \app\models\Company::getPrimaryCode($cells[3]);
                        $model->fld_secondary_license = '';
                        $model->fld_office_code_fk = ''; 
                        $model->fld_emp_id = '';
                        $model->fld_entity_code_fk = $cells[4];
                        $model->save(false);

                    }
                    $x++;
                }
            }
          
        }
        echo 'end';
        $reader->close();


    }

    //step 2
    public function actionImport2()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        $filePath = Yii::getAlias('@app/web/CRMD_VALIDATED.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);

        $fileData = Yii::getAlias('@app/web/2015-2019_for_insert_2ndrun.txt');

        $reader->open($filePath);
        $x = 0;
        echo 'start';
        foreach ($reader->getSheetIterator() as $sheet) {
            if($sheet->getName() == 'FOR INSERT'){
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        // do stuff with the row
                        $cells = $row->getCells();
                        echo $cells[1] . '<br>';
                        $chk = \app\models\Company::findOne(['fld_sec_reg_name'=>$cells[1]]);
                        // $chk = Yii::$app->db->createCommand('SELECT fld_sec_reg_no,fld_sec_reg_name FROM cis_urdb.tbl_company WHERE fld_sec_reg_no = "'.$cells[0].'"')->query();
                        
                        if($chk)
                        {
                            //echo 'NOT FOUND|'.$cells[0].'|'.$cells[1] .'<br>';
                            //secregno|name|formername|businesstype|status|
                            // $formerName = isset($cells[7]) ? $cells[7]:'';
                            $result = $cells[0].'|'.$cells[1].'|'.$chk->fld_sec_reg_no.'|'.$chk->fld_sec_reg_name."\n";
                            file_put_contents($fileData, $result,FILE_APPEND);
                        }
                        // else{
                        //     echo 'FOUND'.$cells[0].'|'.$cells[1] .'<br>';
                        // }
                    }
                    $x++;
                }
            }
          
        }
        echo 'end';
        $reader->close();
    }

    //step 1
    public function actionImport()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time',3000);

        $filePath = Yii::getAlias('@app/web/CRMD_VALIDATED.xlsx');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);

        $fileData = Yii::getAlias('@app/web/2015-2019_for_insert.txt');

        $reader->open($filePath);
        $x = 0;
        echo 'start<br>';
        foreach ($reader->getSheetIterator() as $sheet) {
            if($sheet->getName() == 'ALL'){
                foreach ($sheet->getRowIterator() as $row) {
                    if($x > 0){
                        // do stuff with the row
                        $cells = $row->getCells();

                        $chk = Yii::$app->db->createCommand('SELECT fld_sec_reg_no,fld_sec_reg_name FROM cis_urdb.tbl_company WHERE fld_sec_reg_no = "'.$cells[0].'"')->queryOne();
                        // $chk = Yii::$app->db->createCommand('SELECT fld_sec_reg_no,fld_sec_reg_name FROM cis_urdb.tbl_company WHERE fld_sec_reg_no = "'.$cells[0].'"')->query();
                        
                        if(!$chk)
                        {
                            //echo 'NOT FOUND|'.$cells[0].'|'.$cells[1] .'<br>';
                            //secregno|name|formername|businesstype|status|
                            $formerName = isset($cells[7]) ? $cells[7]:'';
                            $result = $cells[0].'|'.$cells[1].'|'.$formerName.'|'.$cells[2].'|'.$cells[5]."\n";
                            file_put_contents($fileData, $result,FILE_APPEND);
                        }
                        // else{
                        //     echo 'FOUND'.$cells[0].'|'.$cells[1] .'<br>';
                        // }
                    }
                    $x++;
                }
            }
          
        }
        echo 'end';
        $reader->close();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest){

             return $this->render('index');
        }
		else{
             return $this->redirect(['user/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
