<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Registration Form</title>
    <link rel="stylesheet" href="styles.css">
    <script>
      /*  function addStudentDetails() {
            const container = document.getElementById('students-details-container');
            const studentDetailsDiv = document.createElement('div');
            studentDetailsDiv.className = 'student-details';
            studentDetailsDiv.innerHTML = `
                <input type="text" name="student-name" placeholder="Name" required>
                <input type="text" name="student-class" placeholder="Class" required>
                <input type="text" name="student-branch" placeholder="Branch" required>
            `;
            container.appendChild(studentDetailsDiv);
        }*/
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Project Registration Form</h1>
        <form action="register-save.php" method="post">
            <table>
                <tr>
                    <td><label for="project-title">Student Name</label></td>
                    <td><input type="text" id="sname" name="sname" required></td>
                </tr>
                
                 <tr>
                    <td><label for="project-type">Class:</label></td>
                     <td><input type="text" id="class" name="class" required></td>
                    
                </tr>
                
                <tr>
                    <td><label for="project-type">Branch:</label></td>
                     <td><input type="text" id="branch" name="branch" required></td>
                    
                </tr>
                <tr>
                    <td><label for="project-type">User Name/Mobile:</label></td>
                     <td><input type="text" id="username" name="username" required></td>
                    
                </tr>
                
                <tr>
                    <td><label for="project-type">Password:</label></td>
                     <td><input type="text" id="userpassword" name="userpassword" required></td>
                    
                </tr>
                
               <tr>
                    <td colspan="2" class="submit-row">
                        <button type="submit">Submit</button> &nbsp;<a class="btn btn-info" href="index.html"> << BACK </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
