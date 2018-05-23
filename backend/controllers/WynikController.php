<?php

namespace backend\controllers;

use Yii;
use backend\models\Wynik;
use backend\models\WynikSearch;
use backend\models\Konto;
use backend\models\zestaw;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * WynikController implements the CRUD actions for Wynik model.
 */
class WynikController extends Controller
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
     * Lists all Wynik models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$searchModel = new WynikSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Displays a single Wynik model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Creates a new Wynik model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = new Wynik();
        $konto = Konto::find()
        -> orderby('Login')
        -> all();
        $konto = ArrayHelper::map($konto,'id','login');
        $zestaw = Zestaw::find()
        -> orderby('Nazwa')
        -> all();
        $zestaw = ArrayHelper::map($zestaw,'id','nazwa');
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'konto' => $konto,
            	'zestaw' => $zestaw,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Updates an existing Wynik model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = $this->findModel($id);
        $konto = Konto::find()
        -> orderby('Login')
        -> all();
        $konto = ArrayHelper::map($konto,'id','login');
        $zestaw = Zestaw::find()
        -> orderby('Nazwa')
        -> all();
        $zestaw = ArrayHelper::map($zestaw,'id','nazwa');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'konto' => $konto,
            	'zestaw' => $zestaw,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Deletes an existing Wynik model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$this->findModel($id)->delete();

        return $this->redirect(['index']);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Finds the Wynik model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Wynik the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wynik::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
