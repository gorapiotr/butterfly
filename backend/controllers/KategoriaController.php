<?php

namespace backend\controllers;

use Yii;
use backend\models\Kategoria;
use backend\models\KategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KategoriaController implements the CRUD actions for Kategoria model.
 */
class KategoriaController extends Controller
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
     * Lists all Kategoria models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
        $searchModel = new KategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Wyłączenie wyswietlania kategorii prywatnych
        $dataProvider->query
        -> andwhere('kategoria.nazwa<>"Prywatne" and kategoria.id<>5');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Displays a single Kategoria model.
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
     * Creates a new Kategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = new Kategoria();
    	$archiwum = ['0'=>'Nie','1'=>'Tak'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            		'archiwum' => $archiwum,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Updates an existing Kategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = $this->findModel($id);
    	$archiwum = ['0'=>'Nie','1'=>'Tak'];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            		'archiwum' => $archiwum,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Deletes an existing Kategoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    		$model = $this->findModel($id);
    		$model->archiwum='1';
    		if ( $model->save()) {
    			return $this->redirect(['index']);
    		}
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Finds the Kategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kategoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
