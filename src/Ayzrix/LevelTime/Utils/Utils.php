<?php

namespace Ayzrix\LevelTime\Utils;

use Ayzrix\LevelTime\Main;

class Utils {

    /**
     * @param string $value
     * @return bool|array
     */
    public static function getIntoConfig(string $value) {
        $config = Main::getInstance()->getConfig();
        return $config->get($value);
    }
}