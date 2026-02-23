<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'config/db_connection.php';


$programs = [];
$departments = [];
$lecturers = [];
$settings=[];

// Fetch programs
$program_query = "SELECT * FROM programs";
$program_result = $mysqli->query($program_query);
if ($program_result === false) {
    echo "Error fetching programs: " . $mysqli->error;
} else {
    if ($program_result->num_rows > 0) {
        $programs = $program_result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "";
    }
}
// settings
$settings_query = "SELECT * FROM settings";
$settings_result = $mysqli->query($settings_query);
if ($settings_result === false) {
    echo "Error fetching settings: " . $mysqli->error;
} else {
    if ($settings_result->num_rows > 0) {
        $psettings = $settings_result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "";
    }
}

// Fetch departments
$department_query = "SELECT * FROM departments";
$department_result = $mysqli->query($department_query);
if ($department_result === false) {
    echo "Error fetching departments: " . $mysqli->error;
} else {
    if ($department_result->num_rows > 0) {
        $departments = $department_result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "";
    }
}

// Fetch lecturers
$lecturer_query = "SELECT * FROM lecturers";
$lecturer_result = $mysqli->query($lecturer_query);
if ($lecturer_result === false) {
    echo "Error fetching lecturers: " . $mysqli->error;
} else {
    if ($lecturer_result->num_rows > 0) {
        $lecturers = $lecturer_result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "";
    }
}


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
// Close database connection
$mysqli->close();
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

    <!-- Header part -->
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
                        <h3> Dashboard</h3>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">groups</i>&nbsp;&nbsp;&nbsp;
                            <h3> Students</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="openForm('student-popup')">Register Students</a>
                            <a href="#" onclick="loadView('view_students.php')">View Students</a>
                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">person</i>&nbsp;&nbsp;&nbsp;
                            <h3> Staff Members</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="openForm('admin-popup')">Register Administrators</a>
                            <a href="#" onclick="loadView('view_administrators.php')"> View_administrators</a>
                            <a href="#" onclick="openForm('lecturer-popup')"> Register Lecturers</a>
                            <a href="#" onclick="loadView('view_lecturers.php')">View Lecturers</a>

                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">terminal</i>&nbsp;&nbsp;&nbsp;
                            <h3> Programs</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="openForm('program-popup')">Add Programs</a>
                            <a href="#" onclick="loadView('view_programs.php')">View Programs</a>
                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">category</i>&nbsp;&nbsp;&nbsp;
                            <h3> Course Units</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="openForm('course-unit-popup')">Course Unit</a>
                            <a href="#" onclick="loadView('view_course_units.php')">View Course Units</a>
                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <div class="log">
                            <i class="material-icons">dataset</i>&nbsp;&nbsp;&nbsp;
                            <h3> Department</h3>
                        </div>
                        <div class="dropdown-content">
                            <a href="#" onclick="openForm('department-popup')">Add Departments</a>
                            <a href="#" onclick="loadView('view_departments.php')">View Departments</a>
                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <hr style="margin-left: -14px; color:rgba(255, 166, 0, 0.445);">
                        <h3> Attendence Reports</h3>
                        <div class="dropdown-content">
                            <a href="#" onclick="loadView('select.php')">View Attendances</a>
                        </div>
                    </div>

                    <div class="option2 nav-option">
                        <i class="material-icons">settings</i>
                        <h3> Settings</h3>
                        <div class="dropdown-content">
                            <a href="settings/settings.html">Set Intake</a>
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

            <!-- Header boxes -->
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

                <div class="box box2">
                    <div class="text">
                        <h2 class="topic-heading"><?php echo $total_staff_members; ?></h2>
                        <div class="log">
                            <i class="material-icons">person</i>&nbsp;&nbsp;
                            <h2 class="topic">Staff Members</h2>
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
            <!-- Loaded views will appear here -->
            <div id="student-attendance-report" class="report-container">
                <div id="viewContainer" class="section">
                    <section id="welcomeSection">
                        <div class="container">
                            <h1 id="welcomeMessage">Welcome, Administrator!</h1>
                            <p id="advice">As an administrator, your leadership shapes the future. Remember, great leaders empower others and foster growth.</p>
                        </div>
                    </section>
                    <!-- Loaded views will appear here -->
                   
                </div>

            </div>
        </div>
    </div>

    <footer><h4>>Knowledge inspires</h4></footer>

    <section id="lecturer-popup" class="form-popup">
        <span class="close" onclick="closeForm('lecturer-popup')">&times;</span>
        <form action="register_lecturer.php" class="form-container" method="post">
            <h2>Register Lecturer</h2>
            <label for="lecturer_name"><b>Lecturer Name</b></label>
            <input type="text" placeholder="Enter Full Name" name="lecturer_name" required>
            <label for="program"><b>Program</b></label>
            <select name="program" required style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">
                <option value="">Select Program</option>
                <!-- Populate with options from database -->
                <?php
            // Include database connection
            include 'config/db_connection.php';

            // Fetch programs from the database
            $program_query = "SELECT * FROM programs";
            $program_result = $mysqli->query($program_query);

            // Check if query executed successfully
            if ($program_result && $program_result->num_rows > 0) {
                // Fetch and display programs
                while ($row = $program_result->fetch_assoc()) {
                    echo "<option value='" . $row['program_id'] . "'>" . $row['program_name'] . "</option>"; // Updated to use program ID
                }
            } else {
                echo "<option value=''>No programs found</option>";
            }
            ?>
            </select>
            <label for="department"><b>Department</b></label>
            <select name="department" required style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px;" >
                <option value="">Select Department</option>
                <!-- Populate with options from database -->
                <?php
                    // Fetch departments from the database
                    $department_query = "SELECT * FROM departments";
                    $department_result = $mysqli->query($department_query);

                    // Check if query executed successfully
                    if ($department_result && $department_result->num_rows > 0) {
                        // Fetch and display departments
                        while ($row = $department_result->fetch_assoc()) {
                            echo "<option value='" . $row['department_id'] . "'>" . $row['department_name'] . "</option>";
                        }
                } else {
                        echo "<option value=''>No departments found</option>";
                    }
             ?>
            </select>

            <label for="qualifications"><b>Qualifications</b></label>
            <input type="text" placeholder="Enter Qualifications" name="qualifications" required>
            <label for="phone"><b>Phone Number</b></label>
            <input type="tel" placeholder="Enter Phone Number" name="phone" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>
            <label><b>Gender</b></label><br>
            <input type="radio" id="male" name="gender" value="Male" required>
            <label for="male">Male</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="female" name="gender" value="Female" required >
            <label for="female">Female</label><br>
            <button type="submit" class="btn">Register</button>
        </form>
    </section>



    <section id="student-popup" class="forms-popup">
        <span class="close" onclick="closeForm('student-popup')">&times;</span>
        <form action="register_student.php" method="post" class="form-container">
            <h2>Register Student</h2>

            <label for="fname"><b>Full Name:</b></label>
            <input type="text" placeholder="Enter Full Name" name="fname" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <label for="reg_no"><b>Reg. No:</b></label>
            <input type="text" placeholder="Reg. No" name="reg_no" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <label for="dob"><b>Date of Birth:</b></label>
            <input type="date" name="dob" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <label for="gender"><b>Gender:</b></label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>

            <label for="pn"><b>Program:</b></label><br>
            <select name="pn" id="pn" required onchange="updateProgramName()" style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">
                <option value="">Select Program</option>
                <!-- Populate with options from database -->
                <?php
                // Include database connection
                include 'config/db_connection.php';

                // Fetch programs from the database
                $program_query = "SELECT * FROM programs";
                $program_result = $mysqli->query($program_query);

                // Check if query executed successfully
                if ($program_result && $program_result->num_rows > 0) {
                    // Fetch and display programs
                    while ($row = $program_result->fetch_assoc()) {
                        echo "<option value='" . $row['program_id'] . "'>" . $row['program_name'] . "</option>"; // Updated to use program ID
                    }
                } else {
                    echo "<option value=''>No programs found</option>";
                }
                ?>
            </select><br>

            <label for="intake"><b>Intake/Class</b></label>
            <select name="intake" required style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">
                <option value="">Select Intake/Class</option>
                <!-- Populate with options from database -->
                <?php
                    // Fetch departments from the database
                    $settings_query = "SELECT * FROM settings";
                    $settings_result = $mysqli->query($settings_query);

                    // Check if query executed successfully
                    if ($settings_result && $settings_result->num_rows > 0) {
                        // Fetch and display departments
                        while ($row = $settings_result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['intake'] . "</option>";
                        }
                } else {
                        echo "<option value=''>No intake found</option>";
                    }
             ?>
            </select><br>

            <label for="phone"><b>Phone Number:</b></label>
            <input type="tel" placeholder="Enter Phone Number" name="phone" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <!-- Submit button -->
            <button type="submit">Register</button>
        </form>
    </section>






    <section id="admin-popup" class="form-popup">
        <span class="close" onclick="closeForm('admin-popup')">&times;</span>
        <form action="register_admin.php" class="form-container" method="post">
            <h2>Register Administrator</h2>

            <label for="admin_name"><b>Administrator Name</b></label>
            <input type=" text" placeholder="Enter Full Name" id="admin_name" name="admin_name" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"> <br>

            <label for="role"><b>Role</b></label> <br>
            <input type="text" placeholder="Roles" name="role" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">

            <label for="phone"><b>Phone Number</b></label>
            <input type="tel" placeholder="Enter Phone Number" name="phone" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <label><b>Gender</b></label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>

            <button type="submit" class="btn">Register</button>
        </form>
    </section>

    <section id="program-popup" class="form-popup">
        <span class="close" onclick="closeForm('program-popup')">&times;</span>
        <form action="add_program.php" method="post" class="form-container">
            <h2>Add Program</h2>

            <label for="pn"><b>Program Name:</b></label>
            <input type="text" id="pn" placeholder="Enter Program Name" name="pn" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">

            <label for="period"><b>Period:</b></label>
            <input type="text" id="period" placeholder="Enter Period" name="period" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <button type="submit" class="btn">Register</button>
        </form>
    </section>


    <section id="course-unit-popup" class="forms-popup">
        <span class="close" onclick="closeForm('course-unit-popup')">&times;</span>
        <form action="add_course_unit.php" method="post" class="form-container">
            <h2>Add Course Unit</h2>

            <label for="course_code"><b>Course Code:</b></label>
            <input type="text" id="course_code" placeholder="Enter Course Code" name="course_code" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">

            <label for="course_unit_name"><b>Course Unit Name:</b></label>
            <input type="text" id="course_unit_name" placeholder="Enter Course Unit Name" name="course_unit_name"
                required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">

            <label for="description"><b>Description:</b></label>
            <textarea id="description" placeholder="Enter Description" name="description" rows="2" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"></textarea>

            <label for="pn"><b>Program:</b></label><br>
            <select name="program" id="pn" required onchange="updateProgramName()" style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">
                <option value="">Select Program</option>
                <!-- Populate with options from database -->
                <?php
                // Include database connection
                include 'config/db_connection.php';

                // Fetch programs from the database
                $program_query = "SELECT * FROM programs";
                $program_result = $mysqli->query($program_query);

                // Check if query executed successfully
                if ($program_result && $program_result->num_rows > 0) {
                    // Fetch and display programs
                    while ($row = $program_result->fetch_assoc()) {
                        echo "<option value='" . $row['program_id'] . "'>" . $row['program_name'] . "</option>"; // Updated to use program ID
                    }
                } else {
                    echo "<option value=''>No programs found</option>";
                }
                ?>
            </select><br>

            <label for="lecturer_id"><b>Lecturer :</b></label>
            <select id="lecturer_id" name="lecturer_id" style="color:#f5ecdd; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">
            <?php
            foreach ($lecturers as $lecturer) {
                echo "<option value='".$lecturer["lecturer_id"]."'>".$lecturer["lecturer_name"]."</option>";
            }
            ?>
            </select>


            <button type="submit" class="btn">Register</button>
        </form>
    </section>

    <section id="department-popup" class="form-popup">
        <span class="close" onclick="closeForm('department-popup')">&times;</span>
        <form action="add_departments.php" method="post" class="form-container">
            <h2>Add Departments</h2>

            <label for="dp"><b>Department Name:</b></label>
            <input type="text" id="dp" placeholder="Enter Department Name" name="dp" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;">

            <label for="dd"><b>Description:</b></label>
            <input type="text" id="dd" placeholder="Enter Description" name="dd" required style="color:orange; border-color:#04AA6D; border-radius: 8px; padding:5px; width: 80%;"><br>

            <button type="submit" class="btn">ADD</button>
        </form>
    </section>





    <script src="script.js"></script>
    <script src="pops.js"></script>
    <script src="pop.js"></script>
    <script src="js/views.js"></script>
    <script src="edit/ajax.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="attend/attnd.js"></script> 

    <script>
    function updateProgramName() {
        var programId = document.getElementById("program_id").value;
        var programNameInput = document.getElementById("program_name");

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var programName = xhr.responseText;
                    programNameInput.value = programName;
                } else {
                    console.error('Error fetching program name');
                }
            }
        };
        xhr.open("GET", "get_program_name.php?id=" + programId, true);
        xhr.send();
    }
    </script>

    <script>
    function openEditForm(studentId) {
        document.getElementById("edit_student-popup").style.display = "block";
    }

    function closeForm(formId) {
        document.getElementById(formId).style.display = "none";

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