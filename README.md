#`hoffmann-oss/arrays-php`

A PHP 7 array manipulation library.

## Installation with Composer

Add the following to your project's `composer.json` file:
```json
"require": {
    "hoffmann-oss/arrays": "~1.0"
}
```

Run `composer update`

Include Composer's `autoload.php`:
```php
require_once 'vendor/autoload.php';
```

# The `Arrays` class

## create()
```
public static function &create(int $size, $item = null): array
```
### Example:
```php
$array = Arrays::create(5, 1000);
```

the resulting array:

```html
[1000, 1000, 1000, 1000, 1000]
```


## fill()
```
public static function fill(array &$array,
		$item = null,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$array1 = $array2 = [1, 2, 3, 4, 5, 6, 7, 8];
Arrays::fill($array1, 1000);
Arrays::fill($array2, 1000, 2, 6);
```

the resulting arrays:

```html
[1000, 1000, 1000, 1000, 1000, 1000, 1000, 1000]
[1, 2, 1000, 1000, 1000, 1000, 7, 8]
```


## replace()
```
public static function replace(array &$array,
		array $source,
		int $position = 0,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$array1 = $array2 = [1, 2, 3, 4, 5, 6, 7, 8];
$source = [1001, 1002, 1003, 1004, 1005];
Arrays::replace($array1, $source, 4);
Arrays::replace($array2, $source, 4, 2, 6);
```

the resulting arrays:

```html
[1, 2, 3, 4, 1001, 1002, 1003, 1004]
[1, 2, 3, 4, 1001, 1002, 7, 8]
```


## reverse()
```
public static function reverse(array &$array,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$array1 = $array2 = [1, 2, 3, 4, 5, 6, 7, 8];
Arrays::reverse($array1);
Arrays::reverse($array2, 2, 6);
```

the resulting arrays:

```html
[8, 7, 6, 5, 4, 3, 2, 1]
[1, 2, 6, 5, 4, 3, 7, 8]
```


## rotate()
```
public static function rotate(array &$array,
		int $distance,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$array1 = $array2 = [1, 2, 3, 4, 5, 6, 7, 8];
Arrays::rotate($array1, -2);
Arrays::rotate($array2, 2, 2, 6);
```

the resulting arrays:

```html
[7, 8, 1, 2, 3, 4, 5, 6]
[1, 2, 5, 6, 3, 4, 7, 8]
```


## shuffle()
```
public static function shuffle(array &$array,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$array1 = $array2 = [1, 2, 3, 4, 5, 6, 7, 8];
Arrays::shuffle($array1);
Arrays::shuffle($array2, 2, 6);
```

the resulting arrays:

```html
[4, 6, 1, 2, 8, 7, 5, 3]
[1, 2, 3, 5, 6, 4, 7, 8]
```


## swap()
```
public static function swap(array &$array,
		int $index1,
		int $index2)
```
### Example:
```php
$array = [1, 2, 3, 4];
Arrays::swap($array, 0, 1);
Arrays::swap($array, 1, 2);
Arrays::swap($array, 2, 3);
```

the resulting array:

```html
[2, 3, 4, 1]
```


## pick()
```
public static function pick(array $array,
		int $start = 0,
		int $stop = null)
```
### Example:
```php
$source = [1, 2, 3, 4, 5, 6, 7, 8];
$array1 = $array2 = [];
for ($i = 0; $i < 10; $i++) {
    $array1[] = Arrays::pick($source);
    $array2[] = Arrays::pick($source, 2, 6);
}
```

the resulting arrays:

```html
[8, 2, 1, 3, 3, 7, 3, 1, 7, 6]
[5, 3, 4, 6, 5, 4, 6, 3, 3, 6]
```


# The `Arrays2d` class
The functions of this class assumes
that the parameter `$array` is a rectangular array (y) of arrays (x).

## create()
```
public static function &create(int $width, int $height, $item = null): array
```
### Example:
```php
$array = Arrays2d::create(3, 3, 1000);
```

the resulting array:

```html
[
    [1000, 1000, 1000],
    [1000, 1000, 1000],
    [1000, 1000, 1000]
]
```


## fill()
```
public static function fill(array &$array,
		$item = null,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
Arrays2d::fill($array1, 1000);
Arrays2d::fill($array2, 1000, 1, 0, 3, 2);
```

the resulting arrays:

```html
[
    [1000, 1000, 1000],
    [1000, 1000, 1000],
    [1000, 1000, 1000]
]
[
    [1, 1000, 1000],
    [4, 1000, 1000],
    [7, 8, 9]
]
```


## replace()
```
public static function replace(array &$array,
		array $source,
		int $x = 0,
		int $y = 0,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
$source = [
    [1001, 1002, 1003],
    [1004, 1005, 1006],
    [1007, 1008, 1009]
];
Arrays2d::replace($array1, $source, 0, 0);
Arrays2d::replace($array2, $source, 0, 0, 1, 0, 3, 2);
```

the resulting arrays:

```html
[
    [1001, 1002, 1003],
    [1004, 1005, 1006],
    [1007, 1008, 1009]
]
[
    [1, 1002, 1003],
    [4, 1005, 1006],
    [7, 8, 9]
]
```


## reverseX()
```
public static function reverseX(array &$array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12]
];
Arrays2d::reverseX($array1);
Arrays2d::reverseX($array2, 1, 0, 4, 2);
```

the resulting arrays:

```html
[
    [4, 3, 2, 1],
    [8, 7, 6, 5],
    [12, 11, 10, 9]
]
[
    [1, 4, 3, 2],
    [5, 8, 7, 6],
    [9, 10, 11, 12]
]
```


## reverseY()
```
public static function reverseY(array &$array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12]
];
Arrays2d::reverseY($array1);
Arrays2d::reverseY($array2, 1, 0, 3, 3);
```

the resulting arrays:

```html
[
    [10, 11, 12],
    [7, 8, 9],
    [4, 5, 6],
    [1, 2, 3]
]
[
    [1, 8, 9],
    [4, 5, 6],
    [7, 2, 3],
    [10, 11, 12]
]
```


## rotateX()
```
public static function rotateX(array &$array,
		int $distance,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
Array columns rotate left if distance is greater than 0.
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12]
];
Arrays2d::rotateX($array1, 1);
Arrays2d::rotateX($array2, -1, 1, 0, 4, 2);
```

the resulting arrays:

```html
[
    [2, 3, 4, 1],
    [6, 7, 8, 5],
    [10, 11, 12, 9]
]
[
    [1, 4, 2, 3],
    [5, 8, 6, 7],
    [9, 10, 11, 12]
]
```


## rotateY()
```
public static function rotateY(array &$array,
		int $distance,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
Array rows rotate up if distance is greater than 0.
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12]
];
Arrays2d::rotateY($array1, 1);
Arrays2d::rotateY($array2, -1, 1, 0, 3, 3);
```

the resulting arrays:

```html
[
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12],
    [1, 2, 3]
]
[
    [1, 8, 9],
    [4, 2, 3],
    [7, 5, 6],
    [10, 11, 12]
]
```


## shuffle()
```
public static function shuffle(array &$array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
Arrays2d::shuffle($array1);
Arrays2d::shuffle($array2, 1, 0, 3, 2);
```

the resulting arrays:

```html
[
    [5, 2, 9],
    [3, 1, 4],
    [7, 8, 6]
]
[
    [1, 5, 3],
    [4, 6, 2],
    [7, 8, 9]
]
```


## shuffleX()
```
public static function shuffleX(array &$array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3, 4, 5],
    [6, 7, 8, 9, 10],
    [11, 12, 13, 14, 15]
];
Arrays2d::shuffleX($array1);
Arrays2d::shuffleX($array2, 1, 0, 5, 2);
```

the resulting arrays:

```html
[
    [3, 5, 1, 2, 4],
    [8, 10, 6, 7, 9],
    [13, 15, 11, 12, 14]
]
[
    [1, 5, 4, 2, 3],
    [6, 10, 9, 7, 8],
    [11, 12, 13, 14, 15]
]
```


## shuffleY()
```
public static function shuffleY(array &$array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12],
    [13, 14, 15]
];
Arrays2d::shuffleY($array1);
Arrays2d::shuffleY($array2, 1, 0, 3, 4);
```

the resulting arrays:

```html
[
    [4, 5, 6],
    [1, 2, 3],
    [10, 11, 12],
    [13, 14, 15],
    [7, 8, 9]
]
[
    [1, 11, 12],
    [4, 5, 6],
    [7, 8, 9],
    [10, 2, 3],
    [13, 14, 15]
]
```


## swap()
```
public static function swap(array &$array,
		int $x1,
		int $y1,
		int $x2,
		int $y2)
```
### Example:
```php
$array = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
Arrays2d::swap($array, 0, 1, 2, 0);
Arrays2d::swap($array, 0, 2, 2, 1);
```

the resulting array:

```html
[
    [1, 2, 4],
    [3, 5, 7],
    [6, 8, 9]
]
```


## swapX()
```
public static function swapX(array &$array,
		int $x1,
		int $x2,
		int $startY = 0,
		int $stopY = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 10, 11, 12]
];
Arrays2d::swapX($array1, 2, 3);
Arrays2d::swapX($array2, 2, 3, 0, 2);
```

the resulting arrays:

```html
[
    [1, 2, 4, 3],
    [5, 6, 8, 7],
    [9, 10, 12, 11]
]
[
    [1, 2, 4, 3],
    [5, 6, 8, 7],
    [9, 10, 11, 12]
]
```


## swapY()
```
public static function swapY(array &$array,
		int $y1,
		int $y2,
		int $startX = 0,
		int $stopX = null)
```
### Example:
```php
$array1 = $array2 = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12]
];
Arrays2d::swapY($array1, 2, 3);
Arrays2d::swapY($array2, 2, 3, 0, 2);
```

the resulting arrays:

```html
[
    [1, 2, 3],
    [4, 5, 6],
    [10, 11, 12],
    [7, 8, 9]
]
[
    [1, 2, 3],
    [4, 5, 6],
    [10, 11, 9],
    [7, 8, 12]
]
```


## pick()
```
public static function pick(array $array,
		int $startX = 0,
		int $startY = 0,
		int $stopX = null,
		int $stopY = null)
```
### Example:
```php
$source = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
$array1 = $array2 = [];
for ($i = 0; $i < 10; $i++) {
    $array1[] = Arrays2d::pick($source);
    $array2[] = Arrays2d::pick($source, 0, 0, 2, 2);
}
```

the resulting arrays:

```html
[5, 7, 8, 9, 2, 2, 6, 7, 5, 2]
[1, 2, 1, 4, 4, 4, 1, 2, 1, 2]
```