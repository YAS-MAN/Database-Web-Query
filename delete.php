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

// Handle deletion
if ($_POST && $_POST['confirm'] === 'yes') {
    try {
        switch($case) {
            case 'a':
                $sql = "DELETE FROM kasus_a WHERE NO_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'b':
                $sql = "DELETE FROM kasus_b WHERE TAHUN = ? AND BULAN = ? AND KELOMPOK_BIAYA = ?";
                $params = explode('-', $id);
                $stmt = $conn->prepare($sql);
                $stmt->execute($params);
                break;
            case 'c':
                $sql = "DELETE FROM kasus_c WHERE NAMA_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'd':
                $sql = "DELETE FROM kasus_d WHERE NOMOR_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'e':
                $sql = "DELETE FROM kasus_e WHERE SUBKELOMPOK = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'f':
                $sql = "DELETE FROM kasus_f WHERE NOMOR_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'g':
                $sql = "DELETE FROM kasus_f WHERE NOMOR_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
            case 'h':
                $sql = "DELETE FROM kasus_h WHERE nomor_pesanan = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);
                break;
        }
        
        header("Location: index.php?deleted=1");
        exit();
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get data for confirmation
$data = null;
switch($case) {
    case 'a':
        $sql = "SELECT * FROM kasus_a WHERE NO_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case A: Total Biaya per Pesanan & Kelompok";
        break;
    case 'b':
        $sql = "SELECT * FROM kasus_b WHERE TAHUN = ? AND BULAN = ? AND KELOMPOK_BIAYA = ?";
        $params = explode('-', $id);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case B: Total Biaya per Bulan dan Kelompok";
        break;
    case 'c':
        $sql = "SELECT * FROM kasus_c WHERE NAMA_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case C: Total Biaya per Nama Pesanan";
        break;
    case 'd':
        $sql = "SELECT * FROM kasus_d WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case D: Detail Biaya per Pesanan";
        break;
    case 'e':
        $sql = "SELECT * FROM kasus_e WHERE SUBKELOMPOK = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case E: Statistik per Subkelompok";
        break;
    case 'f':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case F: Detail Pesanan";
        break;
    case 'g':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case G: Detail Pesanan (Duplikat F)";
        break;
    case 'h':
        $sql = "SELECT * FROM kasus_h WHERE nomor_pesanan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Hapus Case H: Detail per Kelompok";
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
  <title>Hapus - <?php echo $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">
  
  <!-- Header -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><?php echo $title; ?></h4>
      <a href="detail.php?case=<?php echo $case; ?>&id=<?php echo $id; ?>" class="btn btn-light">
        <i class="fa fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>

  <?php if (isset($error)): ?>
  <div class="alert alert-danger">
    <?php echo $error; ?>
  </div>
  <?php endif; ?>

  <!-- Confirmation -->
  <div class="card shadow">
    <div class="card-header bg-warning text-dark">
      <h5 class="mb-0"><i class="fa fa-exclamation-triangle"></i> Konfirmasi Penghapusan</h5>
    </div>
    <div class="card-body">
      <div class="alert alert-danger">
        <h6><i class="fa fa-warning"></i> Peringatan!</h6>
        <p class="mb-0">Anda akan menghapus data berikut. Tindakan ini tidak dapat dibatalkan!</p>
      </div>
      
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
      
      <form method="POST" class="mt-4">
        <div class="text-center">
          <button type="submit" name="confirm" value="yes" class="btn btn-danger me-2">
            <i class="fa fa-trash"></i> Ya, Hapus Data
          </button>
          <a href="detail.php?case=<?php echo $case; ?>&id=<?php echo $id; ?>" class="btn btn-secondary">
            <i class="fa fa-times"></i> Batal
          </a>
        </div>
      </form>
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
