<?php

namespace app\lib;

class UserOperation{
    const RoleGuest='guest';
    const RoleAdmin='admin';
    const RoleUser='user';

    const RoleSeller='seller';

    public static function getRoleUser(){
        $result=self::RoleGuest;
        if (isset($_SESSION['user']['id'])&& isset($_SESSION['user']['is_admin'])){
            $result=self::RoleAdmin;
        } elseif (isset($_SESSION['user']['id'])){
            $result=self::RoleUser;
        }elseif (isset($_SESSION['user']['is_seller'])){
            $result=self::RoleSeller;
        }
        return $result;
    }
    public static function getMenuLinks(){
        $role=self::getRoleUser();
        if ($_SERVER["REQUEST_URI"] != '/main/index'){
            $list[]=[
                'title' => 'Main page',
                'link' => '/main/index'
            ];
        }
        if ($_SERVER['REQUEST_URI'] != '/user/profile'){
            $list[]=[
                'title'=>'My profile',
                'link'=>'/user/profile'
            ];
        }
        if ($_SERVER['REQUEST_URI'] != '/magazine/buyandsell'){
            $list[] = [
                'title' => 'Magazine',
                'link' => '/magazine/buyandsell'
            ];
        }


        $list[]=[
            'title'=>'Exit',
            'link'=>'/user/logout'
        ];
        return $list;
    }
}
