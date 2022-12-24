<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Value;
use app\models\Attribute;
use app\models\AttributeCategory;
use app\models\ValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ValueController implements the CRUD actions for Value model.
 */
class ValueController extends Controller
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
     * Lists all Value models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ValueSearch();
        $attributeCategoryModels = AttributeCategory::find()
                ->andWhere('id > 1')
                ->orderBy('id')               
                ->all();

        /** @var AttributeCategory $attributeCategoryModel */
        
        foreach($attributeCategoryModels as $key => &$attributeCategoryModel) {
            $query = $this->request->queryParams;
            $query['ValueSearch']['idCategory'] = $attributeCategoryModel->id;
        
            $dataProvider = $searchModel->search($query);
            
            if ($dataProvider->count > 0) {
                $attributeCategoryModel = [
                    'label' => $attributeCategoryModel->name,
                    'content' => $this->renderPartial('tab/view', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        //'fio' => $query['ValueSearch']['fio'],
                        //'attributes' => Attribute::getList($attributeCategoryModel->id),
                    ]),
                ];
            } else {
                unset($attributeCategoryModels[$key]);
            }
            
        }
        
        return $this->render('index', [
            'category' => $attributeCategoryModels,
            //'fio' => $query['ValueSearch']['fio'],
            //'attributes' => Attribute::getList(0),
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,            
        ]);
    }
   
    /**
     * Displays a single Value model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Value model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Value();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('form', [
            'model' => $model,
            'attributes' => Attribute::getList(0),
        ]);
    }

    /**
     * Updates an existing Value model.
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
            'attributes' => Attribute::getList(0),
        ]);
    }

    /**
     * Deletes an existing Value model.
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
     * Finds the Value model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Value the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Value::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
