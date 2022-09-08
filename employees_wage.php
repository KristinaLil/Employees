<?php

include("db.php");

$sql = "SELECT id,name,surname,phone,education,salary FROM employees ORDER BY id ASC";
$result = $pdo->query($sql);
$employees = $result->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT id,name,base_salary FROM positions ORDER BY id ASC";
$result2 = $pdo->query($sql2);
$positions = $result2->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">Employees</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Surname</td>
                                    <td>Phone</td>
                                    <td>Education</td>
                                    <td>Salary</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $employee) { ?>
                                    <tr>
                                        <td><?= $employee['id'] ?></td>
                                        <td><?= $employee['name'] ?></td>
                                        <td><?= $employee['surname'] ?></td>
                                        <td><?= $employee['phone'] ?></td>
                                        <td><?= $employee['education'] ?></td>
                                        <td><?= round($employee['salary'] / 100) ?> eur</td>
                                        <td><a href="employee_info.php" class="btn btn-info">More</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-5">
                                    <div class="card-header">Positions</div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>ID</td>
                                                    <td>Name</td>
                                                    <td>Base salary</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($positions as $position) {
                                                    $baseSalary = $position['base_salary'] / 100;
                                                ?>
                                                    <tr>
                                                        <td><?= $position['name'] ?></td>
                                                        <td><?= $baseSalary ?> EUR</td>
                                                        <td><a href="#" class="btn btn-primary">Employees</a></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>