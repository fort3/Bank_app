<?php

    function displayCustomers($data){
        
        $result = " ";
        while($row = mysqli_fetch_array($data)){
            
            $result .= "<tr><td>".$row[0]."</td>";
            $result .= "<td>".$row[1]."</td>";
            $result .= "<td>".$row[2]."</td>";
            $result .= "<td>".$row[3]."</td>";
            $result .= "<td>".$row[4]."</td>";
            $result .= "<td>".$row[5]."</td>";
            $result .= "<td>".$row[6]."</td>";
            $result .= "<td>".$row[7]."</td>";
            $result .= "<td>".$row[8]."</td>";
            $result .= "<td>".$row[9]."</td>";
            $result .= "<td>".$row[10]."</td><tr>";
           
        }
        return $result;
    }

?>
