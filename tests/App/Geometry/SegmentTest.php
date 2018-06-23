<?php

namespace AppTest\Geometry;

use App\Geometry\Segment;
use App\Geometry\Rectangle;
use App\Geometry\Circle;
use App\Geometry\Point;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    public function testGetName() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $segment = new Segment($p1, $p2);
        $this->assertEquals("Segment", $segment->getName());
    }

    public function testGetArea() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $segment = new Segment($p1, $p2);
        $this->assertEquals(0, $segment->getArea());
    }

    public function testGetPerimeter() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $segment = new Segment($p1, $p2);
        $this->assertEquals(5, $segment->getPerimeter());
    }

    public function testIntersectWithSegment() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $segment1 = new Segment($p1, $p2);

        $p3 = new Point(0, 2);
        $p4 = new Point(3, 2);
        $segment2 = new Segment($p3, $p4);

        $this->assertEquals(true, $segment1->intersect($segment2));
    }

    public function testNoIntersectWithSegment() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $segment1 = new Segment($p1, $p2);

        $p3 = new Point(-1, -0.00001);
        $p4 = new Point(3, -0.00001);
        $segment2 = new Segment($p3, $p4);

        $this->assertEquals(false, $segment1->intersect($segment2));
    }

    public function testIntersectWithRectangle() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(-1, 1);
        $p4 = new Point(2, 2);
        $segment = new Segment($p3, $p4);

        $this->assertEquals(true, $segment->intersect($rectangle));
    }

    public function testNoIntersectWithRectangle() {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $rectangle = new Rectangle($p1, $p2);

        $p3 = new Point(-2, 3);
        $p4 = new Point(1, 5);
        $segment = new Segment($p3, $p4);

        $this->assertEquals(false, $segment->intersect($rectangle));
    }

    public function testIntersectWithCircle() {
        $p1 = new Point(0, 0);
        $circle = new Circle($p1, 2);

        $p2 = new Point(1, 1);
        $p3 = new Point(-1, 3);
        $segment = new Segment($p2, $p3);
        
        $this->assertEquals(true, $segment->intersect($circle));
    }

    public function testNoIntersectWithCircle() {
        $p1 = new Point(0, 0);
        $circle = new Circle($p1, 2);

        $p2 = new Point(2.00001, -2);
        $p3 = new Point(2.00001, 2);
        $segment = new Segment($p2, $p3);
        
        $this->assertEquals(false, $segment->intersect($circle));
    }
}
