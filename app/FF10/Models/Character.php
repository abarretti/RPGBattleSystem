<?php namespace FF10\Models\Character;

interface CharacterInterface {
    public function getName();
    public function getHP();
    public function setHP($hp);
}

abstract class Character implements CharacterInterface {
		
	protected $isAlive = true;
	protected $name;
	protected $HP;
	protected $MP;
	protected $attackStrength;
	protected $magicStrength;
	protected $magicCapabilities;
	protected $statusAilments= array();

	use Poison;

	public function getName() {
		return $this->name;
	}

	public function getHP() {
		return $this->HP;
	}

	public function setHP($hp) {
		$this->HP=$hp;
	}

    public function getMP() {
        return $this->MP;
    }

    public function setMP($hp) {
        $this->HP=$hp;
    }

	public function getAttackStrength() {
		return $this->attackStrength;
	}

    public function getStatus() {
        return array('Name'=>$this->name, 'HP'=>$this->HP, 'MP'=>$this->MP, 'Attack Strength'=>$this->attackStrength, 'Magic Strength'=>$this->magicStrength, 'Magic Capabilities'=>$this->magicCapabilities,'Status Ailments'=>$this->statusAilments);
    }

	public function attack(Character $target) {
		$target->setHP($target->getHP()-$this->attackStrength); 
		return $this->name.' did '.$this->attackStrength.'hp of damage to '.$target->name.'.';
	}

    /*
    public function useItem(Item $item, Character $target) {
        unset($target->statusAilments, $item->implement());
        return $this->getName().' uses '.$item->name.".\n".$target->getName().' is cured of '.$item->implement();
    }*/
}

class Guardian extends Character {
    
    public function __construct($name, int $hp, int $mp, int $attackStrength, int $magicStrength, array $magicCapabilities) {
        $this->name= $name;
        $this->HP= $hp;
        $this->MP= $mp;
        $this->attackStrength= $attackStrength;
        $this->magicStrength= $magicStrength;
        $this->magicCapabilities= $magicCapabilities;
    }
}

class Summoner extends Character {

    protected $summonCapabilities;
    
    public function __construct($name, int $hp, int $mp, int $attackStrength, int $magicStrength, array $magicCapabilities, array $summonCapabilities) {
        $this->name= $name;
        $this->HP= $hp;
        $this->MP= $mp;
        $this->attackStrength= $attackStrength;
        $this->magicStrength= $magicStrength;
        $this->magicCapabilities= $magicCapabilities;
        $this->summonCapabilities= $summonCapabilities;
    }

    public function getStatus() {
        return array('Name'=>$this->name, 'HP'=>$this->HP, 'MP'=>$this->MP, 'Attack Strength'=>$this->attackStrength, 'Magic Strength'=>$this->magicStrength, 'Magic Capabilities'=>$this->magicCapabilities,'Status Ailments'=>$this->statusAilments,'Summon Capabilities'=>$this->summonCapabilities);
    }
}

trait Poison {
    public function poison(Character $target) {
        if (in_array('Poison', $this->magicCapabilities)) {
            $target->setHP($target->getHP()-(.05)*$target->getHP());
            if(!in_array('Poison', $target->statusAilments)) {
                array_push($target->statusAilments,'Poison');
            }
            return $this->getName().' has poisoned '.$target->getName();
        }
        else {
            return $this->getName()." doesn't have the ability to Poison";
        }
    }
}

$tidus= new Guardian('Tidus', 500, 50, 20, 40, []);
$seymour= new Summoner('Seymour', 10000, 1000, 100, 300, ['Poison'],['Anima']);

var_dump($tidus->getStatus());
var_dump($seymour->getStatus());

echo $seymour->poison($tidus)."\n";
echo $tidus->getHp();

var_dump($tidus->getStatus());

?>

<!-- php Desktop/PHP/FF10/app/FF10/Models/Character.php -->