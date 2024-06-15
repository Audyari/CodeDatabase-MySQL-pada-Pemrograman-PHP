<!DOCTYPE html>
<html>

<head>
    <title>Tampilkan, Tambah, Ubah, dan Hapus Data Users</title>
    <style>
        /* CSS Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th,
        td {
            padding: 10px;
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

        .form-container {
            margin-bottom: 40px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Users</h1>
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
                // Execute the query
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                // Display the query results
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
                    echo "<tr><td colspan='5'>Tidak ada data.</td></tr>";
                }
            }

            $conn->close();
            ?>
        </table>

        <div class="form-container">
            <h1>Tambah Data User</h1>
            <form action="insert.php" method="post">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <button type="submit">Simpan</button>
            </form>
        </div>

        <div class="form-container">
            <h1>Cari Data User</h1>
            <form action="search.php" method="get">
                <label for="search_term">Kata Kunci:</label>
                <input type="text" id="search_term" name="search_term" required>
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</body>

</html>