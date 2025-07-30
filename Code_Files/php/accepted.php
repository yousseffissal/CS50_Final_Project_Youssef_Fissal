<?php
// Database connection configuration
$host = "localhost";
$dbname = "Registrations";
$user = "root";
$pass = "";

try {
    // Establish database connection using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all accepted applicants from the database
    $stmt = $pdo->query("SELECT full_name FROM registrations WHERE is_accepted = 1 ORDER BY full_name ASC");
    $accepted = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If connection fails, show the error
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../imgs & videos/img/favacon.png" />
    <title>CTDE 2026 - Accepted Applicants</title>

    <style>
        /* ---------- Global Layout ---------- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, rgb(184, 241, 248), rgb(94, 181, 192), rgb(51, 165, 180));
            padding: 20px;
            display: flex;
            justify-content: center;
            text-align: center;
            min-height: 100vh;
        }

        /* ---------- Scrollbar Styling ---------- */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: linear-gradient(180deg, rgb(184, 241, 248), rgb(94, 181, 192), rgb(51, 165, 180));
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(51, 148, 151);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(3, 28, 29);
        }

        /* ---------- Typography ---------- */
        h2:not(.message) {
            color: green;
        }

        h3 {
            color: red;
        }

        .message {
            color: red;
            font-weight: bold;
        }

        /* ---------- Table Styling ---------- */
        table {
            width: 50vw;
            max-width: 700px;
            min-width: 320px;
            border-collapse: collapse;
            background: rgb(223, 222, 161);
            box-shadow: -3px 3px 3px rgba(0, 0, 0, 0.34);
            margin: 0 auto;
        }

        th, td {
            border: 1px solid black;
            padding: 15px;
            text-align: center;
            font-size: 1.1em;
            color: #0d3c0d;
        }

        th {
            background-color: rgb(27, 177, 40);
            color: white;
            font-weight: 700;
        }

        tr:nth-child(even) {
            background-color: rgb(224, 221, 217);
        }

        /* ---------- Responsive Design ---------- */
        @media (max-width: 400px) {
            table {
                width: 90vw;
                min-width: unset;
            }
        }
    </style>
</head>

<body>
    <div>
        <h2>
            ✅ <span style="color: red;">CTDE CLUB Registration 2026<br></span>
            Accepted Applicants List
        </h2>

        <?php if (count($accepted) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($accepted as $index => $applicant): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($applicant['full_name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>For more informations, contact us 📧</h3>
        <?php else: ?>
            <h2 class="message">No accepted applicants yet</h2>
        <?php endif; ?>
    </div>
</body>
</html>