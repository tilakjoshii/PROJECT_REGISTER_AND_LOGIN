<?php
require_once 'database_connection_create.php';

// Check if 'sn' is set in the URL
if (isset($_GET['sn'])) {
    $id = $_GET['sn'];

    // Check if the form is submitted
    if (isset($_POST['email'])) {
        $newEmail = $_POST['email'];

        // Retrieve the existing email for the specified record
        $getExistingEmailQuery = "SELECT email FROM student WHERE sn = ?";
        $stmt = $connect->prepare($getExistingEmailQuery);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $existingEmail = $row['email'];
        $stmt->close();

        // Check if the new email is different from the existing email
        if ($newEmail != $existingEmail) {
            // Check if the new email already exists in the database
            $checkEmailQuery = "SELECT COUNT(*) as count FROM student WHERE email = ? AND sn != ?";
            $stmt = $connect->prepare($checkEmailQuery);
            $stmt->bind_param("si", $newEmail, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $emailCount = $row['count'];
            $stmt->close();

            if ($emailCount > 0) {
                header('Location: update.php?sn=' . $id . '&error=new email address is already in use');
                exit();
            }
        }

        // Update the email address
        $updateEmailQuery = "UPDATE student SET email=? WHERE sn=?";
        $stmt = $connect->prepare($updateEmailQuery);
        $stmt->bind_param("si", $newEmail, $id);

        if ($stmt->execute()) {
            // Email address updated successfully
            header('Location: table.php?sn=' . $id . '&success=email address updated successfully');
            exit();
        } else {
            // Error updating the email address
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No data submitted";
    }
} else {
    echo "No 'sn' parameter found in the URL";
}

$connect->close();
?>
