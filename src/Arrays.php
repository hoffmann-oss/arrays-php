<?php

namespace HoffmannOSS\Arrays;

final class Arrays
{
	private function __construct() {}

	public static function &create(int $size, $item = null): array
	{
		$array = array();
		for ($i = 0; $i < $size; $i++) {
			$array[$i] = $item;
		}
		return $array;
	}

	public static function fill(array &$array, $item = null, int $start = 0, int $stop = null)
	{
		$stop = $stop ?? count($array);
		for ($i = $start; $i < $stop; $i++) {
			$array[$i] = $item;
		}
	}

	public static function replace(array &$array, array $source, int $position = 0,
			int $start = 0, int $stop = null)
	{
		$start = max($start, $position);
		$startSrc = $start - $position;
		$stop = min($position + count($source), $stop ?? count($array));
		for ($i = $start, $k = $startSrc; $i < $stop; $i++, $k++) {
			$array[$i] = $source[$k];
		}
	}

	public static function reverse(array &$array, int $start = 0, int $stop = null)
	{
		$stop = $stop ?? count($array);
		$last = $stop - 1;
		$stop = ($stop - $start) / 2 + $start;
		for ($i = $start, $k = $last; $i < $stop; $i++, $k--) {
			self::swap($array, $i, $k);
		}
	}

	/**
	 * Array items rotate left if $distance is greater than 0.
	 */
	public static function rotate(array &$array, int $distance, int $start = 0, int $stop = null)
	{
		$stop = $stop ?? count($array);
		$rotateLeft = $distance > 0;
		$distance = abs($distance) % ($stop - $start);
		$index = $rotateLeft ? $start + $distance : $stop - $distance;
		self::reverse($array, $start, $index);
		self::reverse($array, $index, $stop);
		self::reverse($array, $start, $stop);
	}

	public static function shuffle(array &$array, int $start = 0, int $stop = null)
	{
		$stop = $stop ?? count($array);
		for ($i = $start; $i < $stop; $i++) {
			self::swap($array, $i, rand($start, $stop - 1));
		}
	}

	public static function swap(array &$array, int $index1, int $index2)
	{
		$item = $array[$index1];
		$array[$index1] = $array[$index2];
		$array[$index2] = $item;
	}

	public static function pick(array $array, int $start = 0, int $stop = null)
	{
		$stop = $stop ?? count($array);
		return $array[rand($start, $stop - 1)];
	}
}