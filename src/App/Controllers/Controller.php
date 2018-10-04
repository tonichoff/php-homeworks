<?php

namespace App\Controllers;
use App\Views\View;
use phpDocumentor\Reflection\Types\Integer;

abstract class Controller
{
	protected $_route;
	protected $_view;

	public function __construct($route)
	{
		$this->_route = $route;
		$this->_view = new View($route);
	}
}