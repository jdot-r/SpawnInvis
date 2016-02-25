<?php
namespace SpawnInvis;

use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as Color;
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener  {

    public $Invis;
    
    public function onLoad() {
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Loaded!");
    }
    
    public function onEnable() {
        $this->Invis = false;
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
        if(strtolower($cmd->getName()) == "invis" ) {
            if($sender->hasPermission("invis.toggle") || $sender->getName() === "CONSOLE") {
                $this->Invis = !$this->Invis;
                if($this->Invis) {
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
        } else {
            return false;
        }
    }

    public function spawnCheck(PlayerMoveEvent $event) {
        $entity = $event->getPlayer();
        $v = new Vector3($entity->getLevel()->getSpawnLocation()->getX(),$entity->getPosition()->getY(),$entity->getLevel()->getSpawnLocation()->getZ());
        $r = $this->getServer()->getSpawnRadius();
        if(($entity->getPosition()->distance($v) <= $r) && ($this->Invis == true)) {
            $entity->getEffect(14);
            return;
        }elseif(($entity->getPosition()->distance($v) > $r) && ($this->Invis == true)) {
            $entity->removeEffect(14);
            return;
        }
    }
    
    public function onDisable() {
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Disabled!");
    }
}
