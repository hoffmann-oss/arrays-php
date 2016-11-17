<?php

namespace HoffmannOSS\Arrays\Tests;

require_once 'vendor/autoload.php';

use HoffmannOSS\Arrays\Arrays2d;
use PHPUnit\Framework\TestCase;

class Arrays2dTest extends TestCase
{
	private static $array3x2;
	private static $array3x3;
	private static $array4x5;
	private static $array5x4;
	private static $array5x5;
	private static $array20x20;

	public static function setUpBeforeClass() {

		self::$array3x2 = self::buildTestArray(3, 2);
		self::$array3x3 = self::buildTestArray(3, 3);
		self::$array4x5 = self::buildTestArray(4, 5);
		self::$array5x4 = self::buildTestArray(5, 4);
		self::$array5x5 = self::buildTestArray(5, 5);
		self::$array20x20 = self::buildTestArray(20, 20);
	}

	public function createProvider(): array
	{
		return [
			[3, 2, 1, [[1, 1, 1], [1, 1, 1]]],
			[3, 2, null, [[null, null, null], [null, null, null]]]
		];
	}

	/**
	 * @dataProvider createProvider
	 */
	public function testCreate(int $width, int $height, $item, array $expected)
	{
		$this->assertEquals($expected, Arrays2d::create($width, $height, $item));
	}

	public function fillProvider(): array
	{
		return [
			[11, 1, 1, 3, 2, [[1, 2, 3], [4, 11, 11]]],
			[null, 1, 1, 3, 2, [[1, 2, 3], [4, null, null]]],
			[null, 0, 0, null, null, [[null, null, null], [null, null, null]]]
		];
	}

	/**
	 * @dataProvider fillProvider
	 */
	public function testFill($item, $startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array3x2;
		Arrays2d::fill($array, $item, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function replaceProvider(): array
	{
		return [
			[
				[
					[101, 102],
					[103, 104]
				],
				-1, 0, 1, 1, 4, 4,
				[
					[1, 2, 3, 4, 5],
					[6, 7, 8, 9, 10],
					[11, 12, 13, 14, 15],
					[16, 17, 18, 19, 20],
					[21, 22, 23, 24, 25]
				]
			],
			[
				[
					[101, 102],
					[103, 104]
				],
				0, 1, 1, 1, 4, 4,
				[
					[1, 2, 3, 4, 5],
					[6, 102, 8, 9, 10],
					[11, 104, 13, 14, 15],
					[16, 17, 18, 19, 20],
					[21, 22, 23, 24, 25]
				]
			],
			[
				[
					[101, 102],
					[103, 104]
				],
				2, 3, 1, 1, 4, 4,
				[
					[1, 2, 3, 4, 5],
					[6, 7, 8, 9, 10],
					[11, 12, 13, 14, 15],
					[16, 17, 101, 102, 20],
					[21, 22, 23, 24, 25]
				]
			],
			[
				[
					[101, 102],
					[103, 104]
				],
				-10, 10, 1, 1, 3, 3,
				[
					[1, 2, 3, 4, 5],
					[6, 7, 8, 9, 10],
					[11, 12, 13, 14, 15],
					[16, 17, 18, 19, 20],
					[21, 22, 23, 24, 25]
				]
			],
		];
	}

	/**
	 * @dataProvider replaceProvider
	 */
	public function testReplace(array $source, int $x, int $y,
			$startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array5x5;
		Arrays2d::replace($array, $source, $x, $y, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function reverseXProvider(): array
	{
		return [
			[
				1, 1, 4, 4,
				[
					[1, 2, 3, 4, 5],
					[6, 9, 8, 7, 10],
					[11, 14, 13, 12, 15],
					[16, 19, 18, 17, 20],
					[21, 22, 23, 24, 25]
				]
			],
			[
				0, 0, null, null,
				[
					[5, 4, 3, 2, 1],
					[10, 9, 8, 7, 6],
					[15, 14, 13, 12, 11],
					[20, 19, 18, 17, 16],
					[25, 24, 23, 22, 21]
				]
			],
		];
	}

	/**
	 * @dataProvider reverseXProvider
	 */
	public function testReverseX($startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array5x5;
		Arrays2d::reverseX($array, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function reverseYProvider(): array
	{
		return [
			[
				1, 1, 4, 4,
				[
					[1, 2, 3, 4, 5],
					[6, 17, 18, 19, 10],
					[11, 12, 13, 14, 15],
					[16, 7, 8, 9, 20],
					[21, 22, 23, 24, 25]
				]
			],
			[
				0, 0, null, null,
				[
					[21, 22, 23, 24, 25],
					[16, 17, 18, 19, 20],
					[11, 12, 13, 14, 15],
					[6, 7, 8, 9, 10],
					[1, 2, 3, 4, 5]
				]
			],
		];
	}

	/**
	 * @dataProvider reverseYProvider
	 */
	public function testReverseY($startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array5x5;
		Arrays2d::reverseY($array, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function rotateXProvider(): array
	{
		return [
			[
				1, 1, 1, 4, 3,
				[
					[1, 2, 3, 4, 5],
					[6, 8, 9, 7, 10],
					[11, 13, 14, 12, 15],
					[16, 17, 18, 19, 20]
				]
			],
			[
				-2, 0, 0, null, null,
				[
					[4, 5, 1, 2, 3],
					[9, 10, 6, 7, 8],
					[14, 15, 11, 12, 13],
					[19, 20, 16, 17, 18]
				]
			],
		];
	}

	/**
	 * @dataProvider rotateXProvider
	 */
	public function testRotateX(int $distance, $startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array5x4;
		Arrays2d::rotateX($array, $distance, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function rotateYProvider(): array
	{
		return [
			[
				1, 1, 1, 3, 4,
				[
					[1, 2, 3, 4],
					[5, 10, 11, 8],
					[9, 14, 15, 12],
					[13, 6, 7, 16],
					[17, 18, 19, 20]
				]
			],
			[
				-2, 0, 0, null, null,
				[
					[13, 14, 15, 16],
					[17, 18, 19, 20],
					[1, 2, 3, 4],
					[5, 6, 7, 8],
					[9, 10, 11, 12]
				]
			],
		];
	}

	/**
	 * @dataProvider rotateYProvider
	 */
	public function testRotateY(int $distance, $startX, $startY, $stopX, $stopY, array $expected)
	{
		$array = self::$array4x5;
		Arrays2d::rotateY($array, $distance, $startX, $startY, $stopX, $stopY);
		$this->assertEquals($expected, $array);
	}

	public function shuffleProvider(): array
	{
		return [
			[1, 1, 18, 18],
			[0, 0, null, null],
		];
	}

	/**
	 * @dataProvider shuffleProvider
	 */
	public function testShuffle($startX, $startY, $stopX, $stopY)
	{
		self::tstShuffle($startX, $startY, $stopX, $stopY);
	}

	/**
	 * @dataProvider shuffleProvider
	 */
	public function testShuffleX($startX, $startY, $stopX, $stopY)
	{
		self::tstShuffle($startX, $startY, $stopX, $stopY, 'shuffleX', 'xShuffled');
	}

	/**
	 * @dataProvider shuffleProvider
	 */
	public function testShuffleY($startX, $startY, $stopX, $stopY)
	{
		self::tstShuffle($startX, $startY, $stopX, $stopY, 'shuffleY', 'yShuffled');
	}

	public function testFlatten()
	{
		$this->assertEquals([1, 2, 3, 4, 5, 6], Arrays2d::flatten([[1, 2, 3], [4, 5, 6]]));
	}

	public function pickProvider(): array
	{
		return [
			[10, 5, 1, 1, 4, 4],
			[5, 5, 0, 0, null, null]
		];
	}

	/**
	 * @dataProvider pickProvider
	 */
	public function testPick($width, $height, $startX, $startY, $stopX, $stopY)
	{

		$array = self::buildTestArray($width, $height);
		$val = Arrays2d::pick($array, $startX, $startY, $stopX, $stopY);
		self::prepare($array, $stopX, $stopY);
		$this->assertTrue(
				($val % $width > $startX || ($width == $stopX ? $val % $width == 0 : false))
				&& $val > $startY * $width
				&& $val <= $stopY * $width);
	}

	private function tstShuffle($startX, $startY, $stopX, $stopY,
			string $shuffleMethod = 'shuffle', string $testFunction = null)
	{
		$compare = &self::$array20x20;
		$array = $compare;

		// Method to be tested
		Arrays2d::$shuffleMethod($array, $startX, $startY, $stopX, $stopY);

		self::prepare($array, $stopX, $stopY);

		// Test function for shuffleX, shuffleY
		if (!is_null($testFunction)) {
			$this->assertTrue(self::$testFunction($array, $startX, $startY, $stopX, $stopY));
		}

		$this->assertTrue(self::correctAreaShuffled($array, $startX, $startY, $stopX, $stopY));

		// Differs $array from $array1?
		$this->assertTrue($array != $compare, "shouldn't fail, but once in a blue moon");

		// Is $array a permutation of $array1?
		$flattened = Arrays2d::flatten($array);
		$this->assertTrue(sort($flattened) == Arrays2d::flatten($compare));
	}

	private static function correctAreaShuffled(
			array $array, $startX, $startY, $stopX, $stopY): bool
	{
		$stopY = $stopY ?? count(self::$array20x20);
		$stopX = $stopX ?? count(self::$array20x20[0]);
		foreach ($array as $y => $row) {
			foreach ($row as $x => $item) {
				if ($item != self::$array20x20[$y][$x]
						&& ($x < $startX || $x >= $stopX)
						&& ($y < $startY || $y >= $stopY)) {
					return false;
				}
			}
		}
		return true;
	}

	private static function xShuffled(array $array, $startX, $startY, $stopX, $stopY): bool
	{
		$delta = count($array[0]);
		for ($x = $startX; $x < $stopX; $x++) {
			for ($y = $startY + 1; $y < $stopY; $y++) {
				if ($array[$y][$x] != $array[$y-1][$x] + $delta) return false;
			}
		}
		return true;
	}

	private static function yShuffled(array $array, $startX, $startY, $stopX, $stopY): bool
	{
		for ($y = $startY; $y < $stopY; $y++) {
			for ($x = $startY + 1; $x < $stopX; $x++) {
				if ($array[$y][$x] != $array[$y][$x-1] + 1) return false;
			}
		}
		return true;
	}

	/* buildTestArray(3, 2): [[1, 2, 3], [4, 5, 6]] */
	private static function buildTestArray(int $width, int $height)
	{
		$val = 1;
		$array = [];
		for ($y = 0; $y < $height; $y++) {
			$array[$y] = [];
			for ($x = 0; $x < $width; $x++) {
				$array[$y][$x] = $val++;
			}
		}
		return $array;
	}

	private static function prepare(array $array, &$stopX, &$stopY)
	{
		$stopX = $stopX ?? count($array[0]);
		$stopY = $stopY ?? count($array);
	}
}