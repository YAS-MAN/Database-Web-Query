<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SHOW QUERY CASE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-light">

<div class="container mt-4 mb-5">

  <!-- Navigation Tabs -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0 text-center">Database Management System</h4>
    </div>
    <div class="card-body">
      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="results-tab" data-bs-toggle="tab" data-bs-target="#results" type="button" role="tab" aria-controls="results" aria-selected="true">
            <i class="fa fa-table"></i> Hasil Query
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="database-tab" data-bs-toggle="tab" data-bs-target="#database" type="button" role="tab" aria-controls="database" aria-selected="false">
            <i class="fa fa-database"></i> Database Awal
          </button>
        </li>
      </ul>
    </div>
  </div>

  <!-- Tab Content -->
  <div class="tab-content" id="myTabContent">
    
    <!-- Success Messages -->
    <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa fa-check-circle"></i> Data berhasil diperbarui!
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fa fa-trash"></i> Data berhasil dihapus!
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    
    <!-- Results Tab -->
    <div class="tab-pane fade show active" id="results" role="tabpanel" aria-labelledby="results-tab">
      
  <!-- CASE A -->
  <div class="card mb-4 shadow">
      <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE A: Total Biaya per Pesanan & Kelompok</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
            <tr>
            <th>No</th>
            <th>Nomor Pesanan</th>
            <th>Jenis Produk</th>
            <th>Jml Pesanan</th>
            <th>Kelompok</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
          include "conn.php";
          $sql = "SELECT * FROM kasus_a"; 
          $stmt = $conn->query($sql);
          $no = 1;
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
              <td>{$no}</td>
              <td>{$row['NO_PESANAN']}</td>
              <td>{$row['JENIS_PRODUK']}</td>
                      <td>{$row['JML_PESANAN']}</td>
                      <td>{$row['KELOMPOK_BIAYA']}</td>
                      <td>".number_format($row['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=a&id={$row['NO_PESANAN']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=a&id={$row['NO_PESANAN']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=a&id={$row['NO_PESANAN']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
                    $no++;
          }
          ?>
        </tbody>
    </table>
    </div>
  </div>

  <!-- CASE B -->
  <div class="card mb-4 shadow">
      <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE B: Total Biaya per Bulan dan Kelompok</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Bulan</th>
            <th>Kelompok</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
          $sql2 = "SELECT * FROM kasus_b"; 
          $stmt2 = $conn->query($sql2);
          $no2 = 1;
          while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
              <td>{$no2}</td>
              <td>{$row2['TAHUN']}</td>
                      <td>{$row2['BULAN']}</td>
                      <td>{$row2['KELOMPOK_BIAYA']}</td>
                      <td>".number_format($row2['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=b&id={$row2['TAHUN']}-{$row2['BULAN']}-{$row2['KELOMPOK_BIAYA']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=b&id={$row2['TAHUN']}-{$row2['BULAN']}-{$row2['KELOMPOK_BIAYA']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=b&id={$row2['TAHUN']}-{$row2['BULAN']}-{$row2['KELOMPOK_BIAYA']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                      </tr>";
              $no2++;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- CASE C -->
</div>
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE C: Total Biaya per Jenis Produksi dan Kelompok</h5>
    </div>
    <div class="card-body">
      <table class="table table-striped table-bordered table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nama Pesanan</th>
            <th>Kelompok</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql3 = "SELECT * FROM kasus_c"; 
          $stmt3 = $conn->query($sql3);
          $no3 = 1;
          while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no3}</td>
                      <td>{$row3['NAMA_PESANAN']}</td>
                      <td>{$row3['kelompok']}</td>
                      <td>".number_format($row3['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=c&id={$row3['NAMA_PESANAN']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=c&id={$row3['NAMA_PESANAN']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=c&id={$row3['NAMA_PESANAN']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no3++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- CASE D -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE D: Analisis Biaya Produksi per Unit</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nomor Pesanan</th>
            <th>Jenis Produk</th>
            <th>Jumlah Pesanan</th>
            <th>Biaya Langsung</th>
            <th>Biaya Overhead</th>
            <th>Total Biaya</th>
            <th>Biaya Per Unit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql4 = "SELECT * FROM kasus_d"; 
          $stmt4 = $conn->query($sql4);
          $no4 = 1;
          while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no4}</td>
                      <td>{$row4['NOMOR_PESANAN']}</td>
                      <td>{$row4['JENIS_PRODUK']}</td>
                      <td>".number_format($row4['BIAYA_LANGSUNG'], 0, ',', '.')."</td>
                      <td>".number_format($row4['JML_PESANAN'], 0, ',', '.')."</td>
                      <td>".number_format($row4['BIAYA_OVERHEAD'], 0, ',', '.')."</td>
                      <td>".number_format($row4['TOTAL_BIAYA'], 0, ',', '.')."</td>
                      <td>".number_format($row4['BIAYA_PER_UNIT'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=d&id={$row4['NOMOR_PESANAN']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=d&id={$row4['NOMOR_PESANAN']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=d&id={$row4['NOMOR_PESANAN']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no4++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- CASE E -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE E: Statistik Biaya per Subkelompok</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Subkelompok</th>
            <th>Jumlah Biaya</th>
            <th>Jumlah Pesanan</th>
            <th>Rata_rata</th>
            <th>Max</th>
            <th>Min</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql5 = "SELECT * FROM kasus_e"; 
          $stmt5 = $conn->query($sql5);
          $no5 = 1;
          while ($row5 = $stmt5->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no5}</td>
                      <td>{$row5['SUBKELOMPOK']}</td>
                      <td>".number_format($row5['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>".number_format($row5['JML_PESANAN'], 0, ',', '.')."</td>
                      <td>".number_format($row5['RATA_RATA'], 0, ',', '.')."</td>
                      <td>".number_format($row5['BIAYA_MAX'], 0, ',', '.')."</td>
                      <td>".number_format($row5['BIAYA_MIN'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=e&id={$row5['SUBKELOMPOK']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=e&id={$row5['SUBKELOMPOK']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=e&id={$row5['SUBKELOMPOK']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no5++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <!-- CASE F -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE F: Biaya Pesanan khusus "Sepatu"</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nomor Pesanan</th>
            <th>Jenis Pesanan</th>
            <th>Jumlah Pesanan</th>
            <th>Kelompok</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql6 = "SELECT * FROM kasus_f"; 
          $stmt6 = $conn->query($sql6);
          $no8 = 1;
          while ($row6 = $stmt6->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no8}</td>
                      <td>{$row6['NOMOR_PESANAN']}</td>
                      <td>{$row6['JENIS_PRODUK']}</td>
                      <td>".number_format($row6['JUMLAH_PESANAN'], 0, ',', '.')."</td>
                      <td>{$row6['KELOMPOK_BIAYA']}</td>
                      <td>".number_format($row6['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=f&id={$row6['NOMOR_PESANAN']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=f&id={$row6['NOMOR_PESANAN']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=f&id={$row6['NOMOR_PESANAN']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no8++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- CASE G -->
   
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE G: Total Pesanan > 20 Juta</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Nomor Pesanan</th>
            <th>Jenis Pesanan</th>
            <th>Jumlah Pesanan</th>
            <th>Kelompok</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql7 = "SELECT * FROM kasus_f"; 
          $stmt7 = $conn->query($sql7);
          $no7 = 1;
          while ($row7 = $stmt7->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no7}</td>
                      <td>{$row7['NOMOR_PESANAN']}</td>
                      <td>{$row7['JENIS_PRODUK']}</td>
                      <td>".number_format($row7['JUMLAH_PESANAN'], 0, ',', '.')."</td>
                      <td>{$row7['KELOMPOK_BIAYA']}</td>
                      <td>".number_format($row7['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=g&id={$row7['NOMOR_PESANAN']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=g&id={$row7['NOMOR_PESANAN']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=g&id={$row7['NOMOR_PESANAN']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no7++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- CASE H -->
  <div class="card mb-4 shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0 text-center">CASE H: Pesanan Biaya Tertinggi</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-secondary">
          <tr>
            <th>No</th>
            <th>Kelompok</th>
            <th>Jenis Produk</th>
            <th>Nomor Pesanan</th>
            <th>Jumlah Biaya</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql8 = "SELECT * FROM kasus_h"; 
          $stmt8 = $conn->query($sql8);
          $no8 = 1;
          while ($row8 = $stmt8->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td>{$no8}</td>
                      <td>{$row8['KELOMPOK_BIAYA']}</td>
                      <td>{$row8['JENIS_PRODUK']}</td>
                      <td>{$row8['nomor_pesanan']}</td>
                      <td>".number_format($row8['JUMLAH_BIAYA'], 0, ',', '.')."</td>
                      <td>
                        <a href='detail.php?case=h&id={$row8['nomor_pesanan']}' class='btn btn-info btn-sm'><i class='fa fa-eye me-1'></i>Detail</a>
                        <a href='edit.php?case=h&id={$row8['nomor_pesanan']}' class='btn btn-success btn-sm'><i class='fa fa-edit me-1'></i>Edit</a>
                        <a href='delete.php?case=h&id={$row8['nomor_pesanan']}' class='btn btn-danger btn-sm'><i class='fa fa-trash me-1'></i>Delete</a>
                      </td>
                    </tr>";
              $no8++;
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
    </div>
    
    <!-- Database Tab -->
    <div class="tab-pane fade" id="database" role="tabpanel" aria-labelledby="database-tab">
      
      <!-- Database Tables -->
      <div class="card mb-4 shadow">
        <div class="card-header bg-info text-white">
          <h5 class="mb-0 text-center">Tabel Database Awal</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 mb-4">
              <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                  <h6 class="mb-0 text-center">Tabel Pesanan</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                      <thead class="table-light text-center">
                        <tr>
                          <th>Nomor Pesanan</th>
                          <th>Jenis Pesanan</th>
                          <th>Jumlah Pesanan</th>
                          <th>Tanggal Pesanan</th>
                          <th>Tanggal Selesai</th>
                          <th>Pemesan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        try {
                          // Sesuaikan nama tabel dasar Anda jika berbeda
                          $pesananStmt = $conn->query("SELECT nomor_pesanan, jenis_pesanan, jml_pesanan, tgl_pesanan, tgl_selesai, pemesan FROM kartupesanan ORDER BY nomor_pesanan");
                          while ($p = $pesananStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>".
                                 "<td class='text-center'>".htmlspecialchars($p['nomor_pesanan'])."</td>".
                                 "<td>".htmlspecialchars($p['jenis_pesanan'])."</td>".
                                 "<td class='text-end'>".number_format((float)$p['jml_pesanan'], 0, ',', '.')."</td>".
                                 "<td class='text-center'>".htmlspecialchars($p['tgl_pesanan'])."</td>".
                                 "<td class='text-center'>".htmlspecialchars($p['tgl_selesai'])."</td>".
                                 "<td>".htmlspecialchars($p['pemesan'])."</td>".
                                 "</tr>";
                          }
                        } catch (Exception $e) {
                          echo "<tr><td colspan='6' class='text-danger'>Gagal memuat tabel pesanan: ".htmlspecialchars($e->getMessage())."</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                  <h6 class="mb-0 text-center">Tabel Biaya</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                      <thead class="table-light text-center">
                        <tr>
                          <th>Nomor Pesanan</th>
                          <th>Tanggal</th>
                          <th>Kelompok</th>
                          <th>Subkelompok</th>
                          <th>Jumlah</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        try {
                          // Sesuaikan nama tabel dasar Anda jika berbeda
                          $biayaStmt = $conn->query("SELECT nomor_pesanan, tgl, kelompok, subkelompok, jumlah FROM `rincianbiaya` ORDER BY nomor_pesanan, tgl");
                          while ($b = $biayaStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>".
                                 "<td class='text-center'>".htmlspecialchars($b['nomor_pesanan'])."</td>".
                                 "<td class='text-center'>".htmlspecialchars($b['tgl'])."</td>".
                                 "<td>".htmlspecialchars($b['kelompok'])."</td>".
                                 "<td>".htmlspecialchars($b['subkelompok'])."</td>".
                                 "<td class='text-end'>".number_format((float)$b['jumlah'], 0, ',', '.')."</td>".
                                 "</tr>";
                          }
                        } catch (Exception $e) {
                          echo "<tr><td colspan='5' class='text-danger'>Gagal memuat tabel biaya: ".htmlspecialchars($e->getMessage())."</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
