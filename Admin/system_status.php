<?php
header('Content-Type: application/json');

// Get CPU usage (Windows)
$cpu_cmd = 'wmic cpu get loadpercentage';
exec($cpu_cmd, $cpu_output);
$cpu_usage = isset($cpu_output[1]) ? (int)trim($cpu_output[1]) : 0;

// Get RAM usage (Windows)
$mem_cmd = 'wmic OS get FreePhysicalMemory,TotalVisibleMemorySize /Value';
exec($mem_cmd, $mem_output);

$mem_data = [];
foreach ($mem_output as $line) {
    $parts = explode("=", $line);
    if (count($parts) == 2) {
        $mem_data[trim($parts[0])] = (int)trim($parts[1]);
    }
}

$mem_total_kb = $mem_data['TotalVisibleMemorySize'] ?? 1; // avoid division by zero
$mem_free_kb = $mem_data['FreePhysicalMemory'] ?? 0;
$mem_used_kb = $mem_total_kb - $mem_free_kb;
$mem_usage_percent = round(($mem_used_kb / $mem_total_kb) * 100, 2);

// Return as JSON
echo json_encode([
    'cpu' => $cpu_usage,
    'ram' => $mem_usage_percent
]);
