<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2018-01-10
 * Time: 19:36
 */

use Inhere\Console\Components\ExecComparator;

require dirname(__DIR__) . '/tests/boot.php';

$common = <<<CODE
    \$path = 'users.*.id';
    \$pos = strpos(\$path, '.*');
CODE;

// preg_match()
$code1 = <<<CODE
    \$pos = strpos(\$path, '.*');
    \$before = substr(\$path, 0, \$pos);
    \$after = substr(\$path, \$pos + 1);
CODE;

// explode('.', $path);
$code2 = <<<CODE
    list(\$before, \$after) = explode('.', \$path);
CODE;

$ec = new ExecComparator();
$ec
    ->setCommon($common)
    ->setLoops(1000000)
    ->setSample1($code1, 'strpos+substr')
    ->setSample2($code2, 'explode+list');

$ec->compare();

echo $ec->getResults('md');

// var_dump($ec);

/*

# Code execution speed comparison

- loop times: 1000000
- sample1(strpos+substr) VS sample2(explode+list)

## Detail

 item   | sample 1 | sample 2 |  diff(1 - 2)
--------|----------|----------|--------------
 time   | 1.43082  |  0.63929 | 0.7915 s
 memory | 0 b |   0 b | 0 k

## Result

- Run faster is: explode+list
- Consume more memory is: explode+list
- Test the total time spent: 2.076 s
Process finished with exit code 0

 */
