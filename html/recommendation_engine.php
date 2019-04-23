<?php
// someone please make this page more appealing to look at
include 'dbh.php';
session_start();

echo "Your recommendations based on your current reviews are: <br>";

$var = $_SESSION['user_name'];

$output = shell_exec("python3.6 recommendation_engine.py '$var'");

$lines = explode("\n", $output);
foreach($lines as $wine_id) {
    // what we need to do is get the recommended wine name from the db table
    // doing here cuz python and php were being mean
    // echo ("<br>");
    $sql = "SELECT title, wine_id 
            FROM WINES 
            WHERE wine_id =".$wine_id;
    // echo($sql);
    // echo("<br>");

    $result = mysqli_query($conn, $sql);
    // #       $row = mysqli_fetch_array($result);
    
    //         echo "<table border=1> 
    //           <tr>
    //           <th>Title</th>
    //           <th>wine_id</th>  
    //          </tr>";
    
    //         while ($row = mysqli_fetch_array($result)) {
    //         echo "<tr>";
    //         echo "<td>" . $row[title] . "</td>";
    //         echo "<td>" . $row[wine_id] . "</td>";
    //         echo "</tr>";
    //         #echo "<br />";
    //         }
    //         echo "</table>";

    // mysqli_close($conn);

    foreach($result as $r) {
        echo("result: ");
        echo($r[title]);
        echo (", ");
        echo ($r[wine_id]);
        echo ("<br>");
        // echo (" ");
        // echo($r[1]);
        // echo("<br>");
    }
}


?>
