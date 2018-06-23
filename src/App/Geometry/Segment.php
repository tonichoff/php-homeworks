<?php

namespace App\Geometry;

class Segment implements ShapeInterface {
    public const NAME = "Segment";
    public const EPS = 0.0000000001;

    /**
     * @param Point $p1
     * @param Point $p2
     */
    public function __construct(Point $first_point, Point $second_point) {
        $this->_point_A = $first_point;
        $this->_point_B = $second_point;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return self::NAME;
    }

    /**
     * @return float
     */
    public function getArea(): float {
        return 0;
    }

    /**
     * @return float
     */
    public function getPerimeter(): float {
        return $this->_point_A->distance($this->_point_B);
    }

    /**
     * @return Point
     */
    public function getPointA(): Point {
        return $this->_point_A;
    }

    /**
     * @return Point
     */
    public function getPointB(): Point {
        return $this->_point_B;
    }

    /**
     * @param ShapeInterface $shape
     * @return bool
     */
    public function intersect(ShapeInterface $shape): bool {
        $shape_name = $shape->getName();
        if ($shape_name == "Segment")
            return $this->intersectWithSegment($shape);
        else if ($shape_name == "Rectangle")
            return $this->intersectWithRectangle($shape);
        else if ($shape_name == "Circle")
            return $this->intersectWithCircle($shape);
    }

    /**
     * @param Segment $segment
     * @return bool
     */
    private function intersectWithSegment(Segment $segment): bool {
        $x1 = $this->getPointA()->getX();
        $x2 = $this->getPointB()->getX();
        $y1 = $this->getPointA()->getY();
        $y2 = $this->getPointB()->getY();

        $x3 = $segment->getPointA()->getX();
        $x4 = $segment->getPointB()->getX();
        $y3 = $segment->getPointA()->getY();
        $y4 = $segment->getPointB()->getY();

        $d = ($y4 - $y3) * ($x2 - $x1) - ($x4 - $x3) * ($y2 - $y1);
        if ($d == 0)
            return false;
        $u_a = (($x4 - $x3) * ($y1 - $y3) - ($y4 - $y3) * ($x1 - $x3)) / $d;
        $u_b = (($x2 - $x1) * ($y1 - $y3) - ($y2 - $y1) * ($x1 - $x3)) / $d;

        if ($u_a >= 0 && $u_a <= 1 && $u_b >= 0 && $u_b <= 1)
            return true;
        else
            return false;
    }

    /**
     * @param Rectangle $rectangle
     * @return bool
     */
    private function intersectWithRectangle(Rectangle $rectangle): bool {
        $segments = [
            0 => $rectangle->getTopSegment(),
            1 => $rectangle->getRightSegment(),
            2 => $rectangle->getBottomSegment(),
            3 => $rectangle->getLeftSegment(),
        ];

        for ($i = 0; $i < 4; $i++) {
            if ($this->intersect($segments[$i]))
                return true;
        }

        return false;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    private function intersectWithCircle(Circle $circle): bool {
        $x_a = $this->getPointA()->getX();
        $y_a = $this->getPointA()->getY();
        $x_b = $this->getPointB()->getX();
        $y_b = $this->getPointB()->getY();
        $x_o = $circle->getCentre()->getX();
        $y_o = $circle->getCentre()->getY();

        $x_a -= $x_o;
        $x_b -= $x_o;
        $y_a -= $y_o;
        $y_b -= $y_o;

        $A = $y_a - $y_b;
        $B = $x_b - $x_a;
        $C = $x_a * $y_b - $x_b * $y_a;

        $r = $circle->getRadius();
        if ($C * $C <= $r * $r * ($A * $A + $B * $B) + self::EPS)
            return true;
        else
            return false;
    }

    /**
     * @var Point
     */
    private $_point_A;

    /**
     * @var Point
     */
    private $_point_B;
}