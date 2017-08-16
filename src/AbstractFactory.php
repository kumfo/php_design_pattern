<?php
/**
 *  抽象工厂模式
 */

// 定义形状接口
interface Shape {
    public function draw();
}
// 定义颜色接口
interface Color {
    public function fill();
}

// 形状实现

class Rectangle implements Shape {

    public function draw()
    {
        echo "Rectangle\n";
    }
}

class Circle implements Shape {

    public function draw()
    {
        echo "Circle\n";
    }
}

class Square implements Shape {

    public function draw()
    {
        echo "Square\n";
    }
}

// 颜色实现
class Green implements Color {
    public function fill()
    {
        echo "Green\n";
    }
}


class Red implements Color {
    public function fill()
    {
        echo "Red\n";
    }
}


class Blue implements Color {
    public function fill()
    {
        echo "Blue\n";
    }
}


/**
 * Class AbstractFactory
 * 抽象工厂类
 */
abstract class AbstractFactory {
    /**
     * @param $color
     * @return Color
     */
    abstract function getColor($color);

    /**
     * @param $shape
     * @return Shape
     */
    abstract function getShape($shape);
}
// 形状工厂
class ShapeFactory extends AbstractFactory {

    /**
     * @param $color
     * @return Color
     */
    function getColor($color)
    {
        return null;
    }

    /**
     * @param $shape
     * @return Shape
     */
    function getShape($shape)
    {
        $ShapeInstance = null;
        switch ($shape) {
            case 'rectangle':
                $ShapeInstance = new Rectangle();
                break;
            case 'circle':
                $ShapeInstance = new Circle();
                break;
            case 'square':
                $ShapeInstance = new Square();
                break;
        }
        return$ShapeInstance;
    }
}
// 颜色工厂
class ColorFactory extends AbstractFactory {

    /**
     * @param $color
     * @return Color
     */
    function getColor($color)
    {
        $ColorInstance = null;
        switch ($color) {
            case 'green':
                $ColorInstance = new Green();
                break;
            case 'red':
                $ColorInstance = new Red();
                break;
            case 'blue':
                $ColorInstance = new Blue();
                break;
        }
        return $ColorInstance;
    }

    /**
     * @param $shape
     * @return Shape
     */
    function getShape($shape)
    {
        return null;
    }
}

/**
 * 工厂生成器
 * Class FactoryGenerator
 */
class FactoryGenerator {
    /**
     * @param $factory
     * @return AbstractFactory
     */
    public static function getFactory($factory) {
        $FactoryInstance = null;
        switch ($factory) {
            case 'shape':
                $FactoryInstance = new ShapeFactory();
                break;
            case 'color':
                $FactoryInstance = new ColorFactory();
                break;
        }
        return$FactoryInstance;
    }
}

class Demo {
    public function __construct()
    {
        $this->run();
    }
    public function run() {
        $data = [
            'shape' => [
                'rectangle',
                'circle',
                'square'
            ],
            'color' => [
                'green',
                'red',
                'blue'
            ]
        ];
        foreach ($data as $factory => $materials) {
            $Factory = FactoryGenerator::getFactory($factory);
            foreach ($materials as $material) {
                if($Factory instanceof ColorFactory) {
                    $Factory->getColor($material)->fill();
                } else if($Factory instanceof ShapeFactory) {
                    $Factory->getShape($material)->draw();
                }
            }
        }
    }
}
new Demo();

/**
 * 思考：
 * 从这整个例子来看，抽象工厂与工厂模式具有一定的相似性但也具有一定的区别
 * 1. 抽象工厂再独立了一层工厂管理类，也就是根据生产的东西调用不同的工厂来进行生产
 * 2. 定义的抽象工厂类可以解释为：工厂管理类，也就是工厂生成器里管理的所有工厂都应该具备抽象工厂里的全部或部分功能
 *   也就是说，所有子工厂都是抽象工厂的实现，就像生产手机的厂商，可以当做一个抽象工厂，然后把各个配件都交给不同的工厂进行生产
 * 3. 但从程序上来看，整套程序是显得比较复杂的，就算具体的工厂类不实现抽象工厂的某部分功能，但也还需要进行接口编写，会造成逻辑虽然清晰，但是代码会非常复杂
 * 4. 相对于工厂模式来说，之前的工厂模式是我想要生产不同的东西就告诉工厂，让工厂来生产，而抽象工厂模式连工厂都可以进行选择
 */
