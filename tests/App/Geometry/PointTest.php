<?php

namespace AppTest\Geometry;

use App\Geometry\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testGetX() {
        $p1 = new Point(3, 4);
        $this->assertEquals(3, $p1->getX());
    }

    public function testGetY() {
        $p1 = new Point(3, 4);
        $this->assertEquals(4, $p1->getY());        
    }

    public function testGetDistance()
    {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $this->assertEquals(5, $p1->distance($p2));
    }
}
