<?php

namespace app\controllers;

use app\models\Products;
use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
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
    public function actionAdd()
    {
        $model = new Products();
        $message = '';

        if ($model->load(Yii::$app->request->post())){
            $uploadFile = UploadedFile::getInstance($model,'picture_name');

            $safeFileName = strtolower(md5( $uploadFile->getBaseName(). random_bytes(4)));
            $safeFileName .= '.'.$uploadFile->getExtension();
            $message = 'Success';
            try {
                $uploadFile->saveAs(Yii::getAlias('@productUpload').'/'.$safeFileName);
            } catch (ErrorException $e) {
                $message = $e->getMessage();
            }

            if ($message === 'Success') {
                $model->picture_name = $safeFileName;
                $model->save();
            }
        }

        return $this->render('add', ['model' => $model, 'message' => $message]);
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
