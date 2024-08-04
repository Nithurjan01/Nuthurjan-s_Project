<?php
function fetchPublicHolidays() {
    $url = 'https://data.gov.sg/api/action/datastore_search?resource_id=6228c3c5-03bd-4747-bb10-85140f87168b&limit=10';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        throw new Exception('Error fetching public holidays.');
    }

    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Error decoding JSON response.');
    }

    return $data['result']['records'];
}

try {
    $holidays = fetchPublicHolidays();
} catch (Exception $e) {
    echo 'Failed to fetch holidays: ' . $e->getMessage();
    exit();
}
?>
<?php include 'header.php'; ?>
<main>
    <center><h2>Public Holidays</h2></center>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Holiday Name</th>
                <th>Day</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($holidays as $holiday): ?>
            <tr>
                <td><?php echo htmlspecialchars($holiday['date']); ?></td>
                <td><?php echo htmlspecialchars($holiday['holiday']); ?></td>
                <td><?php echo htmlspecialchars($holiday['day']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<?php include 'footer.php'; ?>
