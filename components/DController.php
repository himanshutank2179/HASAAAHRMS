<?php
/**
 * Created by PhpStorm.
 * User: himanshu
 * Date: 8/12/2017
 * Time: 12:03 AM
 */

namespace app\components;


use yii\web\Controller;

class DController extends Controller
{
    public function init(){
        parent::init();

    }
    public static function dd($data)
    {
        print_r($data);
        exit();
    }

}