<?php
/**
 * Created by PhpStorm.
 * User: kumfo
 * Date: 2017/8/23
 * Time: 下午2:42
 */

class Product
{
    private $size;
    private $color;

    public function setSize($size)
    {
        $this->size = $size;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getSurface()
    {
        return [
            'size' => $this->size,
            'color' => $this->color
        ];
    }
}

abstract class Builder
{
    public abstract function setSurface($size, $color);

    public abstract function getProduct();

}

class ProductBuilder extends Builder
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function setSurface($size, $color)
    {
        $this->product->setColor($color);
        $this->product->setSize($size);
    }

    public function getProduct()
    {
        return $this->product;
    }
}

class Director {
    private $builder;
    public function __construct()
    {
        $this->builder = new ProductBuilder();
    }
    public function getProductA() {
        $this->builder->setSurface(100,'0XFFFFFF');
        return $this->builder->getProduct();
    }
    public function getProductB() {
        $this->builder->setSurface(200,'0X000000');
        return $this->builder->getProduct();
    }
}

class Demo {
    public function run() {
        $director = new Director();
        $productA = $director->getProductA();
        var_dump($productA->getSurface());

        $productB = $director->getProductB();
        var_dump($productB->getSurface());
    }
}
(new Demo())->run();
/**
 * 通过建造者模式一步一步的构造复杂的业务类，目前这个例子是比较简单的，但对于复杂的
 * "产品线"业务，应该是具有比较好的应用场景的，不过目前我还没想出来有什么地方需要用到这种
 * 设计模式
 */