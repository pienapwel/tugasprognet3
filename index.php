it<?php
include 'config.php';

function statusAC($suhu, $kelembapan) {
    if ($suhu < 16) {
        return "AC Mati";
    } elseif ($suhu >= 16 && $suhu < 25) {
        if ($kelembapan < 30) {
            return "AC Bekerja Rendah";
        } elseif ($kelembapan >= 30 && $kelembapan <= 50) {
            return "AC Bekerja Sedang";
        } else {
            return "AC Bekerja Sedang";
        }
    } elseif ($suhu >= 25 && $suhu <= 30) {
        if ($kelembapan < 30) {
            return "AC Bekerja Sedang";
        } elseif ($kelembapan >= 30 && $kelembapan <= 50) {
            return "AC Bekerja Sedang";
        } else {
            return "AC Bekerja Berat";
        }
    } else {
        return "AC Mati"; 
    }
}

$latest_data = null;
$rows = [];
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_data'])) {
    $suhu = $_POST['suhu'];
    $kelembapan = $_POST['kelembapan'];
    $statusAc = statusAC($suhu, $kelembapan); 

    $sql = "INSERT INTO data_ac (suhu, kelembapan, status_ac) VALUES (:suhu, :kelembapan, :status_ac)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['suhu' => $suhu, 'kelembapan' => $kelembapan, 'status_ac' => $statusAc]);

    $sql = "SELECT * FROM data_ac ORDER BY waktu DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $latest_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $message = "Status AC: " . $statusAc;
}

if (isset($_POST['histori'])) { 
    $sql = "SELECT * FROM data_ac ORDER BY waktu DESC";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Status AC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Sistem Status AC edit</h2>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="index.php" method="POST" class="input-form">
            <label for="suhu">Suhu (°C):</label>
            <input type="text" name="suhu" id="suhu" required inputmode="decimal" pattern="\d+(\.\d{1,2})?" placeholder="Masukkan suhu"><br><br>

            <label for="kelembapan">Kelembapan (%):</label>
            <input type="text" name="kelembapan" id="kelembapan" required inputmode="decimal" pattern="\d+(\.\d{1,2})?" placeholder="Masukkan kelembapan"><br><br>

            <input type="submit" name="submit_data" value="Submit">
        </form>

        <?php if ($latest_data): ?>
            <h3>Status AC</h3>
            <table class="data-table">
                <tr>
                    <th>Waktu</th>
                    <th>Suhu (°C)</th>
                    <th>Kelembapan (%)</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td><?php echo $latest_data['waktu']; ?></td>
                    <td><?php echo number_format($latest_data['suhu'], 0) . "°C"; ?></td>
                    <td><?php echo number_format($latest_data['kelembapan'], 0) . "%"; ?></td>
                    <td><?php echo $latest_data['status_ac']; ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <form action="index.php" method="POST">
            <input type="submit" name="histori" value="Histori">
        </form>

        <?php if (!empty($rows)): ?>
            <h3>Histori</h3>
            <table class="data-table">
                <tr>
                    <th>Waktu</th>
                    <th>Suhu (°C)</th>
                    <th>Kelembapan (%)</th>
                    <th>Status AC</th>
                </tr>
                <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $row['waktu']; ?></td>
                    <td><?php echo number_format($row['suhu'], 0) . "°C"; ?></td>
                    <td><?php echo number_format($row['kelembapan'], 0) . "%"; ?></td>
                    <td><?php echo $row['status_ac']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
`
