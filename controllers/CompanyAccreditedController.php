<?php

namespace app\controllers;
use Yii;
use app\models\Company;
use app\models\CompanySearch;
use app\models\TblNegativeListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;

class CompanyAccreditedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->searchMicrofin(Yii::$app->request->queryParams);

        return $this->render('/company-accredited/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateMicrofin($id)
    { 
        $request = Yii::$app->request;
        $model = \app\models\Company::findOne($id);       

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Company #".$id,
                    'content'=>$this->renderAjax('/company-accredited/update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'forceClose'=>true,
                    'title'=> "Company #".$id,
                    // 'content'=>$this->renderAjax('/company-accredited/view', [
                    //     'model' => $model,
                    // ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
            }else{
                 return [
                    'title'=> "Update Company #".$id,
                    'content'=>$this->renderAjax('/company-accredited/update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->fld_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

}
