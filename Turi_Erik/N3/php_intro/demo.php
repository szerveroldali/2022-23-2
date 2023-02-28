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
            echo "Hello, I'm a human";
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

        public static function sayHello(){
            echo "Hello, I'm a kid";
        }
    }

    $h1 = new Human('Aladár');
    $h1 -> getName();
    $h1 -> sayHello();    // $user -> update()
    Human::sayHello();    // User::all()

    $k1 = new Kid('Laci', 5);
    $k1 -> getName();
    $k1 -> sayHello();
    Kid::sayHello();

    require_once 'vendor/autoload.php';

    $faker = Faker\Factory::create();
    for ($i = 0; $i < 100; $i++)
        echo $faker -> name() . PHP_EOL;
?>