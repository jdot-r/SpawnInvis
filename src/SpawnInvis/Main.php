<?php
namespace SpawnInvis;

use pocketmine\math\Vector3;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat as Color;
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener  {

    public $Invis;
    public $sender;
    public function onLoad()
    {
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Loaded!");
    }

    public function onEnable() {
        $this->Invis = false;
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
        if(strtolower($cmd->getName()) == "invis" ) {
            if(($sender->hasPermission("invis.toggle") or $sender->getName() === "CONSOLE") or $sender->isOp()) {
                $this->Invis = !$this->Invis;
                if($this->Invis) {
                    $this->getLogger()->info(Color::GOLD . "Spawn Invisibility enabled!");
                } else {
                    $this->getLogger()->info(Color::GOLD . "Spawn Invisibility disabled!");
                }
            } else {
                $sender->sendMessage(Color::DARK_RED."You do not have permission to toggle spawn Invisibility.");
            }
            return true;
        } else {
            return false;
        }
    }

    public function invisibility(PlayerMoveEvent $event) {
        $entity=$event->getPlayer();
        $v = new Vector3($entity->getLevel()->getSpawnLocation()->getX(),$entity->getPosition()->getY(),$entity->getLevel()->getSpawnLocation()->getZ());
        $r = $this->getServer()->getSpawnRadius();
        if($this->Invis) {
            if(($entity->getPosition()->distance($v) <= $r) && ($this->Invis == true)) {
                $effect = Effect::getEffect(14);
                if($effect) $entity->addEffect($effect->setDuration(9999)->setAmplifier(1)->setVisible(false));
                return true;
            }elseif(($entity->getPosition()->distance($v) > $r) && ($this->Invis == true)) {
                $entity->removeEffect(14);
                return false;
            }
        }

    }

    public function onDisable() {
        $this->getLogger()->info(Color::BOLD.Color::GREEN."[SpawnInvis] Disabled!");
    }
}