<?php

namespace backend\controllers;

use Yii;
use backend\models\Uprawnienia;
use backend\models\UprawnieniaSearch;
use backend\models\Konto;
use backend\models\Podkategoria;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * UprawnieniaController implements the CRUD actions for Uprawnienia model.
 */
class UprawnieniaController extends Controller
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
     * Lists all Uprawnienia models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$searchModel = new UprawnieniaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Displays a single Uprawnienia model.
     * @param string $konto_id
     * @param string $podkategoria_id
     * @return mixed
     */
    public function actionView($konto_id, $podkategoria_id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	return $this->render('view', [
            'model' => $this->findModel($konto_id, $podkategoria_id),
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Creates a new Uprawnienia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = new Uprawnienia();
        $konto = Konto::find()
        -> orderby('Login')
        -> all();
        $konto = ArrayHelper::map($konto,'id','login');
        $podkategoria = Podkategoria::find()
        -> orderby('Nazwa')
        -> all();
        $podkategoria = ArrayHelper::map($podkategoria,'id','nazwa');
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'konto_id' => $model->konto_id, 'podkategoria_id' => $model->podkategoria_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'konto' => $konto,
            	'podkategoria' => $podkategoria,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Updates an existing Uprawnienia model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $konto_id
     * @param string $podkategoria_id
     * @return mixed
     */
    public function actionUpdate($konto_id, $podkategoria_id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = $this->findModel($konto_id, $podkategoria_id);
        $konto = Konto::find()
        -> orderby('Login')
        -> all();
        $konto = ArrayHelper::map($konto,'id','login');
        $podkategoria = Podkategoria::find()
        -> orderby('Nazwa')
        -> all();
        $podkategoria = ArrayHelper::map($podkategoria,'id','nazwa');
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'konto_id' => $model->konto_id, 'podkategoria_id' => $model->podkategoria_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'konto' => $konto,
            	'podkategoria' => $podkategoria,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Deletes an existing Uprawnienia model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $konto_id
     * @param string $podkategoria_id
     * @return mixed
     */
    public function actionDelete($konto_id, $podkategoria_id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = $this->findModel($konto_id, $podkategoria_id);
    	$model->archiwum='1';
    	if ( $model->save()) {
    		return $this->redirect(['index']);
    	}
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Finds the Uprawnienia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $konto_id
     * @param string $podkategoria_id
     * @return Uprawnienia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($konto_id, $podkategoria_id)
    {
        if (($model = Uprawnienia::findOne(['konto_id' => $konto_id, 'podkategoria_id' => $podkategoria_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
