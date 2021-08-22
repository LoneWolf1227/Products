<?php

namespace app\controllers;

use app\models\Products;
use app\services\FileUploadService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
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
    public function actions(): array
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

    /**
     * @param FileUploadService $fileUploadService
     * @param Products $model
     * @return string
     */
    public function actionAdd(FileUploadService $fileUploadService, Products $model): string
    {
        if ($model->load(Yii::$app->request->post())) {
            $model->picture_name = $fileUploadService->uploadFile($model, 'picture_name', 'products');

            if ($model->picture_name !== false && $model->save()) {
                Yii::$app->session->setFlash('products');
            } else {
                Yii::$app->session->setFlash('products', 'Error while adding product');
            }
        }

        return $this->render('add', ['model' => $model]);
    }

    /**
     * @param Products $model
     * @return Response
     */
    public function actionDelete(Products $model): Response
    {
        if ($ids = Yii::$app->request->post()['ids']) {
            $model->deleteProducts($ids);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param FileUploadService $fileUploadService
     * @param Products $model
     * @return string
     */
    public function actionUpdate(FileUploadService $fileUploadService, Products $model): string
    {
        //TODO Не изменить фото если не отправлена новая
        $id = YII::$app->request->get('id');

        if (isset($id) && !empty($id)) {
            $model = $model->getById($id);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->picture_name = $fileUploadService->uploadFile($model, 'picture_name', 'products');

            if ($model->picture_name !== false && $model->save()) {
                Yii::$app->session->setFlash('products');
            } else {
                Yii::$app->session->setFlash('products', 'Error while updating product');
            }
        }

        return $this->render('update', ['model' => $model]);
    }

}
