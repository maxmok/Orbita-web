<?php

namespace app\controllers;

use Yii;
use app\models\Attribute;
use app\models\AttributeSearch;
use app\models\AttributeCategory;
use app\models\AttributeCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;


/**
 * AttributeCategoryController implements the CRUD actions for AttributeCategory model.
 */
class AttributeCategoryController extends Controller
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
                            'actions' => ['view', 'index'],
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
                // 'verbs' => [
                    // 'class' => VerbFilter::className(),
                    // 'actions' => [
                    //    'update' => ['POST'],
                    // ],
                // ],
            ]            
        );
    }

    /**
     * Lists all AttributeCategory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AttributeCategorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AttributeCategory model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'rightIndex' => $this->renderRightIndex($model)
        ]);
    }

    private function renderRightIndex(AttributeCategory $model) {
        $searchModel = new AttributeSearch();
        $searchModel->id_category = $model->id;
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->renderPartial('/attribute/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,   
            'categories' => AttributeCategory::getList(),
        ]);
    }

    /**
     * Creates a new AttributeCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AttributeCategory();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AttributeCategory model.
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
        ]);
    }

    /**
     * Deletes an existing AttributeCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {        
        $category = $this->findModel($id);
        if (count(Attribute::getList($id)) == 0) {
            $category->delete();
            return $this->redirect(['index']);
        } else {
            throw new NotFoundHttpException("Нельзя удалить категорию '$category->name', т.к. она не пустая!" );
        }
            
    }

    /**
     * Finds the AttributeCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AttributeCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AttributeCategory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }    
}
