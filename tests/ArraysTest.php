<?php
namespace HoffmannOSS\Arrays\Tests;

require_once 'vendor/autoload.php';

use HoffmannOSS\Arrays\Arrays;
use PHPUnit\Framework\TestCase;

class ArraysTest extends TestCase
{
	const ARRAY_20 = [1, 2, 3, 4, 5 ,6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

	public function createProvider(): array
	{
		return [[5, 11, [11, 11, 11, 11, 11]], [5, null, [null, null, null, null, null]]];
	}

	/**
	 * @dataProvider createProvider
	 */
	public function testCreate(int $size, $item, array $expected)
	{
		$this->assertEquals($expected, Arrays::create($size, $item));
	}

	public function fillProvider(): array
	{
		return [
			[[1, 2, 3, 4, 5], 11, 2, 4, [1, 2, 11, 11, 5]],
			[[1, 2, 3, 4, 5], null, 2, 4, [1, 2, null, null, 5]],
			[[1, 2, 3, 4, 5], null, 0, null, [null, null, null, null, null]],
		];
	}

	/**
	 * @dataProvider fillProvider
	 */
	public function testFill(array $array, $item, $start, $stop, array $expected)
	{
		Arrays::fill($array, $item, $start, $stop);
		$this->assertEquals($expected, $array);
	}

	public function replaceProvider(): array
	{
		return [
			[[21, 22, 23], -4, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], -2, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 0, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 2, 4, 8, [1, 2, 3, 4, 23, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 4, 4, 8, [1, 2, 3, 4, 21, 22, 23, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 6, 4, 8, [1, 2, 3, 4, 5, 6, 21, 22, 9, 10, 11, 12]],
			[[21, 22, 23], 8, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 10, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 12, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 14, 4, 8, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[
				[21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36],
				-2, 4, 8, [1, 2, 3, 4, 27, 28, 29, 30, 9, 10, 11, 12]
			],
			[[21, 22, 23], -2, 0, null, [23, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]],
			[[21, 22, 23], 10, 0, null, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 21, 22]],
		];
	}

	/**
	 * @dataProvider replaceProvider
	 */
	public function testReplace(array $source, int $position, $start, $stop, array $expected)
	{
		$array = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
		Arrays::replace($array, $source, $position, $start, $stop);
		$this->assertEquals($expected, $array);
	}

	public function reverseProvider(): array
	{
		return [
			[[1, 2, 3, 4, 5], 1, 5, [1, 5, 4, 3, 2]],
			[[1, 2, 3, 4, 5], 1, 4, [1, 4, 3, 2, 5]],
			[[1, 2, 3, 4, 5], 1, 3, [1, 3, 2, 4, 5]],
			[[1, 2, 3, 4, 5], 1, 2, [1, 2, 3, 4, 5]],
			[[1, 2, 3, 4, 5], 0, 3, [3, 2, 1, 4, 5]],
			[[1, 2, 3, 4, 5], 0, null, [5, 4, 3, 2, 1]],
			[[1, 2, 3, 4], 1, 4, [1, 4, 3, 2]],
			[[1, 2, 3, 4], 1, 3, [1, 3, 2, 4]]
		];
	}

	/**
	 * @dataProvider reverseProvider
	 */
	public function testReverse(array $array, $start, $stop, array $expected)
	{
		Arrays::reverse($array, $start, $stop);
		$this->assertEquals($expected, $array);
	}

	public function rotateProvider(): array
	{
		return [
			[[1, 2, 3, 4, 5], 2, 1, 5, [1, 4, 5, 2, 3]],
			[[1, 2, 3, 4, 5], 5, 1, 4, [1, 4, 2, 3, 5]],
			[[1, 2, 3, 4, 5], -1, 1, 5, [1, 5, 2, 3, 4]],
			[[1, 2, 3, 4, 5], -4, 1, 4, [1, 4, 2, 3, 5]],
			[[1, 2, 3, 4, 5, 6, 7], 4, 0, null, [5, 6, 7, 1, 2, 3, 4]],
			[[1, 2, 3, 4, 5, 6, 7], -3, 0, null, [5, 6, 7, 1, 2, 3, 4]],
			[[1, 2, 3, 4, 5, 6, 7], -10, 0, null, [5, 6, 7, 1, 2, 3, 4]],
		];
	}

	/**
	 * @dataProvider rotateProvider
	 */
	public function testRotate(array $array, int $distance, $start, $stop, array $expected)
	{
		Arrays::rotate($array, $distance, $start, $stop);
		$this->assertEquals($array, $expected);
	}

	public function shuffleProvider(): array
	{
		return [[3, 16], [0, 13], [6, null], [0, null]];
	}

	/**
	 * @dataProvider shuffleProvider
	 */
	public function testShuffle($start, $stop)
	{
		$array = self::ARRAY_20;
		Arrays::shuffle($array, $start, $stop);
		$this->assertTrue(self::correctAreaShuffled($array, $start, $stop));
		$this->assertTrue($array != self::ARRAY_20, "shouldn't fail, but once in a blue moon");
		$this->assertTrue(sort($array) == self::ARRAY_20);
	}

	public function pickProvider(): array
	{
		return [
			[[1, 2, 3, 4, 5, 6], 1, 4],
			[[1, 2, 3, 4, 5, 6], 0, null]
		];
	}

	/**
	 * @dataProvider pickProvider
	 */
	public function testPick($array, $start, $stop)
	{

		$val = Arrays::pick($array, $start, $stop);
		$stop = $stop ?? count($array);
		$this->assertTrue($val > $start && $val <= $stop);
	}

	private static function correctAreaShuffled(array $array, $start, $stop): bool
	{
		if (is_null($stop)) {
			$stop = count(self::ARRAY_20);
		}
		foreach ($array as $i => $item) {
			if (($i < $start || $i >= $stop) && $item != self::ARRAY_20[$i]) {
				return false;
			}
		}
		return true;
	}
}
