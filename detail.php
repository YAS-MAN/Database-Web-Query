<?php
include "conn.php";

// Get parameters
$case = $_GET['case'] ?? '';
$id = $_GET['id'] ?? '';

// Validate case parameter
$valid_cases = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
if (!in_array($case, $valid_cases)) {
    die("Invalid case parameter");
}

// Get data based on case
$data = null;
$table_name = "kasus_" . $case;

switch($case) {
    case 'a':
        $sql = "SELECT * FROM kasus_a WHERE NO_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case A: Total Biaya per Pesanan & Kelompok";
        break;
    case 'b':
        $sql = "SELECT * FROM kasus_b WHERE TAHUN = ? AND BULAN = ? AND KELOMPOK_BIAYA = ?";
        $params = explode('-', $id);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case B: Total Biaya per Bulan dan Kelompok";
        break;
    case 'c':
        $sql = "SELECT * FROM kasus_c WHERE NAMA_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case C: Total Biaya per Nama Pesanan";
        break;
    case 'd':
        $sql = "SELECT * FROM kasus_d WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case D: Detail Biaya per Pesanan";
        break;
    case 'e':
        $sql = "SELECT * FROM kasus_e WHERE SUBKELOMPOK = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case E: Statistik per Subkelompok";
        break;
    case 'f':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case F: Detail Pesanan";
        break;
    case 'g':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case G: Detail Pesanan (Duplikat F)";
        break;
    case 'h':
        $sql = "SELECT * FROM kasus_h WHERE nomor_pesanan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Detail Case H: Detail per Kelompok";
        break;
}

if (!$data) {
    die("Data not found");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail - <?php echo $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">
  
  <!-- Header -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><?php echo $title; ?></h4>
      <a href="index.php" class="btn btn-light">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <!-- Detail Content -->
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Informasi Detail</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <?php foreach($data as $key => $value): ?>
        <div class="col-md-6 mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title text-muted"><?php echo str_replace('_', ' ', $key); ?></h6>
              <p class="card-text">
                <?php 
                if (is_numeric($value) && strpos($value, '.') !== false) {
                  echo "Rp " . number_format($value, 0, ',', '.');
                } else {
                  echo htmlspecialchars($value);
                }
                ?>
              </p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="card mt-4 shadow">
    <div class="card-body text-center">
      <a href="edit.php?case=<?php echo $case; ?>&id=<?php echo $id; ?>" class="btn btn-success me-2">
        <i class="fa fa-edit"></i> Edit Data
      </a>
      <a href="delete.php?case=<?php echo $case; ?>&id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
        <i class="fa fa-trash"></i> Hapus Data
      </a>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
