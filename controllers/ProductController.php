<?php

namespace app\controllers;

use app\models\Products;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['add', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['add', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionAdd(): string
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post())){
            $uploadFile = UploadedFile::getInstance($model,'picture_name');

            $safeFileName = strtolower(md5( $uploadFile->getBaseName(). random_bytes(4)));
            $safeFileName .= '.'.$uploadFile->getExtension();

            try {
                $result = $uploadFile->saveAs(Yii::getAlias('@productUpload').'/'.$safeFileName);
            } catch (ErrorException $e) {
                $result = $e->getMessage();
            }

            $model->picture_name = $safeFileName;

            if ($result === true && $model->save()) {
                Yii::$app->session->setFlash('products');
            } else {
                Yii::$app->session->setFlash('products', $result);
            }
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionDelete(): Response
    {
        $model = new Products();
        if ($ids = Yii::$app->request->post()['ids']) {
            $model->deleteProducts($ids);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate(): string
    {
        return $this->render('update');
    }

}
