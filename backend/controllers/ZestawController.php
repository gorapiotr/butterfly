<?php

namespace backend\controllers;

use Yii;
use backend\models\Zestaw;
use backend\models\ZestawSearch;
use backend\models\Konto;
use backend\models\Jezyk;
use backend\models\Podkategoria;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ZestawController implements the CRUD actions for Zestaw model.
 */
class ZestawController extends Controller
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
     * Lists all Zestaw models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ZestawSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Pokazuje tylko zestawy użytkownika, chyba że jest administratorem
        if (Yii::$app->user->identity->rola->nazwa=='SuperRedaktor')
        {
        	// Widzi zestawy wszystkich użytkowników z podkategorii, ale nie widzi prywatnych zestawów
        	$dataProvider->query
        	-> joinWith('uprawnienia')
        	-> andFilterwhere(['or',['uprawnienia.konto_id' => Yii::$app->user->getid()], ['and',['zestaw.podkategoria_id' => 9],['zestaw.konto_id' => Yii::$app->user->getid()]]])
        	-> andwhere(['archiwum'=>0]);
        } elseif (Yii::$app->user->identity->rola->nazwa!=='Administrator')
        {
        	// Wszyscy oprócz administratora widzą przydzielone podkategorie lub swoje prywatne zestawy
        	$dataProvider->query
        	-> joinWith('uprawnienia')
        	-> andFilterwhere(['or',['uprawnienia.konto_id' => Yii::$app->user->getid()], ['zestaw.podkategoria_id' => 9]])
        	-> andFilterwhere(['zestaw.konto_id' => Yii::$app->user->getid()])
        	-> andwhere(['archiwum'=>0]);
        	//-> andwhere(['zestaw.konto_id' => Yii::$app->user->getid()]);
        } 
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Zestaw model.
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
     * Creates a new Zestaw model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zestaw();
        if (Yii::$app->user->identity->rola->nazwa=='Administrator')
        {
        	$konto = Konto::find()
        	-> orderby('Login')
        	-> all();
        } else
        {
        	$konto = Konto::find()
        	-> where(['id' => Yii::$app->user->getid()])
        	-> all();
        }
        $konto = ArrayHelper::map($konto,'id','login');
        $jezyk1 = Jezyk::find()
        -> orderby('nazwa')
        -> all();
        $jezyk1 = ArrayHelper::map($jezyk1,'id','nazwa');
        $jezyk2 = Jezyk::find()
        -> orderby('nazwa')
        -> all();
        $jezyk2 = ArrayHelper::map($jezyk2,'id','nazwa');
        $archiwum = ['0'=>'Nie','1'=>'Tak'];

        if (Yii::$app->user->identity->rola->nazwa=='Administrator')
        {
        	$podkategoria = Podkategoria::find()
        	-> orderby('Nazwa')
        	-> all();
        	
        } else
        {
        	$podkategoria = Podkategoria::find()
        	-> joinWith('uprawnienias')
        	-> where(['konto_id' => Yii::$app->user->getid()])
        	-> orwhere('podkategoria.id=9') // Podkategoria prywatna
        	-> orderby('Nazwa')
        	-> all();
        }
        
        $podkategoria = ArrayHelper::map($podkategoria,'id','nazwa');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'konto' => $konto,
            	'jezyk1' => $jezyk1,
            	'jezyk2' => $jezyk2,
            	'podkategoria' => $podkategoria,
            		'archiwum' => $archiwum,
            ]);
        }
    }

    /**
     * Updates an existing Zestaw model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->rola->nazwa=='Administrator')
        {
        	$konto = Konto::find()
        	-> orderby('Login')
        	-> all();
        } else 
        {
        $konto = Konto::find()
        //-> where(['id' => Yii::$app->user->getid()])
        -> orderby('Login')
        -> all();
        }
        $konto = ArrayHelper::map($konto,'id','login');
        $jezyk1 = Jezyk::find()
        -> orderby('nazwa')
        -> all();
        $jezyk1 = ArrayHelper::map($jezyk1,'id','nazwa');
        $jezyk2 = Jezyk::find()
        -> orderby('nazwa')
        -> all();
        $jezyk2 = ArrayHelper::map($jezyk2,'id','nazwa');
        $archiwum = ['0'=>'Nie','1'=>'Tak'];
        
        if (Yii::$app->user->identity->rola->nazwa=='Administrator')
        {
        	$podkategoria = Podkategoria::find()
        	-> orderby('Nazwa')
        	-> all();
        	
        } else
        {
        	$podkategoria = Podkategoria::find()
        	-> joinWith('uprawnienias')
        	-> where(['konto_id' => Yii::$app->user->getid()])
        	-> orwhere('podkategoria.id=9') // Podkategoria prywatna
        	-> orderby('Nazwa')
        	-> all();
        }
        
        $podkategoria = ArrayHelper::map($podkategoria,'id','nazwa');
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'konto' => $konto,
            	'jezyk1' => $jezyk1,
            	'jezyk2' => $jezyk2,
            	'podkategoria' => $podkategoria,
            		'archiwum' => $archiwum,
            ]);
        }
    }

    /**
     * Deletes an existing Zestaw model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$model = $this->findModel($id);
    	$model->archiwum='1';
    	if ( $model->save()) {
    		return $this->redirect(['index']);
    	}
    }

    /**
     * Finds the Zestaw model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Zestaw the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zestaw::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
