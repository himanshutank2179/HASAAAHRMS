<?php

namespace app\helpers;

use app\models\Permissions;
use app\models\Projects;
use app\models\ProjectType;
use app\models\Services;
use yii;
use yii\helpers\ArrayHelper;
use app\models\Users;


class AppHelper
{

    static public function getMonths()
    {

        $months = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July ',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        );

        return $months;
    }

    static public function getYears(){
        $years = array_combine(range(date("Y"), 2000), range(date("Y"), 2000));
        return $years;
    }

    static public function getProjectsList()
    {
        $model = Projects::find()->where(['is_deleted' => 0])->all();
        $list = ArrayHelper::map($model, 'project_id', 'name');
        return $list;
    }


    static public function getPermissionList($type, $isNew = 0)
    {
        $model = Permissions::find()->all();
        $list = ArrayHelper::map($model, 'permission_id', 'name');
        return $list;
    }

    static public function getUsersList()
    {

        $model = Users::find()->where(['is_deleted' => 0])->all();
        $list = ArrayHelper::map($model, 'user_id', 'first_name');
        return $list;
    }

    static public function getUserRoles()
    {

        $roles = Yii::$app->authmanager->getRoles();
        $list = ArrayHelper::map($roles, 'name', 'name');
        return $list;
    }


    static public function getProjectUsers()
    {

        $model = \app\models\Users::find()->where(['is_deleted' => 0])->all();
        $list = ArrayHelper::map($model, 'user_id', 'first_name');

        return $list;
    }

    static public function getSalaryUsersList()
    {

        $model = Users::find()
            ->leftJoin('salary', 'users.user_id=salary.user_id')
            ->where(['is_deleted' => 0])
            ->andWhere('salary.user_id IS NULL')
            ->all();
        $list = ArrayHelper::map($model, 'user_id', 'first_name');
        return $list;
    }

    static public function getProjectTypes()
    {

        $model = ProjectType::find()->all();
        $list = ArrayHelper::map($model, 'project_type_id', 'name');
        return $list;
    }

    static public function getServices()
    {

        $model = Services::find()->all();
        $list = ArrayHelper::map($model, 'service_id', 'name');
        return $list;
    }



//    static public function getRoles()
//    {
//        $model = \app\models\Roles::find()->where(['is_deleted' => 0])->all();
//        $list = ArrayHelper::map($model, 'role_id', 'name');
//        return $list;
//    }

    static public function getIndianCurrency($number)
    {
        //EXAMPLE
        //echo ucfirst(AppHelper::getIndianCurrency(6000));

        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
}
