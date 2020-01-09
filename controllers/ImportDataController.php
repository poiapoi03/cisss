<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;

class ImportDataController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new \app\models\UploadForm;
        if (Yii::$app->request->isPost) {
            $model->excelFile = UploadedFile::getInstance($model, 'excelFile');
            if ($model->upload()) {

                // move_uploaded_file (Yii::getAlias('@app/web/file_uploads/'.$model->excelFile->baseName . '.' . $model->excelFile->extension), 
                // Yii::getAlias('@app/web/file_uploads/data/'.$model->excelFile->baseName . '.' . $model->excelFile->extension));
                // file is uploaded successfully
                $model->digest();
                
                return $this->redirect(['/import-validate/index']);
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}
