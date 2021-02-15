<body>
	<h2>Lee's F1 2019 Season Database</h2>

	<?php
	// Create connection
	$conn = new mysqli("ucdencsesql05.ucdenver.pvt", "student32", "password", "student32database");

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	?>

	<h2>Top 3 Constructors</h2>

	<?php
	$sql = "SELECT CONSTRUCTOR.Name as Constructor, SUM(SCOREBOARD.Points) Points
			FROM SCOREBOARD JOIN CAR JOIN CONSTRUCTOR
			WHERE SCOREBOARD.CarID = CAR.CarID 
			AND CAR.ConstructorID = CONSTRUCTOR.ConstructorID
			GROUP BY CONSTRUCTOR.ConstructorID
			ORDER BY Points DESC
			LIMIT 3";
	$result4 = $conn->query($sql);

	if ($result4->num_rows > 0){
		// Output Each row of data
		while($row = $result4->fetch_assoc()){
			echo "Constructor: " . $row["Constructor"]. " - Points: " . $row["Points"]. "<br>";
		}
	} else { echo "0 results";}
	?>

	<h2>Top 3 Drivers</h2>

	<?php
	$sql = "SELECT CAR.Driver as Driver, CONCAT(CAR.Maker, \" \", CAR.Model) AS CarType, CONSTRUCTOR.Name as CName, SUM(SCOREBOARD.Points) Points
    		FROM SCOREBOARD JOIN CAR JOIN CONSTRUCTOR
			WHERE SCOREBOARD.CarID = CAR.CarID
			AND CAR.ConstructorID = CONSTRUCTOR.ConstructorID
			GROUP BY SCOREBOARD.CarID
			ORDER BY Points DESC
			LIMIT 3";
	$result3 = $conn->query($sql);

	if ($result3->num_rows > 0){
		// Output Each row of data
		while($row = $result3->fetch_assoc()){
			echo "Driver: " . $row["Driver"]. " - Car: " . $row["CarType"]. " - Constructor: " . $row["CName"].  " - Points: " . $row["Points"]. "<br>";
		}
	} else { echo "0 results";}
	?>

	<h2>All Constructor Results</h2>

	<?php
	$sql = "SELECT * FROM CONSTRUCTOR";
	$result2 = $conn->query($sql);

	if ($result2->num_rows > 0){
		// Output Each row of data
		while($row = $result2->fetch_assoc()){
			echo "ConstructorID: " . $row["ConstructorID"]. " - Name: " . $row["Name"]. " - Principal: " . $row["Principal"]. " - Email Address: " . $row["EmailAddress"]. "<br>";
		}
	} else { echo "0 results";}
	?>

	<h2>All Race Results</h2>

	<?php
	$sql = "SELECT RACE.Date as RaceDay, RACE.TrackName as TrackName, CONCAT(CAR.Maker, \" \", CAR.Model) AS Car, CAR.Driver as CarDriver, SCOREBOARD.Points as Score 	
			FROM SCOREBOARD JOIN RACE JOIN CAR
			WHERE SCOREBOARD.RaceID = RACE.RaceID AND SCOREBOARD.CarID = CAR.CarID 
			ORDER BY RACE.Date, RACE.RaceID, SCOREBOARD.Points DESC";
	$result1 = $conn->query($sql);

	if ($result1->num_rows > 0){
		// Output Each row of data
		while($row = $result1->fetch_assoc()){
			echo "Date: " . $row["RaceDay"]. " - Track Name: " . $row["TrackName"]. " - Car: " . $row["Car"]. " - Driver: "  . $row["CarDriver"] . " - Points: " . $row["Score"]. "<br>";
		}
	} else { echo "0 results";}
	?>
	
</body>