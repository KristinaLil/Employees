<?php

include("db.php");

$sql = "SELECT * FROM employees WHERE id=?";
$result = $pdo->prepare($sql);
$result->execute([$_GET['id']]);

$employees = $result->fetchAll(PDO::FETCH_ASSOC);


foreach ($employees as $employee) {
    $ts = $employee['salary'] / 100;
    $npd = round(540 - 0.34 * ($ts - 730), 2);
    $salary = $ts - $npd;
    $gpm = round($salary / 100 * 20, 2);
    $psd = round($ts / 100 * 6.98, 2);
    $sodra = round($ts / 100 * 12.52, 2);
    $pf = round($ts / 100 * 3, 2);
    $vsd = round($salary / 100 * 1.77, 2);
    $gf = round($salary / 100 * 0.2, 2);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="container" tabindex="-1">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h1><?= $employee['name'] . " " . $employee['surname'] ?></h1>
                </div>
            </div>
            <div class="col-md-6">
                <p>
                    <b>Position: </b> <br /> -
                </p>
                <p>
                    <b>Salary: </b> <br /><?= $employee['salary'] / 100 ?> EUR
                </p>
            </div>
            <div class="col-md-6">
                <p>
                    <b>Phone: </b> <br /> <?= $employee['phone'] ?>
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
                <div class="primary">
                    <div class="heading">Taxes</div>
                    <table class="table table-hover">
                        <tr>
                            <td>Total salary (before taxes):</td>
                            <td class="right"><?= $employee['salary'] / 100 ?> EUR</td>
                        </tr>
                        <tr>
                            <td>NPD</td>
                            <td class="right"><?= $npd ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Pajamų mokestis 20 %</td>
                            <td class="right"><?= $gpm ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Sodra. Sveikatos draudimas 6 %</td>
                            <td class="right"><?= $psd ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Sodra. Pensijų ir soc. draudimas 12,52 % + 3 %</td>
                            <td class="right"><?= $pf ?> EUR</td>
                        </tr>

                        <tr class="info">
                            <td>Total salary (after taxes):</td>
                            <td class="right"><b><?= $ts - $gpm - $psd - $pf - $sodra ?> EUR</b></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Darbo vietos kaina</b></td>
                        </tr>
                        <tr>
                            <td>Sodra 1.77 %:</td>
                            <td class="right"><?= $vsd ?> EUR</td>
                        </tr>
                        <tr>
                            <td>Įmokos į garantinį fondą 0.2 % :</td>
                            <td class="right"><?= $gf ?> EUR</td>
                        </tr>
                        <tr class="info">
                            <td>Visa darbo vietos kaina :</td>
                            <td class="right"><b><?= $ts + $vsd + $gf ?> EUR</b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>