<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Attribute;
/**
 * SearchController implements the CRUD actions for Attribute model.
 */
class SearchController extends Controller
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
        $result = null;
        if ($this->request->get('search')) {
            $fio = trim($this->request->get('fio'));
            $fio_like = $this->request->get('fio_like');
            $result = Attribute::find()->select('id')->andWhere([$fio_like !== NULL ? 'ilike' : "=", 'attribute_name', $fio])->all();
        }
        
        return $this->render('index', [
            'result' => $result
        ]);
    }
}
