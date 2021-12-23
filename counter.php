<?php
class Counter {
    private $id = 2;
    // статическое поле класса
    private static $count = 0;
    private $unfamiliarFunctions = [];
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
    // "магический" метод чтения значений любых полей,
    // проверяющий, есть ли в объекте поле с указанным именем,
    // и если нет - возвращающий значение null
    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }
    // "магический" метод установки значений любых полей,
    // изначально не описанных в текущем классе
    public function __set($name, $value)
    {
        // если значение является функцией
        if ($value instanceof Closure) {
            // добавляем в словарь текущего объекта элемент:
            // ключ - имя нового метода,
            // значение - сам метод
            $this->unfamiliarFunctions[$name] = $value;
        } else {
            // если значение не является функцией,
            // то записываем в поле с именем из переменной $name
            // значение из переменной $value,
            // а если поле с таким именем не было добавлено
            // динамически в объект ранее - сначала добавляем его
            $this->$name = $value; // $this->x = 200;
        }
    }
    // "магический" метод вызова любых методов,
    // которые не были описаны в классе Counter,
    // но позднее были добавлены динамически в объект типа Counter
    public function __call($name, $arguments)
    {
        // найти во внутреннем массиве ранее добавленный метод с именем,
        // полученным из аргумента $name
        $function = $this->unfamiliarFunctions[$name];
        if($function) {
            // вызвать метод с аргументами $arguments
            return $function(...$arguments);
        } else {
            // если метод не был добавлен в объект и динамически -
            // выбросить ошибку
            throw new Error("Function $name not exists in Counter.");
        }
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