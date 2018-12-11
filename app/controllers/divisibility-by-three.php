<?php

$numarray = count($argv) > 1 ? $argv[1] : '32469';
$numarraylength = strlen($numarray);
$divisiblebythree = [];
$tempdivisiblebythree = [];
$substr = [];
$substringlength = 1;
echo 'Test string: '.$numarray.PHP_EOL;
for ($counter = 0; $counter < $numarraylength; ++$counter) {
    echo 'Outer Loop '.($counter + 1).PHP_EOL;
    $maxrounds = $numarraylength - $substringlength + 1;
    for ($startindex = 0; $startindex < $maxrounds; ++$startindex) {
        $testnum = substr($numarray, $startindex, $substringlength);
        $substr[] = $testnum;
        if ($testnum % 3 == 0) {
            if (!in_array($testnum, $divisiblebythree)) {
                $divisiblebythree[] = $testnum;
                $tempdivisiblebythree[] = $testnum;
            }
        }
    }
    echo "\t".'Substrings: ';
    echo implode(', ', $substr).PHP_EOL;
    echo "\t".'Divisible by Three: ';
    echo implode(', ', $tempdivisiblebythree).PHP_EOL.PHP_EOL;
    $substr = [];
    $tempdivisiblebythree = [];
    ++$substringlength;
    $temp;
}
echo '======================================================='.PHP_EOL;
echo 'All Substrings divisible by Three: '.PHP_EOL;
echo "\t";
echo implode(', ', $divisiblebythree).PHP_EOL.PHP_EOL;
