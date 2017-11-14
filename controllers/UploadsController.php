<?php

namespace app\controllers;

use Yii;
use yii\web\UploadedFile;
use app\models\Users;

class UploadsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionIdentityUpload()
    {

        $model = new Users();

        $model->images = \yii\web\UploadedFile::getInstance($model, 'images');

        $ext = explode(".", $model->images->name);
        $destName = time() . rand() . "." . end($ext);

        $model->images->saveAs('uploads/' . $destName);

//        $imageResize = Yii::$app->image->load('uploads/' . $destName);
//        $imageResize->resize(1200, 880);
//        $imageResize->save();

        echo json_encode(['status' => 200, 'image' => $destName]);
    }

    public function actionFiledelete()
    {

        $model = \app\models\Identity::findOne($_POST['key']);

        $oldimg = Yii::$app->basePath . '/web/uploads/' . $model->image;

        if (file_exists($oldimg)) {
            unlink($oldimg);
        }

        if ($model) {
            $model->delete();
        }

        echo json_encode(array());
    }

    public function actionCommon($attribute)
    {
        $imageFile = UploadedFile::getInstanceByName($attribute);
        $directory = \Yii::getAlias('@app/web/uploads') . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR;
        if ($imageFile) {

            $filetype = mime_content_type($imageFile->tempName);
            $allowed = array('image/png', 'image/jpeg', 'image/gif');
            //$allowed = array('gif', 'png', 'jpg', 'jpeg');
            if (!in_array(strtolower($filetype), $allowed)) {
                return json_encode(['files' => [
                    'error' => "File type not supported",
                ]
                ]);
            } else {
                $uid = uniqid(time(), true);
                $fileName = $uid . '.' . $imageFile->extension;
                $filePath = $directory . $fileName;
//                echo $filePath;
//                exit();
                if ($imageFile->saveAs($filePath)) {
                    $path = \yii\helpers\BaseUrl::home() . 'uploads/' . Yii::$app->session->id . DIRECTORY_SEPARATOR . $fileName;

//                    if ($imageFile->size >= 2097152) {
//
//                        list($width, $height) = getimagesize('uploads/' . $fileName);
//
//                        // $heightResize = 1150 * ($width / $height);
//
//                        $imageResize = Yii::$app->image->load('uploads/' . $fileName);
//                        $imageResize->resize(1200, 880);
//                        $imageResize->save();
//                    }

                    return json_encode([
                        'files' => [
                            'name' => $fileName,
                            //'size' => $imageFile->size,
                            "url" => $path,
                            "thumbnailUrl" => $path,
                            "deleteUrl" => 'image-delete?name=' . $fileName,
                            "deleteType" => "POST",
                            'error' => ""
                        ]
                    ]);
                }
            }
        }
        return '';
    }


}
