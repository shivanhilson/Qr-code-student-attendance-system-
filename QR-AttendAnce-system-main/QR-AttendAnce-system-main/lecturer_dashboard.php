<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// Include database connection
include 'config/db_connection.php';



// cards
$query = "SELECT COUNT(*) AS total_students FROM students";
$result = $mysqli->query($query);

// Check if the query executed successfully
if ($result) {
    $row = $result->fetch_assoc();
    $total_students = $row['total_students'];
} else {
    // Error handling
    $total_students = "Error fetching total students";
}

$query = "SELECT COUNT(*) AS total_staff_members FROM lecturers";
$result = $mysqli->query($query);

// Check if the query executed successfully
if ($result) {
    $row = $result->fetch_assoc();
    $total_staff_members = $row['total_staff_members'];
} else {
    // Error handling
    $total_staff_members = "Error fetching total staff_members";
}
//programs card
$query = "SELECT COUNT(*) AS programs FROM programs";
$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $programs = $row['programs'];
} else {
    // Error handling
    $programs = "Error fetching programs";
}

//departments card
$query = "SELECT COUNT(*) AS departments FROM departments";
$result = $mysqli->query($query);

if ($result) {
    $row = $result->fetch_assoc();
    $departments = $row['departments'];
} else {
    // Error handling
    $departments = "Error fetching departments";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luyanzi Students</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="pop.css">
    <link rel="stylesheet" href="pop2.css">
    <link rel="stylesheet" href="css/views.css">

</head>

<body>

    <!-- for header part -->
    <header>

        <div class="log">
            <div class="logo">
                <img src="logo/logo.png" style="width: 100px;">
            </div>
            <div class="menu-icon">
                <i class="material-icons" id="menu-icon" alt="menu-icon">menu</i>
            </div>

        </div>



        <div class="text">
            <div class="heading-txt">Luyanzi Institute</div>

        </div>

        <div class="message">
            <div class="nofication">
                <i class="material-icons" style="color: #04AA6D;">notifications</i>
            </div>

            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </div>
        </div>

    </header>

    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">

                        <h3>Lecturer</h3>
                    </div>

                  
                    


                    <div class="option2 nav-option">
                        <hr style="margin-left: -14px; color:rgba(255, 166, 0, 0.445);">
                        <h3>Attendence Reports</h3>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">category</i>&nbsp;&nbsp;&nbsp;
                            <h3>Roll-Call</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="loadView('attend_list.php')">Roll-Call</a>
                        </div>
                    </div>


                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">category</i>&nbsp;&nbsp;&nbsp;
                            <h3>Generate Qr</h3>
                        </div>
                        <div class="dropdown-content">
                        <a href="Qr/index.html">Qr-code</a>
                        </div>
                    </div>


                  





                    <div class="option2 nav-option">
                        <i class="material-icons">settings</i>
                        <h3>Settings</h3>
                        <div class="dropdown-content">
                        <a href="settings/view_settings.php">settings</a>
                        </div>
                    </div>

                    <div class="nav-option logout">
                        <i class="material-icons">logout</i>
                        <a href="index.html" style="text-decoration: none; color: green; ">
                            <h3>Logout</h3>
                        </a>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">

            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">

                </div>
            </div>
            <!-- for header  boxes -->

            <div class="box-container">

                <div class="box box1">
                    <div class="text">
                        <h2 class="topic-heading"><?php echo $total_students; ?></h2>
                        <div class="log">
                            <i class="material-icons">groups</i>&nbsp;&nbsp;
                            <h2 class="topic">Total Students</h2>
                        </div>
                    </div>


                </div>

                <div class="box box3">
                    <div class="text">
                        <h2 class="topic-heading"><?php echo $programs; ?></h2>
                        <div class="log">
                            <i class="material-icons">terminal</i>&nbsp;&nbsp;
                            <h2 class="topic">Programs</h2>
                        </div>
                    </div>

                </div>

                <div class="box box4">
                    <div class="text">
                        <h2 class="topic-heading"><?php echo $departments; ?></h2>
                        <div class="log">
                            <i class="material-icons">dataset</i>&nbsp;&nbsp;
                            <h2 class="topic">Departments</h2>
                        </div>
                    </div>


                </div>
            </div>
            <div id="student-attendance-report" class="report-container">
                <div id="viewContainer" class="section">

                <section id="welcomeSection">
                    <div class="container">
                        <h1 id="welcomeMessage">Welcome, Lecturer!</h1>
                        <p id="advice">Thank you for your dedication to education. Remember, your passion and commitment inspire your students to greatness.</p>
                        <h3 id="dd">Please ,Take the Student Attendance .</h3>

                    </div>
                </section>
                    <!-- Loaded views will appear here -->
                </div>


            </div>
        </div>


    </div>
    </div>

    <div id="popupContainer"></div>


    <script src="script.js"></script>
    <script src="pops.js"></script>
    <script src="pop.js"></script>
    <script src="js/views.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Add jQuery library -->
    <script>
        // Function to load attendance list
        function loadAttendanceList() {
            // Serialize form data
            var formData = $('#viewStudentsForm').serialize();

            // AJAX request to load attendance list
            $.ajax({
                type: 'GET',
                url: $('#viewStudentsForm').attr('action'),
                data: formData,
                success: function(response) {
                    // Load attendance list into container in index.php
                $('#viewContainer').html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        }

        $(document).ready(function() {
            // Function to load page into viewContainer
            function loadPage(page) {
                $('#welcomeSection').hide();
                $('.container').show();
                $('#viewContainer').load(page);
            }

            // Load welcome section initially
            loadPage(' #welcomeSection');

          
        });

    </script>



</body>

</html>