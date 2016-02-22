<?php
namespace SpawnInvis;
//SpawnInvis v1.0.0
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as Color;
use pocketmine\Player;
use pocketmine\event\Listener;

class Main extends PluginBase {
  public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
  
  public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    if (strtolower($cmd->getName()) === "invis") {
      if($sender->isOP()){
      
      }
    }elseif (strtolower($cmd->getName()) === "pinvis"){
    
    }else{
    return false;
    }
  }

}
