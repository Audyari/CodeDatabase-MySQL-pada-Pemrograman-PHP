<!DOCTYPE html>
<html>

<head>
    <title>Hasil Pencarian Data Users</title>
    <style>
        /* CSS Styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hasil Pencarian Data Users</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "my_database";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                echo "Gagal terhubung ke database!";
                die("Connection failed: " . $conn->connect_error);
            } else {
                // Get the search term from the URL parameter
                $search_term = $_GET['search_term'];

                // Execute the search query
                $sql = "SELECT * FROM users 
                        WHERE name LIKE '%$search_term%' 
                        OR email LIKE '%$search_term%'
                        OR id LIKE '%$search_term%'
                        OR created_at LIKE '%$search_term%'";
                $result = $conn->query($sql);

                // Display the search results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["created_at"] . "</td>";
                        echo "<td>
                                <a href='update.php?id=" . $row["id"] . "'>Ubah</a>
                                <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin?\")'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data yang ditemukan.</td></tr>";
                }
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>