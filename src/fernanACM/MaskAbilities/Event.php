<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\MaskAbilities;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\StringToEffectParser;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;

use pocketmine\event\player\PlayerMoveEvent;

class Event implements Listener{

    /**
     * @param PlayerMoveEvent $event
     * @return void
     */
    public function onMove(PlayerMoveEvent $event): void{
        $player = $event->getPlayer();
        $item = $player->getArmorInventory()->getHelmet();
        $config = Loader::getInstance()->config;
        if($item->getNamedTag()->getTag("Mask") !== null){
            $tag = $item->getNamedTag()->getString("Mask");
            switch($tag){
                case "Steve":
                    $potionEffects = $config->getNested("Potions.steve");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Creeper":
                    $potionEffects = $config->getNested("Potions.creeper");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Dragon":
                    $potionEffects = $config->getNested("Potions.dragon");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Skeleton":
                    $potionEffects = $config->getNested("Potions.skeleton");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Zombie":
                    $potionEffects = $config->getNested("Potions.zombie");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Wither":
                    $potionEffects = $config->getNested("Potions.wither");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;

                case "Gears":
                    $potionEffects = $config->getNested("Potions.gears");
                    foreach($potionEffects as $potionLine){
                        $potion = explode(":", $potionLine);
                        $potionId = $potion[0];
                        $potionDuration = 5;
                        $potionLevel = $potion[1];

                        $potionString = StringToEffectParser::getInstance()->parse($potionId);
                        if($potionString !== null){
                            $potionInstance = new EffectInstance($potionString, $potionDuration * 20, $potionLevel ?? 1, false, false, null);
                            $player->getEffects()->add($potionInstance);
                        }
                    }
                break;
            }
        }
    }

    /**
     * @param BlockPlaceEvent $event
     * @return void
     */
    public function onPlace(BlockPlaceEvent $event): void{
        $player = $event->getPlayer();
        $mob = $player->getInventory()->getItemInHand();
        if($mob->getNamedTag()->getTag("Mask") !== null){
            $tag = $mob->getNamedTag()->getString("Mask");
            switch($tag){
                case "Steve":
                    $event->cancel();
                break;

                case "Creeper":
                    $event->cancel();
                break;

                case "Dragon":
                    $event->cancel();
                break;

                case "Skeleton":
                    $event->cancel();
                break;

                case "Zombie":
                    $event->cancel();
                break;

                case "Wither":
                    $event->cancel();
                break;
            }
        }
    }
}