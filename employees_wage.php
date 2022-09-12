<?php

include("db.php");

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sql = "DELETE FROM employees WHERE id=?";
    $pstm = $pdo->prepare($sql);
    $pstm->execute([$_GET['id']]);
}

$sql="SELECT id,name,surname,gender,phone,birthday,education,salary,position_id FROM employees ORDER BY id ASC";
$pstm=$pdo->prepare($sql);
$pstm->execute([]);
$employees=$pstm->fetchAll(PDO::FETCH_ASSOC);

$sql2="SELECT id,name,base_salary FROM positions ORDER BY id ASC";
$pstm2=$pdo->prepare($sql2);
$pstm2->execute([]);
$positions=$pstm2->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT employees.*,positions.name as position_name FROM employees LEFT JOIN positions ON employees.position_id=positions.id ORDER BY name ASC";
$pstm=$pdo->prepare($sql);
$pstm->execute([]);
$employees=$pstm->fetchAll(PDO::FETCH_ASSOC);

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
                    <a href="new.php" class="btn  btn-secondary mb-3 ">Insert new employee</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Name</td>
                                    <td>Surname</td>
                                    <td>Gender</td>
                                    <td>Phone</td>
                                    <td>Birthday</td>
                                    <td>Education</td>
                                    <td>Salary</td>
                                    <td>Position</td>
                                    <td>Projects</td>
                                    <td></td>               
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($employees as $employee) { ?>
                                    <tr>
                                        <td><?= $employee['id'] ?></td>
                                        <td><?= $employee['name'] ?></td>
                                        <td><?= $employee['surname'] ?></td>
                                        <td><?= $employee['gender'] ?></td>
                                        <td><?= $employee['phone'] ?></td>
                                        <td><?= $employee['birthday'] ?></td>
                                        <td><?= $employee['education'] ?></td>
                                        <td><?= round($employee['salary'] / 100) ?> eur</td>
                                        <td><?= $employee['position_name'] ?></td>
                                        <td></td>
                                        <td>
                                            <a href="employee_info.php?id=<?=$employee['id']?>" class="btn btn-success">More</a>
                                            <a href="edit.php?id=<?=$employee['id']?>" class="btn btn-warning">Edit</a>
                                            <a href="employees_wage.php?action=delete&id=<?=$employee['id']?>" class="btn btn-danger">Delete</a>
                                        </td>

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
                                                        <td><?= $position['id'] ?></td>
                                                        <td><?= $position['name'] ?></td>
                                                        <td><?= $baseSalary ?> EUR</td>
                                                        <td><a href="#" class="btn btn-secondary">Employees</a></td>                                                      
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