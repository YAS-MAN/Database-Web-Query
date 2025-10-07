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

// Handle form submission
if ($_POST) {
    try {
        switch($case) {
            case 'a':
                $sql = "UPDATE kasus_a SET JENIS_PRODUK = ?, JML_PESANAN = ?, KELOMPOK_BIAYA = ?, JUMLAH_BIAYA = ? WHERE NO_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['JENIS_PRODUK'],
                    $_POST['JML_PESANAN'],
                    $_POST['KELOMPOK_BIAYA'],
                    $_POST['JUMLAH_BIAYA'],
                    $id
                ]);
                break;
            case 'b':
                $sql = "UPDATE kasus_b SET KELOMPOK_BIAYA = ?, JUMLAH_BIAYA = ? WHERE TAHUN = ? AND BULAN = ? AND KELOMPOK_BIAYA = ?";
                $params = explode('-', $id);
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['KELOMPOK_BIAYA'],
                    $_POST['JUMLAH_BIAYA'],
                    $params[0],
                    $params[1],
                    $params[2]
                ]);
                break;
            case 'c':
                $sql = "UPDATE kasus_c SET kelompok = ?, JUMLAH_BIAYA = ? WHERE NAMA_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['kelompok'],
                    $_POST['JUMLAH_BIAYA'],
                    $id
                ]);
                break;
            case 'd':
                $sql = "UPDATE kasus_d SET JENIS_PRODUK = ?, BIAYA_LANGSUNG = ?, JML_PESANAN = ?, BIAYA_OVERHEAD = ?, TOTAL_BIAYA = ?, BIAYA_PER_UNIT = ? WHERE NOMOR_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['JENIS_PRODUK'],
                    $_POST['BIAYA_LANGSUNG'],
                    $_POST['JML_PESANAN'],
                    $_POST['BIAYA_OVERHEAD'],
                    $_POST['TOTAL_BIAYA'],
                    $_POST['BIAYA_PER_UNIT'],
                    $id
                ]);
                break;
            case 'e':
                $sql = "UPDATE kasus_e SET JUMLAH_BIAYA = ?, JML_PESANAN = ?, RATA_RATA = ?, BIAYA_MAX = ?, BIAYA_MIN = ? WHERE SUBKELOMPOK = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['JUMLAH_BIAYA'],
                    $_POST['JML_PESANAN'],
                    $_POST['RATA_RATA'],
                    $_POST['BIAYA_MAX'],
                    $_POST['BIAYA_MIN'],
                    $id
                ]);
                break;
            case 'f':
            case 'g':
                $sql = "UPDATE kasus_f SET JENIS_PRODUK = ?, JUMLAH_PESANAN = ?, KELOMPOK_BIAYA = ?, JUMLAH_BIAYA = ? WHERE NOMOR_PESANAN = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['JENIS_PRODUK'],
                    $_POST['JUMLAH_PESANAN'],
                    $_POST['KELOMPOK_BIAYA'],
                    $_POST['JUMLAH_BIAYA'],
                    $id
                ]);
                break;
            case 'h':
                $sql = "UPDATE kasus_h SET KELOMPOK_BIAYA = ?, JENIS_PRODUK = ?, JUMLAH_BIAYA = ? WHERE nomor_pesanan = ?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    $_POST['KELOMPOK_BIAYA'],
                    $_POST['JENIS_PRODUK'],
                    $_POST['JUMLAH_BIAYA'],
                    $id
                ]);
                break;
        }
        
        header("Location: index.php?success=1");
        exit();
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}

// Get current data
$data = null;
switch($case) {
    case 'a':
        $sql = "SELECT * FROM kasus_a WHERE NO_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case A: Total Biaya per Pesanan & Kelompok";
        break;
    case 'b':
        $sql = "SELECT * FROM kasus_b WHERE TAHUN = ? AND BULAN = ? AND KELOMPOK_BIAYA = ?";
        $params = explode('-', $id);
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case B: Total Biaya per Bulan dan Kelompok";
        break;
    case 'c':
        $sql = "SELECT * FROM kasus_c WHERE NAMA_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case C: Total Biaya per Nama Pesanan";
        break;
    case 'd':
        $sql = "SELECT * FROM kasus_d WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case D: Detail Biaya per Pesanan";
        break;
    case 'e':
        $sql = "SELECT * FROM kasus_e WHERE SUBKELOMPOK = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case E: Statistik per Subkelompok";
        break;
    case 'f':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case F: Detail Pesanan";
        break;
    case 'g':
        $sql = "SELECT * FROM kasus_f WHERE NOMOR_PESANAN = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case G: Detail Pesanan (Duplikat F)";
        break;
    case 'h':
        $sql = "SELECT * FROM kasus_h WHERE nomor_pesanan = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $title = "Edit Case H: Detail per Kelompok";
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
  <title>Edit - <?php echo $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">
  
  <!-- Header -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><?php echo $title; ?></h4>
      <a href="detail.php?case=<?php echo $case; ?>&id=<?php echo $id; ?>" class="btn btn-secondary">
        <i class="fa fa-eye"></i> Lihat Detail
      </a>
    </div>
  </div>

  <?php if (isset($error)): ?>
  <div class="alert alert-danger">
    <?php echo $error; ?>
  </div>
  <?php endif; ?>

  <!-- Edit Form -->
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Form Edit Data</h5>
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="row">
          <?php foreach($data as $key => $value): ?>
          <?php if ($key != 'NO_PESANAN' && $key != 'TAHUN' && $key != 'BULAN' && $key != 'NOMOR_PESANAN' && $key != 'SUBKELOMPOK' && $key != 'NAMA_PESANAN' && $key != 'nomor_pesanan'): ?>
          <div class="col-md-6 mb-3">
            <label for="<?php echo $key; ?>" class="form-label"><?php echo str_replace('_', ' ', $key); ?></label>
            <input type="<?php echo (is_numeric($value) && strpos($value, '.') !== false) ? 'number' : 'text'; ?>" 
                   class="form-control" 
                   id="<?php echo $key; ?>" 
                   name="<?php echo $key; ?>" 
                   value="<?php echo htmlspecialchars($value); ?>"
                   step="0.01"
                   required>
          </div>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
          <button type="submit" class="btn btn-success me-2">
            <i class="fa fa-save"></i> Simpan Perubahan
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
