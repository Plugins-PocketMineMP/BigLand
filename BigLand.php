<?php
/**
 * @name BigLand
 * @author alvin0319
 * @main alvin0319\BigLand
 * @version 1.0.0
 * @api 3.0.0
 */
declare(strict_types=1);
namespace alvin0319;

use pocketmine\block\BlockIds;
use pocketmine\block\Farmland;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Hoe;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

class BigLand extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onInteract(PlayerInteractEvent $event){
        $block = $event->getBlock();
        $item = $event->getItem();
        if($item instanceof Hoe){
            if($event->isCancelled()){
                return;
            }
            if($block->getId() === BlockIds::DIRT or $block->getId() === BlockIds::GRASS){
                for($x = $block->getX() - 1; $x <= $block->getX() + 1; $x++){
                    for($z = $block->getZ() - 1; $z <= $block->getZ() + 1; $z++){
                        if($block->getLevel()->getBlockAt($x, $block->getY(), $z)->getId() === BlockIds::DIRT or $block->getLevel()->getBlockAt($x, $block->getY(), $z)->getId() === BlockIds::GRASS){
                            $block->getLevel()->setBlock(new Vector3($x, $block->y, $z), new Farmland());
                        }
                    }
                }
            }
        }
    }
}
