class Room {
    private $doors = [];
    private $ contents = [];
    private $visited = false;

    public function __construct($doors, $contents) {
        $this->doors = $doors;
        $this->contents = $contents;
    }

    public function PlayerInteract(PLayer $player) {
        $this->visited = true;
        foreach($this->contents as $content) {
            $content ->interact($player);
        }
    }

    public function Visited() {
        return $this->visited;
    }

    public function getDoors() {
        return $this->doors;
    }
}

class Dungeon {
    private $rooms = [];
    private $startRoom;

    public function getStartRoom() {
        return $this->startRoom;
    }
}

class Player {
    private $currRoom;
    private $score = 0;

    public function __construct(Room $startRoom) {
        $this->currRoom = $startRoom
    }


    public function move($direction) {
        $doors = $this->currRoom->getDoors();
    }

    public function RoomInteract() {
        $this->currRoom->PlayerInteract($this);
    }

    public function IncrementScore($points) {
        $this->score += $points;
    }

    public function getScore() {
        return $this->score;
    }
}

class Door {
    private $adjacentRoom;

    public funciton __construct(Room $adjacentRoom) {
        $this->adjacentRoom = $adjacentRoom;
    }

    public function getAdjacentRoom() {
        return $this->adjacentRoom;
    }
}


interface Content {
    public function interact(Player $player)
}

class Treasure implements Content {
    private $points;

    public function __construct($points) {
        $this->points = $points;
    }

    public function interact(Player $player) {
        $player->IncrementScore($this->points)
    }
}


class Monster implements Content {
    private $strength;

    public function __construct($strength) {
        $this->strength = $strength;
    }

    public function interact(Player $player) {
        $rand = rand(1, 100);
        if ($rand > $this->strength) {
            $player->IncrementScore($this->strength);
            echo "You defeated the monster and gained {$this->strength} points!\n";
        } else {
            echo "You failed to defeat the monster. The mopster still has this much strength {$this->strength}.\n";
        }
    }
}