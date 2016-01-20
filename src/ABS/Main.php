<?php

namespace ABS;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocektmine\event\entity\EntityShootBowEvent as Bow;

class main extends PluginBase implements Listener{
	public $shooter = array();
	
	public function onEnable(){
		$this->getLogger()->info("Enabled Plugin!");
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		@mkdir($this->getDataFolder());
		$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML, array("Time" => 5));
		}
		
		public function onBowShoot(Bow $ev){
		$p = $ev->getPlayer();
		if(in_array($p->getName(), $this->shooter)){
			$ev->setCancelled();
			$p->sendMessage("You cant shoot a bow at the moment!");
			return;
		}
		array_push($this->shooter, $p->getName());
		 	$task = new Task($this, $p);
		 	$this->getServer()->getScheduler()->scheduleDelayedTask($task, 20*$this->config->get("Time"));
		}
		}
