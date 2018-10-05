<?php

namespace App\Geometry;

class Rectangle implements ShapeInterface {
    public const NAME = "Rectangle";

    /**
     * @param Point $tl_p
     * @param Point $br_p
     */
    public function __construct(Point $tl_p, Point $br_p) {
        $this->_top_left_point = $tl_p;
        $this->_bottom_right_point = $br_p;
        $this->_top_right_point = new Point($br_p->getX(), $tl_p->getY());
        $this->_bottom_left_point = new Point($tl_p->getX(), $br_p->getY());
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
        return $this->getWidth() * $this->getHeight();
    }

    /**
     * @return float
     */
    public function getPerimeter(): float {
        return ($this->getWidth() + $this->getHeight()) * 2;
    }

    /**
     * @return float
     */
    public function getWidth(): float {
        return $this->_bottom_left_point->distance($this->_bottom_right_point);
    }

    /**
     * @return float
     */
    public function getHeight(): float {
        return $this->_bottom_left_point->distance($this->_top_left_point);
    }

    /**
     * @return Segment
     */
    public function getTopSegment(): Segment {
        return new Segment($this->_top_left_point, $this->_top_right_point);
    }

    /**
     * @return Segment
     */
    public function getRightSegment(): Segment {
        return new Segment($this->_top_right_point, $this->_bottom_right_point);
    }

    /**
     * @return Segment
     */
    public function getBottomSegment(): Segment {
        return new Segment($this->_bottom_right_point, $this->_bottom_left_point);
    }

    /**
     * @return Segment
     */
    public function getLeftSegment(): Segment {
        return new Segment($this->_bottom_left_point, $this->_top_left_point);
    }

    /**
     * @return Point
     */
    public function getTopLeftCorner(): Point {
        return $this->_top_left_point;
    }

    /**
     * @return Point
     */
    public function getTopRightCorner(): Point {
        return $this->_top_right_point;
    }

    /**
     * @return Point
     */
    public function getBottomRightCorner(): Point {
        return $this->_bottom_right_point;
    }

    /**
     * @return Point
     */
    public function getBottomLeftCorner(): Point {
        return $this->_bottom_left_point;
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
            return $this->intersectWithRectangle($shape);
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
            return $this->isContainRectangle($shape);
        else if ($shape_name == "Circle")
            return $this->isContainCircle($shape); 
    }

    /**
    * @param Point $shape
    * @return bool
    */
    public function containPoint(Point $point): bool {
        $top = $this->_top_left_point->getY();
        $left = $this->_top_left_point->getX();
        $bottom = $this->_bottom_right_point->getY();
        $right = $this->_bottom_right_point->getX();

        $x = $point->getX();
        $y = $point->getY();
        if ($top <= $y && $bottom >= $y && $left <= $x && $right >= $x)
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
        $segments = [
            0 => $this->getTopSegment(),
            1 => $this->getRightSegment(),
            2 => $this->getBottomSegment(),
            3 => $this->getLeftSegment(),
        ];

        for ($i = 0; $i < 4; $i++) {
            if ($circle->intersect($segments[$i]))
                return true;
        }

        return false;
    }

    /**
     * @param Segment $segment
     * @return bool
     */
    private function isContainSegment(Segment $segment): bool {
        $a = $segment->getPointA();
        $b = $segment->getPointB();

        if ($this->containPoint($a) && $this->containPoint($b))
            return true;
        else
            return false;
    }

    /**
     * @param Rectangle $rectangle
     * @return bool
     */
    private function isContainRectangle(Rectangle $rectangle): bool {
        $tl = $rectangle->getTopLeftCorner();
        $br = $rectangle->getBottomRightCorner();

        if ($this->containPoint($tl) && $this->containPoint($br))
            return true;
        else
            return false;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    private function isContainCircle(Circle $circle): bool {
        $x = $circle->getCentre()->getX();
        $y = $circle->getCentre()->getY();
        $r = $circle->getRadius();

        $p1 = new Point($x, $y + $r);
        $p2 = new Point($x + $r, $y);
        $p3 = new Point($x, $y - $r);
        $p4 = new Point($x - $r, $y);

        if ($this->containPoint($p1) && $this->containPoint($p2) && 
            $this->containPoint($p3) && $this->containPoint($p4))
            return true;
        else
            return false;
    }

    /**
     * @var Point
     */
    private $_top_left_point;
    
    /**
     * @var Point
     */
    private $_bottom_right_point;

    /**
     * @var Point
     */
    private $_bottom_left_point;
    
    /**
     * @var Point
     */
    private $_top_right_point;

}