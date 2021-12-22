<?php
// класс модели составного числа
class MathComplex {
    // поля для объекта - вещественная и мнимая части составного числа
    public $re, $im;
    // метод сложения текущего составного числа с другим числом,
    // также заданным объектом типа MathComplex
    function add(MathComplex $mc): void {
        $this->re += $mc->re;
        $this->im += $mc->im;
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
echo $mc1;