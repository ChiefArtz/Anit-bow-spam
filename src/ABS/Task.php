<?php
namespace ABS;

use pocketmine\scheduler\PluginTask;
use pocketmine\plugin\Plugin;
use pocketmine\Player;
class Task extends PluginTask{
	public $player;
	public function __construct(Plugin $owner, Player $player){
		parent::__construct($owner);
		$this->player = $player;
	}
	
	public function onRun($currentTick){
		if($this->player instanceof Player){
			if(in_array($this->player->getName(), $this->getOwner()->shooter)){
				$id = array_search($this->player->getName(), $this->getOwner()->shooter);
				unset($this->getOwner()->shooter[$id]);
			}
			
		}
	}
}
