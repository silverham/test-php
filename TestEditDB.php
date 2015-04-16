<?php include("ProcessSubmission.php"); ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Test PHP and MySQL</title>
        <style>.error {color: red}</style>
    </head>
    <body>
        <h1> This pages tests adding and deleting of SQL records</h1>
        
        <p> Below is a list of the current records on the table: <br />
        To Delete a row, select one and click delete down below.</p>
        <p>
            <form action="" method="post">
            <table border=1>
            <tr><th>Select</th><th>id</th><th>First</th><th>Last</th><th>Age</th></tr>
        <?php 
            //retrieve data
            $resultLine = $DbClass->select("test", "ID = 1", true);
            $i = 0;
            foreach ($resultLine as $oneResult) {
                echo "<tr>";
                $result = array_values($oneResult); //convert from assocative array to numeric(normal) array
                echo "<td> <input type=\"radio\" name=\"id\" value=\"$result[0]\" />";
                for ($i2 = 0; $i2 < (count($oneResult)); $i2++){
                echo "<td>";
                    //echo "$i2";
                    echo $result[$i2];                    
                    echo "</td>";
                }
                echo "</tr>"; 
                $i += 1;
            }
            echo "</table>";
                    echo "<br /> <b>Total rows: $i<b>"
        ?>
            <br />
            <input type="submit" name="delete" value="Delete">
            <span class="error"><br /><?php echo $deleteError ?></span>
        </form>
        </p>
        <br />
        <p>
            To add to the database, fill out the boxes below and select "Add" (age is validated):
            <form action="" method="post">
                First Name <input type="text" name="firstName" value="<?php echo $firstName ?>"  />&nbsp;
                Last Name <input type="text" name="lastName" value="<?php echo $lastName ?>" />&nbsp;
                Age <input type="text" name="age" value="<?php echo $age?>" /> <br />
                <input type="submit" name="add" value="Add">
                <span class="error"><br /><?php echo $ageError ?></span>
            </form>
            
        </p>
    </body>
</html>
