<?php

namespace app\controllers;
use Yii;
use app\models\Portfolio;
use app\models\Type;
use yii\data\Pagination;
use yii\web\UploadedFile;



class PortfolioController extends \yii\web\Controller
{
    public function actionIndex($id)
    {   
         $query = Portfolio::find()->where(['id_user' => \Yii::$app->user->id])->orderBy([
        'date' => SORT_DESC,
    ]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>10]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', ['model' => $models,
        'pages' => $pages,
        'id'=>$id,
    ]);
       
    }
    public function actionDiplom(){
        $query = Portfolio::find()->where(['id_user' => \Yii::$app->user->id, 'id_type' => '1']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('diplom', ['model' => $models,
        'pages' => $pages,
    ]);
    }
    public function actionKurs(){
        $query = Portfolio::find()->where(['id_user' => \Yii::$app->user->id, 'id_type' => '2']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>2]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('kurs', ['model' => $models,
        'pages' => $pages,
    ]);
    }
    public function actionProject(){
        $query = Portfolio::find()->where(['id_user' => \Yii::$app->user->id, 'id_type' => '3']);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>5]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('project', ['model' => $models,
        'pages' => $pages,
    ]);
    }
    public function actionCreate()
    { 
        $model= new Portfolio();
        if($model->load(Yii::$app->request->post())){
            $model->id_user = \Yii::$app->user->id;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()){
                $model->image = 'upload/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
                $model->save();
            }
           
                return $this->redirect(['index?id=']);
            
            
        }
        return $this->render('create', compact('model'));
    }
    public function actionUpdate($id){
        $model = \app\models\Portfolio :: findOne($id);
        if($model->load(Yii::$app->request->post())){
            $model->id_user = \Yii::$app->user->id;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()){
                $model->image = 'upload/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;
                $model->save();
            }
           
                return $this->redirect(['index?id=']);
            
            
        }
        return $this->render('update',compact('model'));
    }
}
