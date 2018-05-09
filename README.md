# Some components for console

[![License](https://img.shields.io/packagist/l/inhere/console.svg?style=flat-square)](LICENSE)
[![Php Version](https://img.shields.io/badge/php-%3E=7.0-brightgreen.svg?maxAge=2592000)](https://packagist.org/packages/inhere/console)
[![Latest Stable Version](http://img.shields.io/packagist/v/inhere/console.svg)](https://packagist.org/packages/inhere/console)

## some utils

- ascii font
- sepcial char 
- char animation

### 代码执行比较器

```php

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
// var_dump(CliUtil::getTempDir());die;
$ec = new ExecComparator();
$ec
    ->setCommon($common)
    ->setLoops(1000000)
    ->setSample1($code1, 'preg_match')
    ->setSample2($code2, 'strpos');

$ec->compare();

echo $ec->getResults();
```

运行示例： `php examples/exec_compare.php`

结果：

```text
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

```

## Unit testing

```bash
phpunit
```

## License

MIT

