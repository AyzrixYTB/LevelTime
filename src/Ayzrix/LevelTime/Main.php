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
        $this->initWorlds();
    }

    public function initWorlds(): void {
        foreach (Utils::getIntoConfig("levels") as $level => $values) {
            $time = (int)$values["time"];
            $freeze = (bool)$values["freeze"];
            $this->getServer()->loadLevel($level);
            $level = $this->getServer()->getLevelByName($level);
            if ($level !== null) {
                $level->setTime($time);
                if ($freeze === true) {
                    $level->stopTime();
                }
            }
        }
    }

    /**
     * @return Main
     */
    public static function getInstance(): Main {
        return self::$instance;
    }
}
