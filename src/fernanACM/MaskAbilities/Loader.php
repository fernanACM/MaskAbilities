<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\MaskAbilities;

use Closure;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\block\VanillaBlocks;
use pocketmine\block\utils\MobHeadType;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;

use fernanACM\MaskAbilities\utils\BlockUtils;

class Loader extends PluginBase{

    /** @var Loader $instance */
    private static Loader $instance;

    /** @var Config $config */
    public Config $config;

    public const PREFIX = "§l[§bMask§f]§8»§r ";
    public const NO_PERMISSION = "§c¡No tienes permisos para esto!";
    public const INV_FULL = "§c¡Tu inventario esta lleno!";

    /**
     * @return void
     */
    public function onLoad(): void{
        self::$instance = $this;
    }
    /**
     * @return void
     */
    public function onEnable(): void{
        $this->saveResource("config.yml");
        $this->config = new Config($this->getDataFolder(). "config.yml");
        Server::getInstance()->getPluginManager()->registerEvents(new Event($this), $this);
    }

    /**
     * @param CommandSender $sender
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return bool
     */
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool{
        switch($command->getName()){
            case "maskabilities":
                if($sender instanceof Player){
                    $this->getMask($sender);
                }else{
                    $sender->sendMessage("Usa esto en el juego!");
                }
            break;
        }
        return true;
    }

    /**
     * @param Player $player
     * @return void
     */
    public function getMask(Player $player): void{
        $menu = InvMenu::create(InvMenuTypeIds::TYPE_CHEST);
        $inv = $menu->getInventory();
        $menu->setListener(Closure::fromCallable([$this, "getActionMask"]));
        $config = $this->config;
        $menu->setName("MaskAbilities");

        for($i = 0; $i < 27; $i++){
            if(!in_array($i, [])){
                $inv->setItem($i, VanillaBlocks::IRON_BARS()->asItem()->setCustomName("§r"));
            }
        }

        $steveLore = (array)$config->get(BlockUtils::STEVE_LORE);
        $creeperLore = (array)$config->get(BlockUtils::CREEPER_LORE);
        $dragonLore = (array)$config->get(BlockUtils::DRAGON_LORE);
        $gearsLore = (array)$config->get(BlockUtils::GEARS_LORE);
        $skeletonLore = (array)$config->get(BlockUtils::SKELETON_LORE);
        $zombieLore = (array)$config->get(BlockUtils::ZOMBIE_LORE);
        $witherLore = (array)$config->get(BlockUtils::WITHER_LORE);

        $inv->setItem(10, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem()->setCustomName($config->get(BlockUtils::STEVE))->setLore($steveLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(11, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::CREEPER())->asItem()->setCustomName($config->get(BlockUtils::CREEPER))->setLore($creeperLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(12, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::DRAGON())->asItem()->setCustomName($config->get(BlockUtils::DRAGON))->setLore($dragonLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(13, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PIGLIN())->asItem()->setCustomName($config->get(BlockUtils::GEARS))->setLore($gearsLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(14, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::SKELETON())->asItem()->setCustomName($config->get(BlockUtils::SKELETON))->setLore($skeletonLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(15, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::ZOMBIE())->asItem()->setCustomName($config->get(BlockUtils::ZOMBIE))->setLore($zombieLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));
        $inv->setItem(16, VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::WITHER_SKELETON())->asItem()->setCustomName($config->get(BlockUtils::WITHER))->setLore($witherLore)->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())));

        $inv->setItem(22, VanillaBlocks::BARRIER()->asItem()->setCustomName("§r§l§cSALIR"));
        $menu->send($player);
    }

    /**
     * @param InvMenuTransaction $transaction
     * @return InvMenuTransactionResult
     */
    public function getActionMask(InvMenuTransaction $transaction): InvMenuTransactionResult{
        $player = $transaction->getPlayer();
        $action = $transaction->getAction();
        switch($action->getSlot()){
            case 10:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getSteve());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 11:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getCreeper());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 13:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getGears());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 12:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getDragon());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 14:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getSkeleton());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 15:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getZombie());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 16:
                if($player->hasPermission("mask.admin")){
                    if($player->getInventory()->canAddItem($transaction->getItemClicked())){
                        $player->getInventory()->addItem(BlockUtils::getWither());
                    }else{
                        $player->sendMessage(self::PREFIX. self::INV_FULL);
                    }
                }else{
                    $player->sendMessage(self::PREFIX. self::NO_PERMISSION);
                }
            break;

            case 22:
                $player->removeCurrentWindow();
            break;
        }
        return $transaction->discard();
    }

    /**
     * @return Loader
     */
    public static function getInstance(): Loader{
        return self::$instance;
    }
}