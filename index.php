<?php
// класс модели составного числа
class MathComplex {
    // поля для объекта - вещественная и мнимая части составного числа
    public $re, $im;
    // метод сложения текущего составного числа с другим числом,
    // заданным двумя отдельными составляющими
    function add(float $re, float $im): void{
        $this->re += $re;
        $this->im += $im;
    }
}

// $mc1 = new MathComplex();
$mc1 = new MathComplex;
$mc1->add(2, 3);
$mc1->add(1, 1);
var_dump($mc1);
// echo $mc1;