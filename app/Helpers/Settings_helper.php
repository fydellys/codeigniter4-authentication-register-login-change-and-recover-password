<?php

function Settings($key)
{

    if (!empty($key)) {

        $db = \Config\Database::connect();
        $settingsInfo = $db->table('settings')->select('value')->where('key', $key)->get()->getResult();

        foreach ($settingsInfo as $info) {
            return $info->value;
        }
    }

}
