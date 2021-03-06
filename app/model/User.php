<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/17 0017
 * Time: 9:03
 */

namespace app\model;


use bases\BaseModel;

class User extends BaseModel
{
    /**
     * 获取所有用户信息
     * @return mixed
     */
    public static function getAllUser()
    {
        $res = self::with('vip')->field('id,nickname,headpic,points,web_auth_id,create_time')->select();
        foreach ($res as $k => $v) {
            if ($v['vip']) {
                unset($res[$k]['vip']);
                $res[$k]['vip'] = 1;
            } else {
                $res[$k]['vip'] = 0;
            }
        }
        return app('json')->success($res);
    }

    public function vip()
    {
        return $this->belongsTo('FxAgent', 'id', 'user_id');
    }
    public function getNicknameAttr($v)
    {
        return base64_decode($v);
    }
}