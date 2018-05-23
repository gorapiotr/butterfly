<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Podkategoria;
use frontend\models\PodkategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Kategoria;
use yii\helpers\ArrayHelper;

/**
 * PodkategoriaController implements the CRUD actions for Podkategoria model.
 */
class PodkategoriaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Podkategoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PodkategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Podkategoria model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Podkategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($bckategoria_id='')
    {
        $model = new Podkategoria();
        $kategoria = Kategoria::find()
        -> orderby('Nazwa')
        -> all();
        $kategoria = ArrayHelper::map($kategoria,'id','nazwa');
        $archiwum = ['0'=>'Nie','1'=>'Tak'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'kategoria' => $kategoria,
            	'bckategoria_id' => $bckategoria_id,
            		'archiwum' => $archiwum,
            ]);
        }
    }

    /**
     * Updates an existing Podkategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $kategoria = Kategoria::find()
        -> orderby('Nazwa')
        -> all();
        $kategoria = ArrayHelper::map($kategoria,'id','nazwa');
        $archiwum = ['0'=>'Nie','1'=>'Tak'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'kategoria' => $kategoria,
            		'archiwum' => $archiwum,
            ]);
        }
    }

    /**
     * Deletes an existing Podkategoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Podkategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Podkategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Podkategoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
