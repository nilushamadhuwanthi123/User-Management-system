<?php
require_once 'connection.php';

$sql = "SELECT * FROM user_details";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";

        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['userName'] . "</td>";
        echo "<td>" . $row['userGmail'] . "</td>";
        echo "<td>••••••••</td>";

        echo "<td>
                <a href='update.php?id=".$row['id']."' class='btn update'>Update</a>
                <a href='delete.php?id=".$row['id']."' class='btn delete' onclick='return confirm(\"Delete?\")'>Delete</a>
              </td>";

        echo "</tr>";
    }

} else {

    echo "<tr>
            <td colspan='5'>No Data Found</td>
          </tr>";
}

$conn->close();
?>