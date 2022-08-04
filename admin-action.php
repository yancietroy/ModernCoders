<?php

  require_once 'admin-DB.php';
  require_once 'admin-util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New User Ajax Request
  if (isset($_POST['add'])) {
    $studentId  = $util->testInput($_POST['studentId']);
    $fname      = $util->testInput($_POST['fname']);
    $mname      = $util->testInput($_POST['fname']);
    $lname      = $util->testInput($_POST['lname']);
    $gender     = $util->testInput($_POST['gender']);
    $email      = $util->testInput($_POST['email']);
    $yearLevel  = $util->testInput($_POST['yearLevel']);
    $birthDate  = $util->testInput($_POST['birthDate']);
    $age        = $util->testInput($_POST['age']);

    if ($db->insert($studentId, $fname, $mname, $lname, $gender, $email, $yearLevel, $birthDate, $age)) {
      echo $util->showMessage('success', 'Student inserted successfully!');
    } else {
      echo $util->showMessage('danger', 'Something went wrong!');
    }
  }

  // Handle Fetch All Users Ajax Request
  if (isset($_GET['read'])) {
    $users = $db->read();
    $output = '';
    if ($users) {
      foreach ($users as $row) {
        $output .= '<tr>
                      <td>' . $row['STUDENT_ID'] . '</td>
                      <td>' . $row['FIRST_NAME'] . '</td>
                      <td>' . $row['MIDDLE_NAME'] . '</td>
                      <td>' . $row['LAST_NAME'] . '</td>
                      <td>' . $row['GENDER'] . '</td>
                      <td>' . $row['EMAIL'] . '</td>
                      <td>' . $row['YEAR_LEVEL'] . '</td>
                      <td>' . $row['BIRTHDATE'] . '</td>
                      <td>' . $row['AGE'] . '</td>
                      <td>
                        <a href="#" id="' . $row['STUDENT_ID'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>

                        <a href="#" id="' . $row['STUDENT_ID'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
                      </td>
                    </tr>';
      }
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">No Users Found in the Database!</td>
            </tr>';
    }
  }

  // Handle Edit User Ajax Request
  if (isset($_GET['edit'])) {
    $id = $_GET['STUDENT_ID'];

    $user = $db->readOne($id);
    echo json_encode($user);
  }

  // Handle Update User Ajax Request
  if (isset($_POST['update'])) {
    $studentId  = $util->testInput($_POST['studentId']);
    $fname      = $util->testInput($_POST['fname']);
    $mname      = $util->testInput($_POST['fname']);
    $lname      = $util->testInput($_POST['lname']);
    $gender     = $util->testInput($_POST['gender']);
    $email      = $util->testInput($_POST['email']);
    $yearLevel  = $util->testInput($_POST['yearLevel']);
    $birthDate  = $util->testInput($_POST['birthDate']);
    $age        = $util->testInput($_POST['age']);
    if ($db->update($studentId, $fname, $mname, $lname, $gender, $email, $yearLevel, $birthDate, $age)) {
      echo $util->showMessage('success', 'User updated successfully!');
    } else {
      echo $util->showMessage('danger', 'Something went wrong!');
    }
  }

  // Handle Delete User Ajax Request
  if (isset($_GET['delete'])) {
    $id = $_GET['STUDENT_ID'];
    if ($db->delete($id)) {
      echo $util->showMessage('info', 'User deleted successfully!');
    } else {
      echo $util->showMessage('danger', 'Something went wrong!');
    }
  }

?>