<?php
			// Include database connection
			include('db_connect.php');

			// Get all savings
			$savings_result = mysqli_query($conn, "SELECT * FROM savings");

			if (mysqli_num_rows($savings_result) > 0) {
				echo "<table>";
				echo "<tr><th>Member ID</th><th>Amount</th></tr>";

				while ($row = mysqli_fetch_assoc($savings_result)) {
					echo "<tr>";
					echo "<td>" . $row['member_id'] . "</td>";
					echo "<td>" . $row['amount'] . "</td>";
					echo "</tr>";
				}

				echo "</table>";
			} else {
				echo "<p>No savings found.</p>";
			}

			// Close database connection
			mysqli_close($conn);
		?>