<?php
    $mysqli = new mysqli('localhost', 'root', '', 'bank');
    if($mysqli->connect_errno)
    {
        print("Error connecting" . $myqli->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $accountAttr; $a1Attr; $a2Attr; $a3Attr; $a4Attr; $a5Attr; $a6Attr;
        $branchAttr; $branchNameAttr;
        $monthAttr;
        $prodAttr;
        $factAttr;
        $fact;
        $sliceValue;
        $sliceColumn;
        $diceVar1; $diceCol11; $diceCol12; $diceCol13;
        $diceVar2; $diceCol21; $diceCol22; $diceCol23;
        $diceVar3; $diceCol31; $diceCol32; $diceCol33;
        $comma = ", ";
        $headers = "";
        $groupBy = "GROUP BY ";
        $citytest;
        $array = array();
        $query = "SELECT ";
        $empty = '';
    
    if(isset($_POST['month']))
        {
            $monthAttr = $_POST['month'];
            $query .= $monthAttr . $comma;
            $headers .= "<th>$monthAttr</th>";
            $array[] = $monthAttr;
            
            
        }
    if(isset($_POST['a1']))
        {
            $a1Attr = $_POST['a1'];
            $query .= $a1Attr . $comma;
            $headers .= "<th>$a1Attr</th>";
            $array[] = $a1Attr;
        }
    if(isset($_POST['a2']))
        {
            $a2Attr = $_POST['a2'];
            $query .= $a2Attr . $comma;
            $headers .= "<th>$a2Attr</th>";
            $array[] = $a2Attr;
        }
    if(isset($_POST['a3']))
        {
            $a3Attr = $_POST['a3'];
            $query .= $a3Attr . $comma;
            $headers .= "<th>$a3Attr</th>";
            $array[] = $a3Attr;
        }
    if(isset($_POST['a4']))
        {
            $a4Attr = $_POST['a4'];
            $query .= $a4Attr . $comma;
            $headers .= "<th>$a4Attr</th>";
            $array[] = $a4Attr;
        }
    if(isset($_POST['a5']))
        {
            $a5Attr = $_POST['a5'];
            $query .= $a5Attr . $comma;
            $headers .= "<th>$a5Attr</th>";
            $array[] = $a5Attr;
        }
    if(isset($_POST['a6']))
        {
            $a6Attr = $_POST['a6'];
            $query .= $a6Attr . $comma;
            $headers .= "<th>$a6Attr</th>";
            $array[] = $a6Attr;
        }
    if(isset($_POST['account']))
        {
            $accountAttr = $_POST['account'];
            $query .= $accountAttr . $comma;
            $headers .= "<th>$accountAttr</th>";
            $array[] = $accountAttr;
          
        }
    if(isset($_POST['branchName']))
        {
            $branchNameAttr = $_POST['branchName'];
            $query .= $branchNameAttr . $comma;
            $headers .= "<th>$branchNameAttr</th>";
        $array[] = $branchNameAttr;
            
        }
        if(isset($_POST['branch']))
        {
            $branchAttr = $_POST['branch'];
            $query .= $branchAttr . $comma;
            $headers .= "<th>$branchAttr</th>";
        $array[] = $branchAttr;
            
        }
        if(isset($_POST['product']))
        {
            $prodAttr = $_POST['product'];
            $query .= $prodAttr . $comma;
            $headers .= "<th>$prodAttr</th>";
        $array[] = $prodAttr; 
            
        }

        $end = current($array);
        $count = count($array);
        while($count!=0)
        {
            $value = $array[$count-1];
            if($value!=NULL)
            {
                if($value!=$end)
                {
                    $groupBy .= $value . $comma;
                }
                else
                {
                    $groupBy .= $value;
                }
            }
            $count--;
        }
        
        if(isset($_POST['fact']))
        {
           $factAttr = $_POST['fact'];
            switch($factAttr)
            {
                case 'primary_balance':
                    $query .= "sum($factAttr) AS TotalBalance";
                    $fact = "TotalBalance";
                    $headers .= "<th>Total Balance</th>";
                    break;
                case 'transaction_count':
                    $query .= "sum($factAttr) AS NumOfTransactions";
                    $fact = "NumOfTransactions";
                    $headers .= "<th>Num of Transactions</th>";
                    break;
                case 'account_count':
                    $query .= "sum($factAttr) AS NumOfAccounts";
                    $fact = "NumOfAccounts";
                    $headers .= "<th>Num of Accounts</th>";
                    break;
            }
        }
    
    
        
        $query .= " FROM month, account, branch, product, household_facts";
        $query .= " WHERE month.month_key = household_facts.month_key AND account.account_key = household_facts.account_key
                        AND branch.branch_key = household_facts.branch_key AND product.product_key = household_facts.product_key ";
    
    /*Slice function added*/
    if(isset($_POST["sliceColumn"]))
    {
        $sliceColumn = $_POST["sliceColumn"];
        $sliceValue = $_POST["slice"];
        if($sliceColumn != $empty && $sliceValue != $empty)
        {
            $query .= "AND $sliceColumn = '$sliceValue' ";
        }
    }

    /*dice function added*/
    if(isset($_POST["diceVar1"]))
    {
        $diceVar1 = $_POST["diceVar1"];
        $diceCol11 = $_POST["diceCol11"];
        $diceCol12 = $_POST["diceCol12"];
        $diceCol13 = $_POST["diceCol13"];
        if($diceVar1 != $empty && $diceCol11 != $empty)
        {
            $query .= "AND ($diceVar1 = '$diceCol11' ";
            if($diceCol12 != $empty) { $query .= "OR $diceVar1 = '$diceCol12' "; }
            if($diceCol13 != $empty) { $query .= "OR $diceVar1 = '$diceCol13' "; }
            $query .=  ") ";
        }
    }    

    if(isset($_POST["diceVar2"]))
    {
        $diceVar2 = $_POST["diceVar2"];
        $diceCol21 = $_POST["diceCol21"];
        $diceCol22 = $_POST["diceCol22"];
        $diceCol23 = $_POST["diceCol23"];
        if($diceVar2 != $empty && $diceCol21 != $empty)
        {
            $query .= "AND ($diceVar2 = '$diceCol21' ";
            if($diceCol22 != $empty) { $query .= "OR $diceVar2 = '$diceCol22' "; }
            if($diceCol23 != $empty) { $query .= "OR $diceVar2 = '$diceCol23' "; }
            $query .=  ") ";
        }
    }

    if(isset($_POST["diceVar3"]))
    {
        $diceVar3 = $_POST["diceVar3"];
        $diceCol31 = $_POST["diceCol31"];
        $diceCol32 = $_POST["diceCol32"];
        $diceCol33 = $_POST["diceCol33"];
        if($diceVar3 != $empty && $diceCol31 != $empty)
        {
            $query .= "AND ($diceVar3 = '$diceCol31' ";
            if($diceCol32 != $empty) { $query .= "OR $diceVar3 = '$diceCol32' "; }
            if($diceCol33 != $empty) { $query .= "OR $diceVar3 = '$diceCol33' "; }
            $query .=  ") ";
        }
    }

        $query .= " $groupBy";
        //echo "<p>$query</p>";
        $result = $mysqli->query($query);
        
        echo "<table>
                <tr>" . $headers . "</tr>";
                            
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            if(isset($monthAttr))
            {
               echo  "<td>" . $row[$monthAttr] . "</td>"; 
            }
        if(isset($a1Attr))
            {
                echo "<td>" . $row[$a1Attr] . "</td>";
            }
        if(isset($a2Attr))
            {
                echo "<td>" . $row[$a2Attr] . "</td>";
            }
        if(isset($a3Attr))
            {
                echo "<td>" . $row[$a3Attr] . "</td>";
            }
        if(isset($a4Attr))
            {
                echo "<td>" . $row[$a4Attr] . "</td>";
            }
        if(isset($a5Attr))
            {
                echo "<td>" . $row[$a5Attr] . "</td>";
            }
        if(isset($a6Attr))
            {
                echo "<td>" . $row[$a6Attr] . "</td>";
            }
            if(isset($accountAttr))
            {
                echo "<td>" . $row[$accountAttr] . "</td>";
            }
            if(isset($branchNameAttr))
            {
                echo "<td>" . $row[$branchNameAttr] . "</td>";
            }
            if(isset($branchAttr))
            {
                echo "<td>" . $row[$branchAttr] . "</td>";
            }
            if(isset($prodAttr))
            {
                echo "<td>" . $row[$prodAttr] . "</td>";
            }
            if(isset($factAttr))
            {
                echo "<td>" . $row[$fact] . "</td>";
            }
        }
        echo "</table>";
    
        $mysqli->close();
    }
?>



        
