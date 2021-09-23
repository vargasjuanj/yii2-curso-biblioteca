<?php

namespace backend\controllers;

use backend\models\Libro;
use backend\models\search\LibroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Yii;
use common\components\AccessRule;
use yii\filters\AccessControl;
use common\models\User;
use yii\base\ErrorException;
use yii\web\ServerErrorHttpException;

/**
 * LibroController implements the CRUD actions for Libro model.
 */
class LibroController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [

                    'class' => AccessControl::className(),

                    //Anulamos la configuración de reglas predeterminada con la clase AccessRule

                    'ruleConfig' => [

                        'class' => AccessRule::className(),

                    ],

                    'only' => ['create', 'update', 'delete'],

                    'rules' => [

                        [

                            'actions' => ['create'],

                            'allow' => true,

                            // Permito al ADMIN y SUPER  crear

                            'roles' => [

                                User::ROLE_ADMIN,

                                User::ROLE_SUPER

                            ],

                        ],

                        [

                            'actions' => ['update'],

                            'allow' => true,

                            // Permito al ADMIN y SUPER actualizar

                            'roles' => [

                                User::ROLE_ADMIN,

                                User::ROLE_SUPER

                            ],

                        ],

                        [

                            'actions' => ['delete'],

                            'allow' => true,

                            // Permito al SUPERUSUARIO eliminar

                            'roles' => [

                                User::ROLE_SUPER

                            ],

                        ],

                    ],

                ],


            ]
        );
    }

    /**
     * Lists all Libro models.
     * @return mixed
     */
    public function actionIndex()
    {

        // try {
        //     throw new ServerErrorHttpException('Error de código');
        // } catch (ServerErrorHttpException $ex) {
        //     Yii::error($ex->getMessage());
        //     throw new ServerErrorHttpException('Error en el servidor.');
        // }
        $searchModel = new LibroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libro model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Libro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Libro();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::info("Se dio de alta el libro: ". $model->id . "usaurio que lo cargó: " . Yii::$app->user->identity->username, "libros");
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Libro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::info("Se actualizó el libro: ". $model->id . "usaurio que lo modificó: " . Yii::$app->user->identity->username, "libros");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('success', 'Se eliminó el libro');
        \Yii::info("Se dio de baja el libro: ". $id . "usaurio que lo modificó: " . Yii::$app->user->identity->username, "libros");

        return $this->redirect(['index']);

    }

    /**
     * Finds the Libro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Libro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
