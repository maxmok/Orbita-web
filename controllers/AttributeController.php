<?php

namespace app\controllers;
use Yii;
use app\models\Attribute;
use app\models\AttributeCategory;
use app\models\AttributeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;

/**
 * AttributeController implements the CRUD actions for Attribute model.
 */
class AttributeController extends Controller
{
     private function getUser() :?User {
        return Yii::$app->user->isGuest ? null : Yii::$app->user->identity->user;
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        $user = $this->getUser();    
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,                    
                    'rules' => [
                        [
                            //'actions' => ['index'],
                            'allow' => true,
                            'matchCallback' => function() use($user) {
                                return !Yii::$app->user->isGuest && $user->isAdmin;                                
                            },
                            'roles' => ['@'],
                        ],
                        [
                            'actions' => ['view'],
                            'allow' => true,
                            'matchCallback' => function() use($user) {
                                return !Yii::$app->user->isGuest;                                
                            },
                            'roles' => ['@'],
                        ],
                        [
                            'roles' => ['@'],
                            'allow' => false, 
                            'matchCallback' => function() use($user) {
                                return !$user->isAdmin;                                
                            },
                            'actions' => ['update', 'delete']
                        ]
                    ],
                ],
//                'verbs' => [
//                    'class' => VerbFilter::className(),
//                    'actions' => [
//                        'delete' => ['POST'],
//                    ],
//                ],
            ]
        );
    }

    /**
     * Lists all Attribute models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttributeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => AttributeCategory::getList(),
        ]);
    }

    /**
     * Displays a single Attribute model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'categories' => AttributeCategory::getList(),
        ]);
    }

    /**
     * Creates a new Attribute model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Attribute();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'categories' => AttributeCategory::getList(),
        ]);
    }

    /**
     * Updates an existing Attribute model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('form', [
            'model' => $model,
            'categories' => AttributeCategory::getList(),
        ]);
    }

    /**
     * Deletes an existing Attribute model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Attribute model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Attribute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attribute::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
