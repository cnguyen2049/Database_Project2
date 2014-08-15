<?php
    $mysqli = new mysqli('localhost', 'root', '', 'bank');
    if($mysqli->connect_errno)
    {
        print("Error connecting" . $myqli->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $table_name = $_POST["tableName"];
        $result = $mysqli->query("SELECT * FROM `$table_name`");
        switch($table_name)
        {
            case 'account':
            {
               echo "<table>
                        <tr>
                            <th>Account Key</th>
                            <th>Primary Surname</th>
                            <th>Secondary Surname</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zipcode</th>
                            <th>Open date</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Married?</th>
                            </tr>";
                            
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo  "<td>" . $row['account_key'] . "</td>";
                                echo "<td>" . $row['primary_surname'] . "</td>";
                                echo "<td>" . $row['secondary_surname'] . "</td>";
                                echo "<td>" . $row['account_address'] . "</td>";
                                echo "<td>" . $row['account_city'] . "</td>";
                                echo "<td>" . $row['account_state'] . "</td>";
                                echo "<td>" . $row['account_zip'] . "</td>";
                                echo "<td>" . $row['date_opened'] . "</td>";
                                echo "<td>" . $row['primary_age'] . "</td>";
                                echo "<td>" . $row['primary_sex'] . "</td>";
                                echo "<td>" . $row['primary_marital'] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</table>";
                break;
            }
            case 'month':
            {
                echo "<table>
                        <tr>
                            <th>Month Key</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Fiscal Quarter</th>
                            </tr>";
                            
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo  "<td>" . $row['month_key'] . "</td>";
                                echo "<td>" . $row['month'] . "</td>";
                                echo "<td>" . $row['year'] . "</td>";
                                echo "<td>" . $row['fiscal_quarter'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                break;
            }
            case 'branch':
            {
                echo "<table>
                        <tr>
                            <th>Branch Key</th>
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Zipcode</th>
                            </tr>";
                            
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo  "<td>" . $row['branch_key'] . "</td>";
                                echo "<td>" . $row['branch_name'] . "</td>";
                                echo "<td>" . $row['branch_address'] . "</td>";
                                echo "<td>" . $row['branch_city'] . "</td>";
                                echo "<td>" . $row['branch_state'] . "</td>";
                                echo "<td>" . $row['branch_zip'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                break;
            }
            case 'product':
            {
                echo "<table>
                        <tr>
                            <th>Product Key</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Category</th>
                            </tr>";
                            
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo  "<td>" . $row['product_key'] . "</td>";
                                echo "<td>" . $row['product_description'] . "</td>";
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                break;
            }
            case 'household_facts':
            {
                echo "<table>
                        <tr>
                            <th>Month Key</th>
                            <th>Account Key</th>
                            <th>Product Key</th>
                            <th>Branch Key</th>
                            <th>Household Key</th>
                            <th>Status Key</th>
                            <th>Balance</th>
                            <th>Trans. Count</th>
                            <th>Account Count</th>
                            </tr>";
                            
                            while($row = $result->fetch_assoc())
                            {
                                echo "<tr>";
                                echo  "<td>" . $row['month_key'] . "</td>";
                                echo  "<td>" . $row['account_key'] . "</td>";
                                echo  "<td>" . $row['product_key'] . "</td>";
                                echo  "<td>" . $row['branch_key'] . "</td>";
                                echo  "<td>" . $row['household_key'] . "</td>";
                                echo  "<td>" . $row['status_key'] . "</td>";                               
                                echo "<td>" . $row['primary_balance'] . "</td>";
                                echo "<td>" . $row['transaction_count'] . "</td>";
                                echo "<td>" . $row['account_count'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                break;
            }
        }
        $mysqli->close();
    }
?>