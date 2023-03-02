<?php
    $x = 3;
    $t = [1, 2, 3, 4];
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
            echo "Hi, my name is " . $this -> name . PHP_EOL;
        }

        public static function sayHello(){
            echo "Hello, I'm a human.". PHP_EOL;
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
            echo "Hi, my name is " . $this -> name . " and I'm " . $this -> age . PHP_EOL;
        }
    }

    $h = new Human('Győző');
    $h -> getName();
    $h -> sayHello();    // $user -> update()
    Human::sayHello();   // User::all()

    $k = new Kid('Zsófi', 9);
    $k -> getName();
    $k -> sayHello();    // $user -> update()
    Kid::sayHello();   // User::all()

    require_once 'vendor/autoload.php';
    $faker = Faker\Factory::create();
    for ($i = 0; $i < 100; $i++)
        echo $faker->email() . PHP_EOL;
?>