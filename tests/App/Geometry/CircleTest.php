<?php

namespace AppTest\Geometry;

use App\Geometry\Segment;
use App\Geometry\Rectangle;
use App\Geometry\Circle;
use App\Geometry\Point;
use PHPUnit\Framework\TestCase;

class CircleTest extends TestCase
{
    public function testGetName() {
        $p1 = new Point(3, 4);
        $circle = new Circle($p1, 3);
        $this->assertEquals("Circle", $circle->getName());
    }

    public function testGetArea() {
        $p1 = new Point(3, 4);
        $circle = new Circle($p1, 3);
        $this->assertEquals(M_PI * 9, $circle->getArea());
    }

    public function testGetPerimeter() {
        $p1 = new Point(3, 4);
        $circle = new Circle($p1, 3);
        $this->assertEquals(M_PI * 6, $circle->getPerimeter());
    }

    public function testIntersectSegment() {
        $p1 = new Point(0, 0);
        $circle = new Circle($p1, 2);

        $p2 = new Point(1, 1);
        $p3 = new Point(-1, 3);
        $segment = new Segment($p2, $p3);
        
        $this->assertEquals(true, $circle->intersect($segment));
    }

    public function testIntersectWithRectangle() {
        $p1 = new Point(-1, -1);
        $circle = new Circle($p1, 2);

        $p2 = new Point(0, 0);
        $p3 = new Point(3, 4);
        $rectangle = new Rectangle($p2, $p3);
        
        $this->assertEquals(true, $circle->intersect($rectangle));
    }

    public function testIntersectWithCircle() {
        $p1 = new Point(0, 0);
        $circle1 = new Circle($p1, 2);

        $p2 = new Point(2, 2);
        $circle2 = new Circle($p2, 1);

        $this->assertEquals(true, $circle1->intersect($circle1));
    }

    public function testContainPoint() {
        $p1 = new Point(0, 0);
        $circle = new Circle($p1, 2);

        $p2 = new Point(1, 1);
        $this->assertEquals(true, $circle->containPoint($p2));
    }

    public function testNoContainPoint() {
        $p1 = new Point(0, 0);
        $circle = new Circle($p1, 2);

        $p2 = new Point(2, 3);
        $this->assertEquals(false, $circle->containPoint($p2));
    }

    public function testContainRectangle() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(1, 1);
        $circle = new Circle($p3, 0.5);

        $this->assertEquals(true, $circle->contain($rectangle));
    }

    public function testContainSegment() {
        $p1 = new Point(-2, -1);
        $p2 = new Point(1, 1);
        $segment = new Segment($p1, $p2);

        $p3 = new Point(1, 1);
        $circle = new Circle($p3, 3);

        $this->assertEquals(true, $circle->contain($segment));
    }

    public function testNoContainSegment() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $segment = new Segment($p1, $p2);

        $p3 = new Point(1, 1);
        $circle = new Circle($p3, 3);

        $this->assertEquals(false, $circle->contain($segment));
    }

    public function testContainCircle() {
        $p1 = new Point(0, 0);
        $circle1 = new Circle($p1, 4);

        $p2 = new Point(2, 0);
        $circle2 = new Circle($p2, 1);

        $this->assertEquals(true, $circle1->contain($circle2));
    }

    public function testNoContainCircle() {
        $p1 = new Point(0, 0);
        $circle1 = new Circle($p1, 4);

        $p2 = new Point(2, 0);
        $circle2 = new Circle($p2, 3);

        $this->assertEquals(false, $circle1->contain($circle2));
    }
}