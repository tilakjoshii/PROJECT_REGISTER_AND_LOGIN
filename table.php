<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: index.php?error=access denied please login first');
    exit();
}

// Rest of your dashboard.php code goes here
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>table_in_php</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            width: 80%;
            margin: 20px auto;
        }

        .container h1 {
            text-align: center;
            text-decoration: underline;
            color: rgb(30, 30, 30);
        }

        .button {
            text-decoration: none;
            border: 2px solid green;
            padding: 5px;

        }

        .button:hover {
            background-color: rgb(136, 220, 254);
        }

        table {
            margin-bottom: 10px;

        }

        table,
        th,
        td,
        tr {
            border: 2px solid purple;
            border-collapse: collapse;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Details Table</h1>
        <table>
            <tr>
                <th>SN</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EMAIL ADDRESS</th>
                <th>PHONE NUMBER</th>
                <th>WEBSITE</th>
                <th>DATE_TIME</th>
                <th>UPDATE </th>
                <th>DELETE</th>
            </tr>
            <?PHP
            require_once 'database_connection_create.php';
            $sql = "SELECT * FROM student;";
            $result = $connect->query($sql);
            // Check if the query execution was successful
            if ($result === false) {
                die("Error executing the query: " . $connect->error);
            }
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // $row = $result->fetch_assoc()
            ?>
                    <!-- echo '<tr><td>'.$row['sn'].'<td><td>'.$row['firstname'].'<td><td>'.$row['lastname'].'<td><td>'.$row['email'].'<td><td>'.$row['phonenumber'].'<td><td>'.$row['website'].'<td><td>'.$row['password'].'<td><td>'.$row['repassword'].'<td><td>'.$row['date_time'].'<td><tr>';    -->
                    <tr>
                        <td> <?php echo $row['sn']; ?> </td>
                        <td> <?php echo $row['firstname']; ?> </td>
                        <td> <?php echo $row['lastname']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['phonenumber']; ?> </td>
                        <td> <?php echo $row['website']; ?> </td>
                        <td> <?php echo $row['date_time']; ?> </td>
                        <td><a style="text-decoration:none;" href="update.php?sn=<?php echo $row['sn']; ?>"><label for="delete" style=" color:blue;cursor: pointer; ">UPDATE<i class="fa-solid fa-pen-to-square"></i></label></a></td>
                        <td><a id="demo" onclick="return funclick()" style="text-decoration:none;" href="delete.php?sn=<?php echo $row['sn']; ?>"><label for="delete" style=" color:red;cursor: pointer; ">DELETE<i class="fa-solid fa-trash"></i></label></a></td>
                    </tr>
            <?php
                }

                if (isset($_GET['success'])) {
                    echo '<div style=" color:green; font-size:1.8rem; float:right;">' . $_GET['success'] . '</div>';
                } else {
                    // echo '<div style=" color:red;">' . 'Error:'.$connect->error. '</div>';
                }
            } else {
                echo "0 result";
            }
            $connect->close();
            ?>

        </table>
        <a class="button" href="form_sample_for_new_user.php">ADD</a>
        <a class="button" href="logout.php">LOGOUT</a>
        <?php
        if (isset($_GET['success'])) {
            echo '<div style=" color:green; font-size:1.8rem; float:right;">' . $_GET['success'] . '</div>';
        } else {
            // echo '<div style=" color:red;">' . 'Error:'.$connect->error. '</div>';
        }
        ?>
    </div>
</body>
<script>
    function funclick() {
        // let vara= document.getElementById('demo');
        return confirm("Are You Really Want To Delete?");


    }
</script>

</html>