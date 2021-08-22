<?php

namespace app\services;

use Yii;
use yii\base\ErrorException;
use yii\web\UploadedFile;

class FileUploadService
{
    /**
     * @param $model
     * @param $attribute string
     * @param $dirName string
     * @return false|string
     */
    public function uploadFile($model, string $attribute, string $dirName)
    {
        $uploadFile = UploadedFile::getInstance($model, $attribute);

        $safeFileName = $dirName . '/';
        $safeFileName .= strtolower(md5($uploadFile->getBaseName() . random_bytes(4)));
        $safeFileName .= '.' . $uploadFile->getExtension();

        try {
            $uploadFile->saveAs(Yii::getAlias('@fileUpload') . '/' . $safeFileName);
        } catch (ErrorException $e) {
            Yii::$app->session->setFlash('fileUploadError', $e->getMessage());
            return false;
        }

        return $safeFileName;
    }
}
