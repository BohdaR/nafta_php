<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $x = 1.62;
        $a = 1.62;
        if ($a = $x) {
            $y = exp(abs($x + $a)) * sin($x);
            echo "<h1>Y1= {$y}</h1>";
        }

        $x = 1.41;
        if ($a < $x and $x < $a*$a) {
            $y = ($x - $a)**2 * cos($x)**2;
            echo "<h1>Y2= {$y}</h1>";
        }

        $a = 4.55;
        $b = 7.53;
        $start = 4.8;
        $end = 0.25;
        $x = $start;
        $n = 5;
        $step = ($end - $start) / $n;
        $i = 0;
        while ($i < $n) {
            $r = exp(($x**2 - $a) / sin($x)) * ($b * (log(($x + 0.6)) / $x))**0.5;
            echo "<h5>R = {$r}</h5>";
            $x += $step;
            $i++;
        }
    ?>
</body>
</html>