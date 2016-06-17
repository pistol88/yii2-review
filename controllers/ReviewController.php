<?php
namespace pistol88\review\controllers;

use yii;
use pistol88\review\models\tools\ReviewSearch;
use pistol88\review\models\Review;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use pistol88\review\events\ReviewEvent;

class ReviewController  extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				'only' => ['create', 'update', 'index', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ReviewSearch();
        $dataProvider = $searchModel->search(yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Review;

        if ($model->load(yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['review/update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdd()
    {
        $model = new Review(['scenario' => 'customer']);
        $model->active = 'no';
        $model->date = date('Y-m-d H:i:s');
        $model->user_id = yii::$app->user->id;
        
        if ($model->load(yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('reviewOnModerate', 'Спасибо за отзыв! Он появится сразу после проверки.');
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            \Yii::$app->session->setFlash('reviewAddFail', 'Не удалось проверить отзыв. Проверьте, все ли данные заполнены корректно.');
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
    
    public function actionCustomerCreate()
    {
        $model = new Review(['scenario' => 'customer']);

        if ($model->load(yii::$app->request->post())) {
            $model->date = date('Y-m-d');
            $model->time = date('H:i:s');
            $model->timestamp = time();
            $model->status = $this->module->defaultStatus;
            $model->payment = 'no';
            $model->user_id = yii::$app->user->id;

            if($model->save()) {
                yii::$app->session->setFlash('reviewSuccess', 'Спасибо! Ваш отзыв отобразится после модерации.');
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                yii::$app->session->setFlash('reviewError', 'Ошибка (проверьте обязательные поля)');
                return $this->redirect(yii::$app->request->referrer);
            }
        } else {
            yii::$app->session->setFlash('reviewError', 'Ошибка (проверьте обязательные поля)');
            return $this->redirect(yii::$app->request->referrer);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    protected function findModel($id)
    {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested review does not exist.');
        }
    }
}
