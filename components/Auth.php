<?php

namespace app\components;

use Yii;
use app\models\Permissions;

class Auth
{
    public $super_admin_menu = [
        'Dashboard',
        '/dashboard/index',
        'SuperAdmin',
        '/users/index',
        '/users/create',
        'Projects',
        '/projects/index',
        '/projects/create',
        'Notifications',
        '/notifications/index',
        '/notifications/create',
        'Roles',
        '/notifications/index',
        '/notifications/create',

        //'/users/index?type=admins'
    ];


    public $admin_menu = [
        'Dashboard',
        '/dashboard/index',
        'SuperAdmin',
        '/users/index',
        '/users/create',
        'Projects',
        '/projects/index',
        '/projects/create',
        'Notifications',
        '/notifications/index',
        '/notifications/create',
        'Roles',
        '/notifications/index',
        '/notifications/create',

    ];

    public $user_menu = [
        'Dashboard',
        '/dashboard/index',
        'SuperAdmin',
        '/users/index',
        '/users/create',
        'Projects',
        '/projects/index',
        '/projects/create',
        'Notifications',
        '/notifications/index',
        '/notifications/create',
        'Roles',
        '/notifications/index',
        '/notifications/create',
    ];


    public function checkAccess($role, $menu = '', $controller = NULL)
    {
        if ($role == 'SUPER_ADMIN') {
            if (in_array($menu, $this->super_admin_menu)) {
                return true;
            } else {
                return false;
            }
        } elseif ($role == 1) {
            $uperm = $this->userPermission();
            //print_r($uperm); exit();
            if (in_array(strtolower($controller), $uperm) && in_array($menu, $this->admin_menu)) {
                return true;
            } else {
                return false;
            }
        } elseif ($role == 2) {
            $uperm = $this->userPermission();
            //print_r($uperm); exit();
            if (in_array(strtolower($controller), $uperm) && in_array($menu, $this->user_menu)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function userPermission()
    {
        $data = array();

        $permissionList = Yii::$app->session['_vytechUserPermission'];

        foreach ($permissionList as $perm) {
            $str = str_replace(' ', '-', $perm['name']);
            $strlor = strtolower($str);
            array_push($data, $strlor);
        }
        //$data[] = 'dashboard';
        // print_r($data); exit();
        //debugPrint($data);
        return $data;
    }

}
