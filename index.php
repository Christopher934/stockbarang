<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">BSG Cabang Utama</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link " href="logout.php">
                            <div class="sb-nav-link-icon"></div>
                            Logout
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Stock Barang</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah
                            </button>
                            <a href="export.php" class="btn btn-info">Export</a>
                        </div>
                        <div class="card-body">
                            <?php
                            $ambildatastock = mysqli_query($conn, 'SELECT * FROM stock');
                            while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                $barang = $fetch['namabarang'];
                                $stock = $fetch['stock'];

                                if ($stock < 10 && $stock > 0) { // Stock is less than 10 but still greater than 0
                            ?>
                            <!-- Alert for low stock -->
                            <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Perhatian!</strong> Stock Barang <?=$barang;?> Hampir Habis
                            </div>
                            <?php
                                } elseif ($stock <= 0) { // Stock is 0 or less (out of stock)
                            ?>
                            <!-- Alert for out of stock -->
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Perhatian!</strong> Barang <?=$barang;?> Sudah Habis
                            </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Nomor Seri</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Harga Per Unit</th>
                                            <th>Harga Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $ambilsemuadatastock = mysqli_query($conn,"select * from stock");
                                            $i=1;
                                            while ($data=mysqli_fetch_array($ambilsemuadatastock)){
                                                $namabarang = $data['namabarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $stock = $data['stock'];
                                                $hargaperunit = $data['hargabarang'];
                                                $idb = $data['idbarang'];
                                                $nomorseri = $data['nomorseri'];
                                                $hargatotal = $hargaperunit * $stock;
                                            ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$nomorseri?></td>
                                            <td><?=$deskripsi;?></td>
                                            <td><?=$stock;?></td>
                                            <td>Rp <?=number_format($hargaperunit, 2, ',', '.');?></td>
                                            <!-- Menampilkan harga per unit dengan format Rupiah -->
                                            <td>Rp <?=number_format($hargatotal, 2, ',', '.');?></td>
                                            <!-- Menampilkan harga total dengan format Rupiah -->
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#edit<?=$idb?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete<?=$idb?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$idb?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Barang</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="namabarang">Nama Barang</label>
                                                                <input type="text" name="namabarang" id="namabarang"
                                                                    value="<?=$namabarang?>" class="form-control"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nomorseri">Nomor Seri</label>
                                                                <input type="text" name="nomorseri" id="nomorseri"
                                                                    value="<?=$nomorseri?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deskripsi">Deskripsi</label>
                                                                <input type="text" name="deskripsi" id="deskripsi"
                                                                    value="<?=$deskripsi?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="hargabarang">Harga Barang</label>
                                                                <input type="number" name="hargabarang" id="hargabarang"
                                                                    class="form-control" value="<?=$hargaperunit?>"
                                                                    required>
                                                            </div>
                                                            <input type="hidden" name="idb" value="<?=$idb?>">

                                                            <button type="submit" class="btn btn-primary"
                                                                name="updatebarang">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?=$idb?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <div class="pb-1">Apakah Anda yakin ingin menghapus
                                                                <?=$namabarang?>?
                                                            </div>
                                                            <br><br>
                                                            <input type="hidden" name="idb" value="<?=$idb?>">
                                                            <button type="submit" class="btn btn-danger"
                                                                name="hapusbarang">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            };

                                            ?>

                                    </tbody>

                                </table>
                                <?php
                                    $totalharga = 0;
                                    $ambilsemuadatastock = mysqli_query($conn,"select * from stock");
                                    while ($data=mysqli_fetch_array($ambilsemuadatastock)){
                                    $stock = $data['stock'];
                                    $hargaperunit = $data['hargabarang'];

                                    $hargatotal = $hargaperunit * $stock;
                                    $totalharga += $hargatotal;
                                    }
                                ?>

                                <h5 class="pt-2">
                                    Total Harga Semua Barang Stock: Rp <?=number_format($totalharga, 2, ',', '.');?>
                                </h5>

                            </div>
                        </div>

                    </div>
                </div>

            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2020</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="nomorseri" placeholder="Nomor Seri" class="form-control">
                    <br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi barang" class="form-control">
                    <br>
                    <input type="number" name="stock" class="form-control" placeholder="Jumlah" required>
                    <br>
                    <input type="number" name="hargabarang" class="form-control" placeholder="Harga" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang">Submit</button>
                </div>
            </form>


        </div>
    </div>
</div>

</html>