<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
    
    h2,div {font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        
    }
    label ,th{font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  
}
input{
    width: 300px;
    border: 1px solid #C5C5C5;
    border-radius: 5px;
}
    table{
        border-collapse: collapse;
        width: 100%;
        padding: auto;
  text-align: left;
  border-bottom: 1px solid #ddd;
  border: none;
       
    }
    th,td{
      padding: auto;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-size: 15px;
      font-weight: 10px;  
      
  
}
tr:hover {background-color: #D4F1F4;}
tr:nth-child(even) {background-color: #f2f2f2;}
div{
    padding: auto;
    margin: auto;
    text-align: center;
    width: 300px;
   
}


/* CSS */
.button-30 {
  
  align-items: center;
  appearance: none;
  background-color: #FCFCFD;
  border-radius: 4px;
  border-width: 0;
  box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
  box-sizing: border-box;
  color: #36395A;
  cursor: pointer;
  display: inline-flex;
  font-family: "JetBrains Mono",monospace;
  height: 48px;
  justify-content: center;
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 16px;
  padding-right: 16px;
  position: relative;
  text-align: left;
  text-decoration: none;
  transition: box-shadow .15s,transform .15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow,transform;
  font-size: 18px;
}

.button-30:focus {
  box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
}

.button-30:hover {
  box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  transform: translateY(-2px);
}

.button-30:active {
  box-shadow: #D6D6E7 0 3px 7px inset;
  transform: translateY(2px);
} 
   </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate electricity rate</title>
</head>
<body>
<h2 style="text-align: center;">Calculate Electricity Consumption</h2>
<form  method = "post" style="      margin: auto;
  width: 50%;
  border: 3px solid #1E5162;
  padding: 10px;">

  <label for="voltage">Voltage</label><br>
  <input type="number" step = "any" id="voltage" name="voltage" required><br><br>
  
  <label for="current">Current</label><br>
  <input type="number" step = "any" id="current" name="current" required><br><br>
  
  <label for="currentrate">Current Rate</label><br>
  <input type="number" step = "any" id="currentrate" name="currentrate" required><br><br>
  
  <input type="submit" value="Calculate" class="button-30"><br><br>

  </form><br>

    <table  border = "1">
            <tr>
                <th>#</th>
                <th>Hour</th>
                <th>Energy</th>
                <th>Total</th>
            </tr>
       

<?php
//initialize values and calculation
$total = 0;
$total24 = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //read user inputs for voltage, current, and current rate

    $voltage = $_POST["voltage"];
    $current = $_POST["current"]; 
    $currentrate = $_POST["currentrate"]; 
    $power = $voltage * $current;
    $hour = 1;
    $energy = $power * $hour * 1000;
    $total = $energy * ($currentrate/100);

   

    //calculate energy and total consumption per hour and per day
    
    $i = 1;

    do
    {
        $hour = $i;

        $energy = ($power * $hour)/1000;

        $total = $energy * ($currentrate/100);
        $total24 = $total24 + $total;

       
        ?>

<tr>
        <td><?php echo $hour . PHP_EOL; ?></td>
        <td><?php echo $hour  . PHP_EOL; ?></td>
        <td><?php echo $energy  . PHP_EOL; ?></td>
        <td><?php echo round($total,2) . PHP_EOL; ?></td>
        </tr>
      
   <?php

   $i++; 
    }while ($i <= 24);
    
    //display power, currentrate, total consumption of energy per day
?>
<div style="border: 1px solid">
<?php
    echo "<br>Power(kw):" . $power/1000 ; 
    echo "<br><br>Rate(RM):" . $currentrate/100;
    echo "<br><br>TOTAL PER DAY(24 Hours): " . $total24 . "<br>";
    echo "<br>";
   
    ?>
     </div>
     
    <?php 
    
    echo "<br>";
}

?>
</table>
</body>
</html>
