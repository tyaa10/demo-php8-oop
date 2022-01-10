<?php
require_once './counter.php';
abstract class MathObject {
    private int $id = 0;
    public function setId (int $id): void {
        $this->id = $id;
    }
    public function getId (): int {
        return $this->id;
    }
}
interface IAddable {
    function add(...$args): void;
}
trait Diff {
    function minus(...$args): void {
        if (count($args) === 1 && $args[0] instanceof MathComplex) {
            $this->re -= $args[0]->re;
            $this->im -= $args[0]->im;
        } else if(floatval($args[0]) !== false && floatval($args[1]) !== false) {
            $this->re -= $args[0];
            $this->im -= $args[1];
        }
    }
}
// класс модели составного числа
class MathComplex extends MathObject implements IAddable {
    // подключение составляющих трейта Diff
    use Diff;
    // поля для объекта - вещественная и мнимая части составного числа
    public $re, $im;
    // метод сложения текущего составного числа с другим числом,
    // заданным двумя отдельными составляющими
    // или объектом типа MathComplex
    function add(...$args): void {
        if (count($args) === 1 && $args[0] instanceof MathComplex) {
            $this->re += $args[0]->re;
            $this->im += $args[0]->im;
        } else if(floatval($args[0]) !== false && floatval($args[1]) !== false) {
            $this->re += $args[0];
            $this->im += $args[1];
        }
    }
    public function __toString()
    {
        return "MathComplex {re: $this->re, im: $this->im}";
    }
}

// $mc1 = new MathComplex();
$mc1 = new MathComplex;
$mc1->re = 2;
$mc1->im = 3;

$mc2 = new MathComplex;
$mc2->re = 1;
$mc2->im = 1;

// $mc1->add($mc2);
$mc1->minus($mc2);

echo "mc1 - mc2 = $mc1\n";

$mc1->add(-3, -4);

echo "$mc1\n";

$mc1->e = 2.71;
echo $mc1->e;

$mc1->subtract = (function (...$args) {
    if (count($args) === 1 && $args[0] instanceof MathComplex) {
        $this->re -= $args[0]->re;
        $this->im -= $args[0]->im;
    } else if(floatval($args[0]) !== false && floatval($args[1]) !== false) {
        $this->re -= $args[0];
        $this->im -= $args[1];
    }
})->bindTo($mc1);

$sub = $mc1->subtract;
var_dump($sub);
$sub($mc2);
echo "$mc1\n";

echo Counter::getCount()."\n";
$counters = [];
for ($i = 0; $i < 10; $i++) {
    $counters[] = new Counter();
}
echo Counter::getCount()."\n";
$counters[2] = null;
echo Counter::getCount()."\n";
var_dump($counters);
echo 'The End!';

/* Inheritance */

class A {
    function foo() {
        return 'SMTH';
    }
}

class B extends A {
    function foo() {
        return parent::foo() . " Else...\n";
    }
}
echo (new B())->foo();

function outerFoo (A $a) : void {
    echo $a->foo();
}

outerFoo(new B());


$x = 101;
$name = 'x';
echo "{$$name}\n"; // "$x\n"

$mc3 = new Counter;
$mc3->x = 200;
echo "{$mc3->x}\n";
echo "{$mc3->y}\n";

$mc3->getId = (function () {
    return $this->id;
})->bindTo($mc3);
$mc3->setId = (function ($id) {
    $this->id = $id;
})->bindTo($mc3);
// echo $mc3->unfamiliarFunctions['getId']();
$mc3->setId(33);
echo $mc3->getId();

class Test {
    public function __toString()
    {
        return 'Test';
    }
}

/* $t = new Test;
$t->foo = function () {
    // регистрация в текущем сценарии всех переменных,
    // перечисленных в массиве-аргументе
    extract(
        // образование массива-словаря,
        // в котором есть один элемент,
        // ключ этого элемента - this, на основании которого extract образует переменную $this,
        // а значение - это ближайший объект, внутри которого будет вызван метод foo
        array('context' => function ()
        {
            foreach(debug_backtrace(false) as $stack){
                var_dump($stack);
                if(isset($stack['object']) && !($stack['object'] instanceof Closure)){
                    return $stack['object'];
                }
            }
            return null;
        })
    );
    $context = $context->__invoke();
    // var_dump($context->__invoke());
    echo "Hello Function from $context";
};
var_dump($t->foo->__invoke());
// $t->foo(); */

$mc4 = new MathComplex;
$mc4->setId(555);
echo '$mc4->getId() = ' . $mc4->getId();
