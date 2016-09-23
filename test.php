<!DOCTYPE HTML>
<html lang = en>
<head>
<meta charset = "UTF-8">
 
<title> My Diary </title>
<h1> Blank Diary Entry </h1>

<style>
/*Style form using CSS*/
h1 {
    color: white;
    font-family: Georgia, Helvetica, sans-serif;
    text-decoration: underline;
    text-align: center;
}

#entryform {
border-collapse: collapse;
  border: 1px dotted black;
}

#heading {
  border: 1px dotted black;
  text-decoration: underline;
  background-color: #cc0000;
  font-family: Georgia, Helvetica, sans-serif;
  color: white;  
}

#entry {
  border: 1px dotted black;
  background-color: #cc0000;
  padding: 10px;
  border radius: 8px;
}

tr#tr01 textarea {
  height: 300px;
  width: 200px;
  padding: 15px;
  background-color: #ff8080;
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  border-radius: 8px;
  border: 1px dotted white;
}

#buttons{
  background-color: #e60000;
  border: 1px dotted black;
  width: 1270px; 
  padding: 5px; 
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px; 
  text-align: center;
  border-radius: 4px;
}

/*#submit {
  border: 1px dotted black;
  width: 200px; 
  padding: 5px; 
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px; 
  text-align: center;
  border-radius: 4px;
}

#show {
  border: 1px dotted black;
  width: 200px; 
  padding: 5px; 
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  font-size: 14px; 
  text-align: center;
  border-radius: 4px;
}
*/

body {
    background-color: #990000;
}

table {
     border-collapse: collapse;
     width: 100%;
}

table, th, td {
    border: 1px dotted white;
    background-color: black;
    font-family: Helvetica Neue, Helvetica, Arial,sans-serif;
    color: white;
    text-align: center;
    padding: 15px;
}

</style>

<script>
/*JS function that validates the form. Alert box will pop up if textboxes are empty*/
function validate() {
		if(document.getElementById("input01").value == ""){
			alert("Please fill in entry");
			return false;
		}	
                else if(document.getElementById("input02").value ==""){
                        alert("Please fill in entry");
                        return false;
	}
               else if(document.getElementById("input03").value ==""){
                        alert("Please fill in entry");
                        return false;
	}
                else if(document.getElementById("input04").value ==""){
                        alert("Please fill in entry");
                        return false;
	}
                 else if(document.getElementById("input05").value ==""){
                        alert("Please fill in entry");
                        return false;
	}
	return true;
}

</script>

</head>

<body>
<!--Making input form using html-->
<table id="entryform">
<tr id="tr01">
    <th id="heading">Where/When</th>
    <th id="heading">Event</th>
    <th id="heading">Emotion</th>
    <th id="heading">Thoughts</th>
    <th id="heading">Response</th>
</tr>

<form name="diaryform" method="post">
    <tr id = "tr01">
        <td id="entry"><textarea type="text" id="input01" name="text01"></textarea></td>
         <td id="entry"><textarea type="text" id="input02" name="text02"></textarea></td>
         <td id="entry"><textarea type="text" id="input03" name="text03"></textarea></td>
         <td id="entry"><textarea type="text" id="input04" name="text04"></textarea></td>
         <td id="entry"><textarea type="text" id="input05" name="text05"></textarea></td>
    </tr>

<div id="buttons">
<button id="submit" name="save" type="submit" onClick="return validate();">Save Diary</button>
<button id="show" name="showdiary">Show Diary</button>
</div>
</form>

</table>

<?php
/*
$_POST['Where_When']=null;
$_POST['Event']=null;
$_POST['Emotion']=null;
$_POST['Thoughts']=null;
$_POST['Response']=null;*/

$servername = "localhost";
$username = "";
$password = "";
$dbname = "Diary";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


// Create database - Uncomment IF statement to check
$sql = "CREATE DATABASE Diary";
/*if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}*/


// sql to create table - Uncomment IF statement to check
$sql = "CREATE TABLE MyDiary3 (
Where_When TEXT NOT NULL,
Event TEXT,
Emotion TEXT,
Thoughts TEXT,
Response TEXT
)";

/*if ($conn->query($sql) === TRUE) {
    echo "Table MyDiary3 created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}*/

//Checks form, selects data and puts them in a new table
if (isset($_POST['showdiary'])) {
    $sql = "SELECT * FROM MyDiary3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row

echo "<table>
<tr>
    <th>Where/When</th>
    <th>Event</th>
    <th>Emotion</th>
    <th>Thoughts</th>
    <th>Response</th>
</tr>";

     while($row = $result->fetch_assoc()) {
         echo "<tr>";
         echo "<td>".$row['Where_When']."</td>";
         echo "<td>".$row['Event']."</td>";
         echo "<td>".$row['Emotion']."</td>";
         echo "<td>".$row['Thoughts']."</td>";
         echo "<td>".$row['Response']."</td>";
         echo"</tr>";
     }
} else {
     echo "0 results";
	}

}

//Inserts data into the database when the button named "save" is clicked
if(isset($_POST['save'])) {
$sql = "INSERT INTO MyDiary3 (Where_When, Event, Emotion, Thoughts, Response)
VALUES ('$_POST[text01]','$_POST[text02]','$_POST[text03]','$_POST[text04]','$_POST[text05]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();
?> 

</body>
</html>

    
