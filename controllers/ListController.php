<?php

namespace app\controllers;

use app\models\Products;
use app\models\SearchForm;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;

class ListController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        //TODO Исправить получение запроса на поиск и запроса выбранных колонок
        $model = new SearchForm();
        if ($model->load(Yii::$app->request->get(), '') && $model->validate()) {
            $q = Html::encode($model->q);
            return $this->redirect(Yii::$app->urlManager->createUrl(['list/search', 'q' => $q]));
        }
        return true;
    }

    public function actionSearch()
    {
        return $this->render('show');
    }

    public function actionShow()
    {
        $model = new Products();

        return $this->render('show', $model->getProducts());
    }

}
