<?php

// Autoload files using the Composer autoloader.
require_once __DIR__ . '/../vendor/autoload.php';

use Application\Form;
use PHPUnit\Framework\TestCase;

final class MainPageTest extends TestCase
{
	public function testForm() {
		$actualClass = new Form();
        $this->assertIsString($actualClass->renderForm());
	}
}
