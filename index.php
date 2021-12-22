<?php
// класс модели составного числа
class MathComplex {
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

$mc1->add($mc2);

echo "$mc1\n";

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