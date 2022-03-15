<!DOCTYPE html>
<html>
<body>

<h2>JavaScript Array Methods</h2> 
<h2>shift()</h2>
<p>The shift() method removes the first element of an array (and "shifts" the other elements to the left):</p>

<p id="demo1"></p>
<p id="demo2"></p>

<script>
var salary = [
   ["ABC", 24, 18000],
   ["EFG", 30, 30000],
   ["IJK", 28, 41000],
   ["EFG", 31, 28000],
];

var data=JSON.stringify(salary);
document.getElementById("demo1").innerHTML = salary;



//document.getElementById("demo2").innerHTML = data;
</script>

</body>
</html>


<?php

$Data = '<script type="text/javascript"> data </script>';

 print_r(json_decode($Data));?>