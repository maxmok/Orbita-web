<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;
use app\models\Person;
use app\models\Organization;
use app\models\Project;
use app\models\SearchModel;
/**
 * SearchController implements the CRUD actions for Attribute model.
 */
class SearchController extends Controller
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
                                return !Yii::$app->user->isGuest;                                
                            },
                            'roles' => ['@'],
                        ]                       
                    ],
                ],
                // 'verbs' => [
                //     'class' => VerbFilter::className(),
                //     'actions' => [
                //         'delete' => ['POST'],
                //     ],
                // ],
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
        $searchModel = new SearchModel();
        $dataProvider = $searchModel->search($this->request->get());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bDays' => Person::getDays(),
            'bMonths' => Person::getMonths(),
            'bYears' => Person::getYears(),
            'ages' => Person::getAges(),            
            'inns' => Organization::getInnList(),
            'projects' => Project::getProjectList(),
        ]);       
    }

}
