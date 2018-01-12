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
    \$text = 'hello, world!';
CODE;

// preg_match()
$code1 = <<<CODE
    preg_match('/wor/', \$text);
CODE;

// strpos()
$code2 = <<<CODE
    strpos(\$text, 'wor');
CODE;

$ec = new ExecComparator();
$ec
    ->setCommon($common)
    ->setLoops(1000000)
    ->setSample1($code1, 'preg_match')
    ->setSample2($code2, 'strpos');

$ec->compare();

echo $ec->getResults('md');

// var_dump($ec);

/*
Code execution speed comparison

- loop times: 1000000
- sample1(preg_match) VS sample2(strpos)

DETAIL

item      sample 1   sample 2    diff(1 - 2)
time      0.536    0.48099     0.055 s
memory    0 b     0 b      0 k

RESULT

- Run faster is: strpos
- Consume more memory is: strpos
- Test the total time spent: 1.022 s

 */
