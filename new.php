<?php
 include ("db.php");
  if (isset($_POST['action']) && $_POST['action']=='insert'){
    try{
        
        $sql="INSERT INTO employees (name,surname,gender,phone,birthday,education,salary) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stm=$pdo->prepare($sql);
        $stm->execute([ $_POST['name'], $_POST['surname'], $_POST['gender'], $_POST['phone'], $_POST['birthday'], $_POST['education'], $_POST['salary']]);
        header("location:employees_wage.php");
        die();
    }catch(Exception $e){
        
        $error="Error: ".$e->getMessage();
    }
  
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
                    <div class="card-header">Insert new employee</div>
                    <div class="card-body">
                        <?php
                            if (isset($error)){
                                ?>
                                <div class="alert alert-danger"><?=$error?></div>
                                
                                <?php
                            }
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="insert"> 
                            <div class="mb-3">
                                <label for="" class="form-label">Name:</label>
                                <input name="name" type="text" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Surname:</label>
                                <input name="surname" type="text" class="form-control" >
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
                                <input name="phone" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Birthday:</label>
                                <input name="birthday" type="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Education:</label>
                                <input name="education" type="text" class="form-control"  >
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Salary:</label>
                                <input name="salary" type="text" class="form-control"  >
                            </div>
                            <button class="btn btn-success" value="submit" type="submit">Add</button>
                            <a href="employees_wage.php" class="btn btn-info float-end">Go back</a>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>