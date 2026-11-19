<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form_data_diri.html");
    exit;
}

$nama          = isset($_POST["nama"]) ? trim($_POST["nama"]) : "";
$tanggal_lahir = isset($_POST["tanggal_lahir"]) ? trim($_POST["tanggal_lahir"]) : "";
$hobi          = isset($_POST["hobi"]) && is_array($_POST["hobi"]) ? $_POST["hobi"] : [];

if ($nama === "" || $tanggal_lahir === "") {
    echo "Nama dan tanggal lahir wajib diisi. <a href=\"form_data_diri.html\">Kembali ke Form</a>";
    exit;
}

$nama_bulan = [
    1  => "Januari",
    2  => "Februari",
    3  => "Maret",
    4  => "April",
    5  => "Mei",
    6  => "Juni",
    7  => "Juli",
    8  => "Agustus",
    9  => "September",
    10 => "Oktober",
    11 => "November",
    12 => "Desember",
];

if (preg_match('/^(\d{2})\/(\d{2})\/(\d{4})$/', $tanggal_lahir, $m)) {
    $tanggal_lahir = $m[3] . "-" . $m[2] . "-" . $m[1];
}

$bagian = explode("-", $tanggal_lahir);
if (count($bagian) === 3 && checkdate((int)$bagian[1], (int)$bagian[2], (int)$bagian[0])) {
    $tahun   = (int)$bagian[0];
    $bulan   = (int)$bagian[1];
    $tanggal = (int)$bagian[2];
    $tanggal_format = $tanggal . " " . $nama_bulan[$bulan] . " " . $tahun;
} else {
    $tanggal_format = $tanggal_lahir;
}

if (count($hobi) > 0) {
    $hobi_format = implode(", ", $hobi);
} else {
    $hobi_format = "Tidak ada hobi yang dipilih";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 40px 16px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 24px 32px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        h1 {
            margin: 16px 0;
            padding-bottom: 16px;
            font-size: 40px;
            border-bottom: 1px solid #e5e5e5;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        th, td {
            text-align: left;
            padding: 14px 16px 14px 0;
            font-size: 28px;
            vertical-align: middle;
        }

        th {
            font-weight: bold;
        }

        a {
            font-size: 24px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tampilan Data Anda</h1>

        <table>
            <tr>
                <th>Nama Lengkap:</th>
                <td><?php echo htmlspecialchars($nama); ?></td>
            </tr>
            <tr>
                <th>Tanggal Lahir:</th>
                <td><?php echo htmlspecialchars($tanggal_format); ?></td>
            </tr>
            <tr>
                <th>Hobi:</th>
                <td><?php echo htmlspecialchars($hobi_format); ?></td>
            </tr>
        </table>

        <a href="form.html">&laquo; Kembali ke Form</a>
    </div>
</body>
</html>