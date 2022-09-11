<?php
include("db.php");
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $sql = "UPDATE employees SET name=?, surname=?, gender=?, phone=?, birthday=?, education=?, salary=? WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['phone'], $_POST['birthday'], $_POST['education'], $_POST['salary'], $_POST['id']]);
    header("location:employees_wage.php");
    die();
}
$employee = [];
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM employees WHERE id=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$_GET['id']]);
    $employee = $stm->fetch(PDO::FETCH_ASSOC);
} else {
    header("location:employees_wage.php");
    die();
}

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
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                            <div class="mb-3">
                                <label for="" class="form-label">Name:</label>
                                <input name="name" type="text" class="form-control" value="<?= $employee['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Surname:</label>
                                <input name="surname" type="text" class="form-control" value="<?= $employee['surname'] ?>">
                            </div>
                            <div class="mb-3">
                            <label for="" class="form-label">Gender:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="women" checked>
                                    <label class="form-check-label" for="women">
                                        Women
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" value="men">
                                    <label class="form-check-label" for="men">
                                        Men
                                    </label>
                                </div>                              
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone:</label>
                                <input name="phone" type="text" class="form-control" value="<?= $employee['phone'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Birthday:</label>
                                <input name="birthday" type="date" class="form-control" value="<?= $employee['birthday'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Education:</label>
                                <input name="education" type="text" class="form-control" value="<?= $employee['education'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Salary:</label>
                                <input name="salary" type="text" class="form-control" value="<?= $employee['salary'] ?>">
                            </div>
                            <button class="btn btn-success" type="submit" value="submit">Edit</button>
                            <a href="employees_wage.php" class="btn btn-info float-end">Go back</a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>