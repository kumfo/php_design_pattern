<?php
/**
 * 以抽象的需求"画图"来做表示
 */

// 1. 定义工厂调用接口

/**
 * 定义工厂调用接口
 * Interface Shape
 */
interface Shape {
    public function draw();
}

// 2. 以下定义三个实现

class Rectangle implements Shape {

    public function draw()
    {
        echo "Rectangle\n";
    }
}

class Square implements Shape {
    public function draw()
    {
        echo "Square\n";
    }
}

class Circle implements Shape {

    public function draw()
    {
        echo "Circle\n";
    }
}

// 3. 以下创建工厂

class ShapeFactory {
    /**
     * @param  $type
     * @return Shape object
     */
    public function getShape($type) {
        $shape = null;
        switch ($type) {
            case 'rectangle':
                $shape = new Rectangle();
                break;
            case 'square':
                $shape = new Square();
                break;
            case 'circle':
                $shape = new Circle();
                break;
        }
        return $shape;
    }
}

// 4. 使用工厂
class FactoryPatternDemo {
    public function __construct()
    {
        $this->run();
    }
    public function run() {
        $shapes = [
            'rectangle',
            'square',
            'circle'
        ];
        $shapeFactory = new ShapeFactory();
        // 采用工厂模式批量画出不同的图形
        foreach ($shapes as $shape) {
            $shapeFactory->getShape($shape)->draw();
        }
    }
}

new FactoryPatternDemo();
