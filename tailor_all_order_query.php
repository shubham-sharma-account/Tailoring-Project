<?php
if ($result->num_rows > 0) {
                echo "<table id='result'><tr><th>ORDER ID</th><th>Roll No.</th><th>Name</th><th>Class</th><th>Phone</th>
                <th>Email</th><th>Action</th><th>Action</th><th>Status</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row['id']."</td><td>".$row['rollno']."</td><td>". $row["fname"]." ".$row["lname"]."</td><td>" 
                    . $row['class'] . "</td><td>" . $row['pno'] . "</td><td>".$row['email']."</td>
                    <td><form method='post'><input type='hidden' name='stu_email' value=".$row["email"].">
                    <input type='hidden' name='class' value=".$row["class"].">
                    <input type='submit' name='view_measure' value='View measurement'></form></td>
                    <td><form method='post'><input type='hidden' name='rollno' value=".$row["rollno"].">
                    <input type='hidden' name='class' value=".$row["class"].">
                    <input type='submit' name='delete' id='order_delete_btn' value='Delete'></form></td>
                    <td><form method='post'><input type='hidden' name='email' value=".$row["email"].">
                    <input type='hidden' name='class' value=".$row["class"].">
                    <input type='submit' name='uniform_status' value=".$row["status"]."></form></td>
                    </tr>";
                }
                echo "</table>";
            }else{
                echo '<script>
                        function display_none()
                        {
                            document.getElementById("alert2").style="display:none";
                        }
                        function call_fun(){
                            document.getElementById("alert2").style="display:block";
                            document.getElementById("msg2").innerHTML="No student found!";
                        }
                        call_fun();
                    </script>';
            }
?>