<?php
namespace Manager;

use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as Color;
use pocketmine\event\entity\EntityDamageEvent;

class Main extends pluginBase implements Listener  {

    public $players = [];

    public function onEnable() {
        $this->Invis = true;
        $this->pInvis = true;
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function isInvis($entity){
        if() {
            return true;
        }else{
            return false;
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
        if(strtolower($cmd->getName()) == "invis" ) {
            if($sender->isOp()) {
                $this->Invis = !$this->Invis;
                if($this->inSpawn($sender->getName())) {
                    $sender->sendMessage("[SpawnInvis] Spawn Invisability enabled!");
                    $this->getLogger()->info(Color::YELLOW . "Spawn Invisability enabled!");
                } else {
                    $sender->sendMessage("[SpawnInvis] Spawn Invisability disabled!");
                    $this->getLogger()->info(Color::YELLOW . "Spawn Invisability disabled!");
                }
            } else {
                $sender->sendMessage("You do not have permission to toggle spawn Invisability.");
            }
            return true;
        } elseif(strtolower($cmd->getName()) == "pinvis" ) {
            if($this->isInvis($sender->getname())) {

            }
            return true;
        } else {
            return false;
        }
    }

    public function inSpawn($entity){
        $v = new Vector3($entity->getLevel()->getSpawnLocation()->getX(),$entity->getPosition()->getY(),$entity->getLevel()->getSpawnLocation()->getZ());
        $r = $this->getServer()->getSpawnRadius();

    }

    public function temp() {

    }
}