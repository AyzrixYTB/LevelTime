<?php

namespace Ayzrix\LevelTime;

use Ayzrix\LevelTime\Utils\Utils;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase {


    /** @var Main $instance */
    private static $instance = null;

    public function onEnable() {
        self::$instance = $this;
        $this->saveDefaultConfig();
        $count = 0;
        foreach (Utils::getIntoConfig("levels") as $level => $values) {
            $time = (int)$values["time"];
            $freeze = (bool)$values["freeze"];
            $this->getServer()->loadLevel($level);
            $level = $this->getServer()->getLevelByName($level);
            if ($level !== null) {
                $level->setTime($time);
                $count++;
                if ($freeze === true) $level->stopTime();
            }
        }
        $this->getLogger()->notice("Time of {$count} level(s) successfully changed.");
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main {
        return self::$instance;
    }
}