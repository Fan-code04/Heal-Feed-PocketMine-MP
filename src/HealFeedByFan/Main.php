<?php

namespace HealFeedByFan; 

use pocketmine\utils\Config;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{ 

    public function onEnable(){
        $this->getLogger()->info("Plugin Heal-Feed activé avec succés");
       
        @mkdir($this->getDataFolder());
        $this->saveResource("config.yml");
        $this->message = new Config($this->getDataFolder() . "config.yml", Config::YAML);
    } 
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch ($command->getName()){
            case "heal":
                if ($sender instanceof Player){
                    if ($sender->hasPermission("heal.cmd")){
                        $sender->setHealth($sender->getMaxHealth());
                        $sender->sendMessage($this->message->get("succes-heal"));
                    } else{
                        $sender->sendMessage($this->message->get("error-heal"));
                    }
                } else{
                    $sender->sendMessage($this->message->get("on-console"));
                }
                break;
            case "feed":
                if ($sender instanceof Player){
                    if ($sender->hasPermission("feed.cmd")){
                        $sender->setFood($sender->getMaxFood());
                        $sender->sendMessage($this->message->get("succes-feed"));
                    } else{
                        $sender->sendMessage($this->message->get("error-feed"));
                    }
                } else{
                    $sender->sendMessage($this->message->get("on-console"));
                }
        }
        return true;
    }
}