<?php

namespace Qlurk\Data;

use Qlurk\APP;

class User
{
    protected $id;
    protected $nick_name;
    protected $display_name;
    protected $premium;
    protected $has_profile_image;
    protected $avatar;
    protected $location;
    protected $default_lang;
    protected $dateOfBirth;
    protected $bdayPrivary;
    protected $fullName;
    protected $gender;
    protected $karma;
    protected $recruited;
    protected $relationship;

    private $app;

    public function __construct($data, APP $app)
    {
        foreach ($data as $key => $val) {
            $this->$key = $val;
        }

        $this->app = $app;
    }

    public static function makeArray($array, APP $app)
    {
        $rows = [];
        foreach ($array as $row) {
            $rows[$row['id']] = new User($row, $app);
        }

        return $rows;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @param array $params
     * @return \Qlurk\Data\Plurk[]
     */
    public function publicPlurks($params = [])
    {
        $params['user_id'] = $this->id;
        return $this->app->timeline->getPublicPlurks($params)['plurks'];
    }
}
