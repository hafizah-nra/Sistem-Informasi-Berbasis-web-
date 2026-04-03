<!DOCTYPE html>
<html>
<head>
<title>Tabel 5 Warna</title>

<style>

body{
    display:flex;
    justify-content:center;  
    align-items:center;       
    height:100vh;             
}

table{
    border-collapse: collapse;
}

td{
    width:80px;
    height:60px;
    text-align:center;
    border:2px solid black;
    font-size:18px;
}

.baris1 td:hover{
    background:red;
    color:white;
}

.baris2 td:hover{
    background:yellow;
}

.baris3 td:hover{
    background:green;
    color:white;
}

.baris4 td:hover{
    background:blue;
    color:white;
}

.baris5 td:hover{
    background:brown;
    color:white;
}

</style>
</head>

<body>

<table>

<?php
for($i=1;$i<=5;$i++){
    echo "<tr class='baris$i'>";
    
    for($j=1;$j<=5;$j++){
        echo "<td>$i,$j</td>";
    }
    
    echo "</tr>";
}
?>

</table>

</body>
</html>