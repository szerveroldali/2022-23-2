<?php
    $x = 3;

    $t = [1, 2, 3];

    foreach($t as $elem){
        echo $elem . " ";
    }

    class Human {
        public $name;

        public function __construct($name)
        {
            $this -> name = $name;
        }

        public function getName(){
            echo "Hello, my name is " . $this -> name;
        }

        public static function sayHello(){
            echo "Hello, I'm a human.";
        }
    }

    class Kid extends Human {
    // class User extends Model
        public $age;
        public function __construct($name, $age)
        {
            $this -> name = $name;
            $this -> age = $age;
        }
        public function getName(){
            echo "Hewwo, my naimu is " . $this -> name . " and I'm " . $this -> age;
        }
    }

    $h = new Human('Pistike');
    $h -> getName();      // $user -> update()
    $h -> sayHello();
    Human::sayHello();    // User::all()

    $k = new Kid('Sanyi', 9);
    $k -> getName();
    Kid::sayHello();

    require_once 'vendor/autoload.php';
    
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 100; $i++)
        echo $faker -> email() . PHP_EOL;

?>