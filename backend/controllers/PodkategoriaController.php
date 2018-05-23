<?php

namespace backend\controllers;

use Yii;
use backend\models\Podkategoria;
use backend\models\PodkategoriaSearch;
use backend\models\Kategoria;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$searchModel = new PodkategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Wyłączenie wyswietlania podkategorii prywatnych
        $dataProvider->query
        -> andwhere('podkategoria.id<>9');
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Displays a single Podkategoria model.
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
     * Creates a new Podkategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = new Podkategoria();
        $kategoria = Kategoria::find()
        -> where('kategoria.nazwa<>"Prywatne" and kategoria.id<>5')
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
            		'archiwum' => $archiwum,
            ]);
        }
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Updates an existing Podkategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	if (Yii::$app->user->identity->rola->nazwa=='Administrator')
    	{
    	$model = $this->findModel($id);
        $kategoria = Kategoria::find()
        -> where('kategoria.nazwa<>"Prywatne" and kategoria.id<>5')
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
    	} else echo 'Brak uprawnień.';
    }

    /**
     * Deletes an existing Podkategoria model.
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
