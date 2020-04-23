<?php
namespace HoffmannOSS\Arrays;

final class Arrays2d
{

    private function __construct()
    {}

    public static function &create(int $width, int $height, $item = null): array
    {
        $array = array();
        for ($y = 0; $y < $height; $y ++) {
            $array[$y] = array();
            for ($x = 0; $x < $width; $x ++) {
                $array[$y][$x] = $item;
            }
        }
        return $array;
    }

    public static function fill(array &$array, $item = null, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        for ($y = $startY; $y < $stopY; $y ++) {
            for ($x = $startX; $x < $stopX; $x ++) {
                $array[$y][$x] = $item;
            }
        }
    }

    public static function replace(array &$array, array $source, int $x = 0, int $y = 0, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        $startX = max($startX, $x);
        $startY = max($startY, $y);
        $startXSrc = $startX - $x;
        $startYSrc = $startY - $y;
        $stopX = min($x + count($source[0]), $stopX ?? count($array[0]));
        $stopY = min($y + count($source), $stopY ?? count($array));
        for ($iy = $startY, $ky = $startYSrc; $iy < $stopY; $iy ++, $ky ++) {
            for ($ix = $startX, $kx = $startXSrc; $ix < $stopX; $ix ++, $kx ++) {
                $array[$iy][$ix] = $source[$ky][$kx];
            }
        }
    }

    public static function reverseX(array &$array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $last = $stopX - 1;
        $stop = ($stopX - $startX) / 2 + $startX;
        for ($x1 = $startX, $x2 = $last; $x1 < $stop; $x1 ++, $x2 --) {
            self::swapX($array, $x1, $x2, $startY, $stopY);
        }
    }

    public static function reverseY(array &$array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $last = $stopY - 1;
        $stop = ($stopY - $startY) / 2 + $startY;
        for ($y1 = $startY, $y2 = $last; $y1 < $stop; $y1 ++, $y2 --) {
            self::swapY($array, $y1, $y2, $startX, $stopX);
        }
    }

    /**
     * Array items rotate left if distance is greater than 0.
     */
    public static function rotateX(array &$array, int $distance, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $rotateLeft = $distance > 0;
        $distance = abs($distance) % ($stopX - $startX);
        $x = $rotateLeft ? $startX + $distance : $stopX - $distance;
        self::reverseX($array, $startX, $startY, $x, $stopY);
        self::reverseX($array, $x, $startY, $stopX, $stopY);
        self::reverseX($array, $startX, $startY, $stopX, $stopY);
    }

    /**
     * Array items rotate up if distance is greater than 0.
     */
    public static function rotateY(array &$array, int $distance, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $rotateUp = $distance > 0;
        $distance = abs($distance) % ($stopY - $startY);
        $y = $rotateUp ? $startY + $distance : $stopY - $distance;
        self::reverseY($array, $startX, $startY, $stopX, $y);
        self::reverseY($array, $startX, $y, $stopX, $stopY);
        self::reverseY($array, $startX, $startY, $stopX, $stopY);
    }

    public static function shuffle(array &$array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $lastX = $stopX - 1;
        $lastY = $stopY - 1;
        for ($y = $startY; $y < $stopY; $y ++) {
            for ($x = $startX; $x < $stopX; $x ++) {
                self::swap($array, $x, $y, rand($startX, $lastX), rand($startY, $lastY));
            }
        }
    }

    public static function shuffleX(array &$array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $lastX = $stopX - 1;
        for ($x = $startX; $x < $stopX; $x ++) {
            self::swapX($array, $x, rand($startX, $lastX), $startY, $stopY);
        }
    }

    public static function shuffleY(array &$array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        $lastY = $stopY - 1;
        for ($y = $startY; $y < $stopY; $y ++) {
            self::swapY($array, $y, rand($startY, $lastY), $startX, $stopX);
        }
    }

    public static function swap(array &$array, int $x1, int $y1, int $x2, int $y2)
    {
        $item = $array[$y1][$x1];
        $array[$y1][$x1] = $array[$y2][$x2];
        $array[$y2][$x2] = $item;
    }

    public static function swapX(array &$array, int $x1, int $x2, int $startY = 0, int $stopY = null)
    {
        $stopY = $stopY ?? count($array);
        for ($y = $startY; $y < $stopY; $y ++) {
            self::swap($array, $x1, $y, $x2, $y);
        }
    }

    public static function swapY(array &$array, int $y1, int $y2, int $startX = 0, int $stopX = null)
    {
        $stopX = $stopX ?? count($array[0]);
        for ($x = $startX; $x < $stopX; $x ++) {
            self::swap($array, $x, $y1, $x, $y2);
        }
    }

    public static function pick(array $array, int $startX = 0, int $startY = 0, int $stopX = null, int $stopY = null)
    {
        self::prepare($array, $stopX, $stopY);
        return $array[rand($startX, $stopX - 1)][rand($startY, $stopY - 1)];
    }

    public static function flatten(array $array): array
    {
        $array1d = [];
        foreach ($array as $row) {
            $array1d = array_merge($array1d, $row);
        }
        return $array1d;
    }

    private static function prepare(array $array, &$stopX, &$stopY)
    {
        $stopX = $stopX ?? count($array[0]);
        $stopY = $stopY ?? count($array);
    }
}
