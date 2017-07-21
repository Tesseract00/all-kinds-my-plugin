<?php



namespace nlog\NLOGLuckyBox;



use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\item\Item;

use onebone\economyapi\EconomyAPI;





class Main extends PluginBase implements Listener{

	

	public $prefix;



 	 public function onEnable(){

 	 	

    	$this->getServer()->getPluginManager()->registerEvents($this, $this);

    	$this->getLogger()->notice("럭키박스 플러그인");

    	$this->getLogger()->notice("Made by Tesserect(tesserect.kro.kr)");

    	

    	$this->prefix = "§l§f[ §cLuckyBox §f] §f";

    	

    	if ($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") === null) {

 	 		$this->getLogger()->alert("EconomyAPI 플러그인이 존재하지 않습니다. 플러그인을 비활성화합니다.");

 	 		$this->getPluginLoader()->disablePlugin($this);

 	 	}

 	 	

 	 }

 	 

 	 public function addItem ($player, $id, $count) {

 	 	$item = Item::fromString($id);

		$pl = $this->getServer()->getPlayerExact(strtolower($player));

 	 	$pl->getInventory()->addItem(new Item($item->getId(), $item->getDamage(), $count));

 	 }

 	 

 	 public function removeItem ($player, $id, $count) {

 	 	

 	 	$item = Item::fromString($id);

 	 	$pl = $this->getServer()->getPlayerExact(strtolower($player));

 	 	$pl->getInventory()->removeItem(new Item($item->getId(), $item->getDamage(), $count));

 	 }

 	 

 	 public function onTouch (PlayerInteractEvent $ev) {

 	 	

 	 	/**

 	 	 * 엔더포탈  120

 	 	 * 철블럭  42

 	 	 * 노트블럭  25

 	 	 * 

 	 	 * 가스트의눈물 (하) 370

 	 	 * 먹물주머니(잉크) (중) 351

 	 	 * 마그마크림 (상) 378

 	 	 * 

 	 	 * 좀비머리  397:2

 	 	 * 스켈레톤머리   397

 	 	 * 크리퍼머리  397:4

 	 	 * 위더머리  397:1

 	 	 * 거미의 눈  375

 	 	 * 슬라임볼  341

 	 	 * 

 	 	 * 네더의 별  399

 	 	 * 

 	 	 * 농사씨앗 [ 295,361,362,458 ]

 	 	 * 

 	 	 * 철곡괭이  257

 	 	 * 철검  267

 	 	 * 철삽  256

 	 	 * 철도끼  258

 	 	 * 철괭이  292

 	 	 * 

 	 	 * 철투구  306

 	 	 * 철갑옷  307

 	 	 * 철바지  308

 	 	 * 철신발  309

 	 	 */

 	 	

 	 	$block = $ev->getBlock();

 	 	$item = $ev->getItem();

 	 	$player = $ev->getPlayer();

 	 	$prefix = $this->prefix;

 	 	

 	 	if ($block->getId() === 25) {

 	 		

 	 		if ($item->getId() === 370) {

 	 			/**

 	 			 * 하급열쇠

 	 			 * 꽝  40%

 	 			 */

 	 			$cancel = mt_rand(1, 10);

 	 			

 	 			if ($cancel > 6) {

 	 				$player->sendMessage($prefix."하급 열쇠로 꽝에 당쳠되셨습니다.");

 	 				self::removeItem($player->getName(), 370, 1);

 	 				return;

 	 			}else{

 	 				

 	 				$random = mt_rand(1, 5);

 	 				

 	 				if ($random === 1) {

 	 					$money = mt_rand(1000, 10000);

 	 					$player->sendMessage($prefix."§a".$money."§f원을 획득하였습니다.");

 	 					EconomyAPI::getInstance()->addMoney($player->getName(), $money);

 	 					self::removeItem($player->getName(), 370, 1);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 2) {

 	 					$player->sendMessage($prefix."§a좀비 머리§f를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 370, 1);

 	 					self::addItem($player->getName(), "397:2", 1);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 3) {

 	 					$count = mt_rand(1, 3);

 	 					$player->sendMessage($prefix."§a네더의 별 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 370, 1);

 	 					self::addItem($player->getName(), 399, $count);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 4) {

 	 					$count = mt_rand(1, 5);

 	 					$player->sendMessage($prefix."§a하급열쇠 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 370, 1);

 	 					self::addItem($player->getName(), 370, $count);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 5) {

 	 					$count = mt_rand(1, 3);

 	 					$player->sendMessage($prefix."§a중급열쇠 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 370, 1);

 	 					self::addItem($player->getName(), 351, $count);

 	 					return;

 	 				}

 	 			}

 	 		}

 	 		

 	 		if ($item->getId() === 351){

				if ($item->getDamage() === 0) {

					/**

					 * 중급열쇠

					 * 꽝 30%

					 */

					$cancel = mt_rand(1, 10);

					

					if ($cancel > 7) {

						$player->sendMessage($prefix."중급 열쇠로 꽝에 당쳠되셨습니다.");

						self::removeItem($player->getName(), 351, 1);

						return;

					}else{

						

						$random = mt_rand(1, 7);

						

						if ($random === 1) {

							$money = mt_rand(10000, 50000);

							$player->sendMessage($prefix."§a".$money."§f원을 획득하였습니다.");

							EconomyAPI::getInstance()->addMoney($player->getName(), $money);

							self::removeItem($player->getName(), 351, 1);

							return;

						}

							

						if ($random === 2) {

							$player->sendMessage($prefix."§a스켈레톤 머리§f를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 397, 1);

							return;

						}

							

						if ($random === 3) {

							$count = mt_rand(5, 10);

							$player->sendMessage($prefix."§a네더의 별 §b{$count}§f개를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 399, $count);

							return;

						}

							

						if ($random === 4) {

							$count = mt_rand(5, 10);

							$player->sendMessage($prefix."§a하급열쇠 §b{$count}§f개를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 370, $count);

							return;

						}

							

						if ($random === 5) {

							$count = mt_rand(1, 5);

							$player->sendMessage($prefix."§a중급열쇠 §b{$count}§f개를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 351, $count);

							return;

						}

						

						if ($random === 6) {

							$count = mt_rand(3, 5);

							$player->sendMessage($prefix."§a거미 눈 §b{$count}§f개를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 375, $count);

							return;

						}

						

						if ($random === 7) {

							$count = mt_rand(1, 3);

							$player->sendMessage($prefix."§a상급열쇠 §b{$count}§f개를 획득하였습니다.");

							self::removeItem($player->getName(), 351, 1);

							self::addItem($player->getName(), 378, $count);

							return;

						}

 	 				}

 	 			}

 	 		}

 	 		

 	 		if ($item->getId() === 378) {

 	 			/**

 	 			 * 상급열쇠

 	 			 * 꽝 20%

 	 			 */

 	 			$cancel = mt_rand(1, 10);

 	 		

 	 			if ($cancel > 8) {

 	 				$player->sendMessage($prefix."상급 열쇠로 꽝에 당쳠되셨습니다.");

 	 				self::removeItem($player->getName(), 378, 1);

 	 				return;

 	 			}else{

 	 					

 	 				$random = mt_rand(1, 11);

 	 					

 	 				if ($random === 1) {

 	 					$money = mt_rand(30000, 100000);

 	 					$player->sendMessage($prefix."§a".$money."§f원을 획득하였습니다.");

 	 					EconomyAPI::getInstance()->addMoney($player->getName(), $money);

 	 					self::removeItem($player->getName(), 378, 1);

 	 					return;

 	 				}

 	 		

 	 				if ($random === 2) {

 	 					$player->sendMessage($prefix."§a크리퍼 머리§f를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), "397:4", 1);

 	 					return;

 	 				}

 	 		

 	 				if ($random === 3) {

 	 					$count = mt_rand(7, 10);

 	 					$player->sendMessage($prefix."§a네더의 별 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 399, $count);

 	 					return;

 	 				}

 	 		

 	 				if ($random === 4) {

 	 					$count = mt_rand(10, 15);

 	 					$player->sendMessage($prefix."§a하급열쇠 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 370, $count);

 	 					return;

 	 				}

 	 		

 	 				if ($random === 5) {

 	 					$count = mt_rand(5, 10);

 	 					$player->sendMessage($prefix."§a중급열쇠 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 351, $count);

 	 					return;

 	 				}

 	 					

 	 				if ($random === 6) {

 	 					$count = mt_rand(5, 7);

 	 					$player->sendMessage($prefix."§a거미 눈 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 375, $count);

 	 					return;

 	 				}

 	 					

 	 				if ($random === 7) {

 	 					$count = mt_rand(2, 4);

 	 					$player->sendMessage($prefix."§a상급열쇠 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 378, $count);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 8) {

 	 					$count = mt_rand(1, 3);

 	 					$player->sendMessage($prefix."§a슬라임볼 §b{$count}§f개를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 341, $count);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 9) {

 	 					$count = 20;

 	 					$player->sendMessage($prefix."§a농사씨앗 세트§f를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 295, $count);

 	 					self::addItem($player->getName(), 361, $count);

 	 					self::addItem($player->getName(), 362, $count);

 	 					self::addItem($player->getName(), 458, $count);

 	 					return;

 	 				}

 	 				

 	 				if ($random === 10) {

 	 					$count = 1;

 	 					$player->sendMessage($prefix."§a철세트§f를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), 257, $count);

 	 					self::addItem($player->getName(), 267, $count);

 	 					self::addItem($player->getName(), 256, $count);

 	 					self::addItem($player->getName(), 258, $count);

 	 					self::addItem($player->getName(), 292, $count);

 	 					self::addItem($player->getName(), 306, $count);

 	 					self::addItem($player->getName(), 307, $count);

 	 					self::addItem($player->getName(), 308, $count);

 	 					self::addItem($player->getName(), 309, $count);

 	 					return;

 	 				}

 	 					

 	 				if ($random === 11) {

 	 					$player->sendMessage($prefix."§a위더머리§f를 획득하였습니다.");

 	 					self::removeItem($player->getName(), 378, 1);

 	 					self::addItem($player->getName(), "397:1", 1);

 	 					return;

 	 				}

 	 			}

 	 		}

 	 		

 	 		$player->sendMessage($prefix."열쇠로 터치해주세요.");

 	 		

 	 	}

 	 	if ($item->getId() === 370) {

 	 		$player->sendMessage($prefix."상자에 터치해주세요.");

 	 	}

 	 	if ($item->getId() === 351) {

			if ($item->getDamage() === 0) {

				$player->sendMessage($prefix."상자에 터치해주세요.");

			}

 	 	}

 	 	if ($item->getId() === 378) {

 	 		$player->sendMessage($prefix."상자에 터치해주세요.");

 	 	}

 	 	

 	 }

  }

?>
