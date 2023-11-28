<?php

#      _       ____   __  __ 
#     / \     / ___| |  \/  |
#    / _ \   | |     | |\/| |
#   / ___ \  | |___  | |  | |
#  /_/   \_\  \____| |_|  |_|
# The creator of this plugin was fernanACM.
# https://github.com/fernanACM

namespace fernanACM\MaskAbilities\utils;

use fernanACM\MaskAbilities\Loader;
use pocketmine\block\utils\MobHeadType;
use pocketmine\block\VanillaBlocks;
use pocketmine\color\Color;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\nbt\tag\CompoundTag;

class BlockUtils{

    public const STEVE = "STEVE";
    public const STEVE_LORE = "STEVE_LORE";

    public const DRAGON = "DRAGON";
    public const DRAGON_LORE = "DRAGON_LORE";

    public const SKELETON = "SKELETON";
    public const SKELETON_LORE = "SKELETON_LORE";

    public const ZOMBIE = "ZOMBIE";
    public const ZOMBIE_LORE = "ZOMBIE_LORE";

    public const WITHER = "WITHER";
    public const WITHER_LORE = "WITHER_LORE";

    public const CREEPER = "CREEPER";
    public const CREEPER_LORE = "CREEPER_LORE";

    public const GEARS = "GEARS";
    public const GEARS_LORE = "GEARS_LORE";

    /**
     * @return Item
     */
    public static function getSteve(): Item{
        $config = Loader::getInstance()->config;
        $steveLore = (array)$config->get(BlockUtils::STEVE_LORE);
        $steve = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PLAYER())->asItem();
        $steve->setNamedTag(CompoundTag::create()->setString("Mask", "Steve"));
        $steve->setCustomName($config->get(self::STEVE));
        $steve->setLore($steveLore);
        $steve->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $steve;
    }

    /**
     * @return Item
     */
    public static function getCreeper(): Item {
        $config = Loader::getInstance()->config;
        $creeperLore = (array)$config->get(BlockUtils::CREEPER_LORE);
        $creeper = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::CREEPER())->asItem();
        $creeper->setNamedTag(CompoundTag::create()->setString("Mask", "Creeper"));
        $creeper->setCustomName($config->get(self::CREEPER));
        $creeper->setLore($creeperLore);
        $creeper->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $creeper;
    }

    /**
     * @return Item
     */
    public static function getDragon(): Item {
        $config = Loader::getInstance()->config;
        $dragonLore = (array)$config->get(BlockUtils::DRAGON_LORE);
        $dragon = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::DRAGON())->asItem();
        $dragon->setNamedTag(CompoundTag::create()->setString("Mask", "Dragon"));
        $dragon->setCustomName($config->get(self::DRAGON));
        $dragon->setLore($dragonLore);
        $dragon->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $dragon;
    }

    /**
     * @return Item
     */
    public static function getSkeleton(): Item {
        $config = Loader::getInstance()->config;
        $skeletonLore = (array)$config->get(BlockUtils::SKELETON_LORE);
        $skeleton = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::SKELETON())->asItem();
        $skeleton->setNamedTag(CompoundTag::create()->setString("Mask", "Skeleton"));
        $skeleton->setCustomName($config->get(self::SKELETON));
        $skeleton->setLore($skeletonLore);
        $skeleton->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $skeleton;
    }

    /**
     * @return Item
     */
    public static function getZombie(): Item {
        $config = Loader::getInstance()->config;
        $zombieLore = (array)$config->get(BlockUtils::ZOMBIE_LORE);
        $zombie = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::ZOMBIE())->asItem();
        $zombie->setNamedTag(CompoundTag::create()->setString("Mask", "Zombie"));
        $zombie->setCustomName($config->get(self::ZOMBIE));
        $zombie->setLore($zombieLore);
        $zombie->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $zombie;
    }

    /**
     * @return Item
     */
    public static function getWither(): Item {
        $config = Loader::getInstance()->config;
        $witherLore = (array)$config->get(BlockUtils::WITHER_LORE);
        $wither = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::WITHER_SKELETON())->asItem();
        $wither->setNamedTag(CompoundTag::create()->setString("Mask", "Wither"));
        $wither->setCustomName($config->get(self::WITHER));
        $wither->setLore($witherLore);
        $wither->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $wither;
    }

    /**
     * @return Item
     */
    public static function getGears(): Item {
        $config = Loader::getInstance()->config;
        $gearsLore = (array)$config->get(BlockUtils::GEARS_LORE);
        $gears = VanillaBlocks::MOB_HEAD()->setMobHeadType(MobHeadType::PIGLIN())->asItem();
        $gears->setNamedTag(CompoundTag::create()->setString("Mask", "Gears"));
        $gears->setCustomName($config->get(self::GEARS));
        $gears->setLore($gearsLore);
        $gears->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING()));
        return $gears;
    }

}