<?php

namespace AppTest\Geometry;

use App\Geometry\Segment;
use App\Geometry\Rectangle;
use App\Geometry\Point;
use App\Geometry\Circle;
use PHPUnit\Framework\TestCase;

class RectangleTest extends TestCase
{
    public function testGetName() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);
        $this->assertEquals("Rectangle", $rectangle->getName());
    }

    public function testGetArea() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);
        $this->assertEquals(12, $rectangle->getArea());
    }

    public function testGetPerimeter() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);
        $this->assertEquals(14, $rectangle->getPerimeter());
    }

    public function testIntersectWithSegment() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(-1, 1);
        $p4 = new Point(2, 2);
        $segment = new Segment($p3, $p4);

        $this->assertEquals(true, $rectangle->intersect($segment));
    }

    public function testIntersectWithRectangle() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle1 = new Rectangle($p1, $p2);

        $p3 = new Point(-1, -1);
        $p4 = new Point(4, 1);
        $rectangle2 = new Rectangle($p3, $p4);

        $this->assertEquals(true, $rectangle1->intersect($rectangle2));
    }

    public function testNoIntersectWithRectangle() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle1 = new Rectangle($p1, $p2);

        $p3 = new Point(0, 5);
        $p4 = new Point(3, 6);
        $rectangle2 = new Rectangle($p3, $p4);

        $this->assertEquals(false, $rectangle1->intersect($rectangle2));
    }

    public function testIntersectWithCircle() {
        $p1 = new Point(-1, -1);
        $circle = new Circle($p1, 2);

        $p2 = new Point(0, 0);
        $p3 = new Point(3, 4);
        $rectangle = new Rectangle($p2, $p3);
        
        $this->assertEquals(true, $rectangle->intersect($circle));
    }

    public function testNoIntersectWithCircle() {
        $p1 = new Point(9, 9);
        $circle = new Circle($p1, 1);

        $p2 = new Point(0, 0);
        $p3 = new Point(3, 4);
        $rectangle = new Rectangle($p2, $p3);
        
        $this->assertEquals(false, $rectangle->intersect($circle));
    }

    public function testContainPoint() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(2, 2);
        $this->assertEquals(true, $rectangle->containPoint($p3));
    }

    public function testNoContainPoint() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(4, 4);
        $this->assertEquals(false, $rectangle->containPoint($p3));
    }

    public function testContainSegment() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(1, 1);
        $p4 = new Point(2, 3);
        $segment = new Segment($p3, $p4);

        $this->assertEquals(true, $rectangle->contain($segment));
    }

    public function testNoContainSegment() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(0, -1);
        $p4 = new Point(-1, 4);
        $segment = new Segment($p3, $p4);

        $this->assertEquals(false, $rectangle->contain($segment));
    }

    public function testContainRectangle() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle1 = new Rectangle($p1, $p2);

        $p3 = new Point(1, 1);
        $p4 = new Point(2, 3);
        $rectangle2 = new Rectangle($p3, $p4);

        $this->assertEquals(true, $rectangle1->contain($rectangle2));
    }

    public function testNoContainRectangle() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle1 = new Rectangle($p1, $p2);

        $p3 = new Point(0, -1);
        $p4 = new Point(-1, 4);
        $rectangle2 = new Rectangle($p3, $p4);

        $this->assertEquals(false, $rectangle1->contain($rectangle2));
    }

    public function testContainCircle() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(1, 1);
        $circle = new Circle($p3, 0.5);

        $this->assertEquals(true, $rectangle->contain($circle));
    }

    public function testNoContainCircle() {
        $p1 = new Point(0, 0);
        $p2 = new Point(3, 4);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(1, 1);
        $circle = new Circle($p3, 2);

        $this->assertEquals(false, $rectangle->contain($circle));
    }
}