<?php

namespace App\Geometry;

class Circle implements ShapeInterface {
    public const NAME = "Circle";

    /**
     * @param Point $c
     * @param float $r
     */
    public function __construct(Point $c, float $r) {
        $this->_centre = $c;
        $this->_radius = $r;
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
        return M_PI * pow($this->_radius, 2);
    }

    /**
     * @return float
     */
    public function getPerimeter(): float {
        return 2 * M_PI * $this->_radius;
    }

    /**
     * @return Point
     */
    public function getCentre(): Point {
        return $this->_centre;
    }

    /**
     * @return float
     */
    public function getRadius(): float {
        return $this->_radius;
    }

    /**
    * @param ShapeInterface $shape
    * @return bool
    */
    public function intersect(ShapeInterface $shape): bool {
        $shape_name = $shape->getName();
        if ($shape_name == "Segment")
            return $shape->intersect($this);
        else if ($shape_name == "Rectangle")
            return $shape->intersect($this);
        else if ($shape_name == "Circle")
            return $this->intersectWithCircle($shape);
    }

    /**
    * @param ShapeInterface $shape
    * @return bool
    */
    public function contain(ShapeInterface $shape): bool {
        $shape_name = $shape->getName();
        if ($shape_name == "Segment")
            return $this->isContainSegment($shape);
        else if ($shape_name == "Rectangle")
            return $shape->contain($shape);
        else if ($shape_name == "Circle")
            return $this->isContainCircle($shape); 
    }

    /**
    * @param Point $shape
    * @return bool
    */
    public function containPoint(Point $point): bool {
        $d = $this->getCentre()->distance($point);
        return ($d <= $this->getRadius());
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    private function intersectWithCircle(Circle $circle): bool {
        $x1 = $this->getCentre()->getX();
        $y1 = $this->getCentre()->getY();
        $r1 = $this->getRadius();

        $x2 = $circle->getCentre()->getX();
        $y2 = $circle->getCentre()->getY();
        $r2 = $circle->getRadius();

        $d = pow(pow($x2 - $x1, 2) + pow($y2 - $y1, 2), 0.5);
        $nesting = abs($r2 - $r1) > $d;
        $no_intersection = $d > $r2 + $r1;

        if (!($nesting || $no_intersection))
            return true;
        else
            return false;
    }

    /**
     * @param Segment $segment
     * @return bool
     */
    private function isContainSegment(Segment $segment): bool {
        $a = $segment->getPointA();
        $b = $segment->getPointB();
        $c = $this->getCentre();
        $r = $this->getRadius();

        if ($a->distance($c) <= $r && $b->distance($c) <= $r) 
            return true;
        else
            return false;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    private function isContainCircle(Circle $circle): bool {
        $x1 = $this->getCentre()->getX();
        $y1 = $this->getCentre()->getY();
        $r1 = $this->getRadius();

        $x2 = $circle->getCentre()->getX();
        $y2 = $circle->getCentre()->getY();
        $r2 = $circle->getRadius();

        $d = pow(pow($x2 - $x1, 2) + pow($y2 - $y1, 2), 0.5);

        if (abs($r2 - $r1) > $d)
            return true;
        else
            return false;
    }

    /**
     * @var Point;
     */
    private $_centre;

    /**
     * @var float;
     */
    private $_radius;
}

?>