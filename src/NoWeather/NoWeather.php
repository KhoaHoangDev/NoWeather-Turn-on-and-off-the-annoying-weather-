<?php
/**
 * Created by PhpStorm.
 * User: khoan
 * Date: 4/22/2016
 * Time: 12:21 PM
 */

namespace NoWeather;


use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as Color;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class NoWeather extends PluginBase implements Listener
{

    public function onLoad()
    {
        $this->getLogger()->info(Color::RED . "Get ready to loading...");
    }

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->notice(Color::GREEN . "NoWeather Enabled! Made by KhoaHoang.");
        $this->getLogger()->info(Color::LIGHT_PURPLE . "Plugin on ImagicalMine!");
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args)
    {
        if(count($args) > 1){
            $sec = (int) $args[1];
        }else{
            $sec = 600*20;
        }

        if (strtolower($command->getName()) == "weatherswitch") {
            if ($sender instanceof Player) {
                $level = $sender->getLevel();
                if ($sender->hasPermission("noweather.weather.switch")) {
                    if (isset($args[0])) {
                        if (strtolower($args[0]) == "off") {
                            $level->setRaining(false);
                            $level->setThundering(false);
                            $level->setRainTime($sec * 0);
                            $level->setThunderTime($sec * 0);
                            $sender->sendMessage(Color::GREEN . "Weather turned off!");
                        }elseif (strtolower($args[0]) == "on"){
                            $level->setRainTime($sec * 20);
                            $level->setThunderTime($sec * 20);
                            $sender->sendMessage(Color::GREEN . "Weather turned on!");
                        }else{
                            $sender->sendMessage(Color::RED . "Usage: /weatherswitch <on/off>");
                        }
                    }else{
                        $sender->sendMessage(Color::RED . "Usage: /weatherswitch <on/off>");
                    }
                }
            }else{
                $sender->sendMessage(Color::RED . "You need to be a player to peform this command!");
            }
        }
    }

    public function onDisable()
    {
        $this->getLogger()->info(Color::RED . "NoWeather disabled! :)");
    }
}