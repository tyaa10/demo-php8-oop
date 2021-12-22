<?php
class Counter {
    // статическое поле класса
    private static $count = 0;
    // конструктор
    public function __construct()
    {
        self::$count++;
    }
    // финализатор
    public function __destruct()
    {
        self::$count--;
    }
    /**
     * Статический метод класса
     * @return int
     */
    public static function getCount(): int
    {
        return self::$count;
    }
}