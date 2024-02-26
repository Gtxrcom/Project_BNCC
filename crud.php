<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "crud";

$connection   = mysqli_connect($host,$user,$pass,$db);

if(!$connection){
    die("Cant connect");

}

$nama    = "";
$umur    = "";
$alamat  = "";
$phone   = "";
$success = "";
$error   = "";

if(isset($_GET['op'])){

    $op = $_GET['op'];

}else{
    $op = "";
}

if($op == 'delete'){
    
    $id         = $_GET['id'];
    $sql1       = "delete from cruds where id = $id";
    $q1         = mysqli_query($connection,$sql1);

    if($q1){

        $success = "Berhasil hapus data";
    }else{
        $error = "Gagal hapus data";
    }

}


if($op == 'edit'){

    $id         = $_GET['id'];
    $sql1       = "select * from cruds where id = '$id'";
    $q1         = mysqli_query($connection, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $umur       = $r1['umur'];
    $alamat     = $r1['alamat'];
    $phone      = $r1['phone'];
    
    if($nama == ''){

    $error = "Data tidak ditemukan";

    }
}


if(isset($_POST['simpan'])){ // untuk create

  $nama         = $_POST['nama'];
  $umur         = $_POST['umur'];
  $alamat       = $_POST['alamat'];
  $phone        = $_POST['phone'];

  if($nama && $umur && $alamat && $phone){
    if($op == 'edit'){ // untuk update
        $sql1       = "update cruds set nama = '$nama',umur = '$umur', alamat = '$alamat', phone = '$phone' where id = '$id'";
        $q1         =  mysqli_query($connection, $sql1);

        if($q1){
            $success = "Data berhasil diupdate";
        }else{
            $error = "Data gagal diupdate";
        }
    } else{ // untuk insert
       
        $sql1 = "insert into cruds(nama,umur,alamat,phone) values('$nama', '$umur', '$alamat', '$phone')";
    $q1   = mysqli_query($connection, $sql1);

    if($q1){
        $success  = "Data berhasil masuk";

    }else{
        $error   = "Gagal masukkan data";
    }

    }

    
  }else {
        $error = "Silahkan masukkan semua data";

  }

}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta htttp-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    .mx-auto {
        width: 800px
    }

    .card {
        margin-top: 10px;
    }
    </style>

</head>

<body>
    <div class="mx-auto">
        <!--untuk memasukkan data -->
        <div class="card">

            <div class="card-header">
                Create / Edit data
            </div>
            <div class="card-body">
                <?php 
                    if($error){
                        ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                    </div>
                <?php
                        header("refresh:5;url=crud.php");//5 : detik
                    }
                    ?>

                <?php 
                    if($success){
                        ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success ?>
                </div>
                <?php
                        header("refresh:5;url=crud.php");//5 : detik
                    }
                    ?>

                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">


                        </div>

                        <div class="mb-3 row">
                            <label for="umur" class="col-sm-2 col-form-label">Umur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="umur" name="umur"
                                    value="<?php echo $umur ?>">


                            </div>

                            <div class="mb-3 row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="<?php echo $alamat ?>">


                                </div>

                                <div class="mb-3 row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="<?php echo $phone ?>">


                                    </div>


                                </div>

                                <div class="col-12">
                                    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />

                </form>

            </div>
        </div>
        <!-- 4 div ini untuk jadi marginnya idk why -->
    </div>
    </div>

    </div>
    </div>
    <!-- ampe sini -->

    <!-- untuk mengeluarkan data -->

    <div class="card">
        <div class="card-header text-white bg-secondary">
            Data PT CHIPICHAPA
        </div>
        <div class="card-body">

            <table class="table">

                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Aksi</th>

                    </tr>

                <tbody>
                    <?php
                    $sql2   = "select * from cruds order by id desc ";
                    $q2     = mysqli_query($connection,$sql2);
                    $urut   = 1;
                    while($r2 = mysqli_fetch_array($q2)){
                        $id     = $r2['id'];
                        $nama   = $r2['nama'];
                        $umur   = $r2['umur'];
                        $alamat = $r2['alamat'];
                        $phone  = $r2['phone'];



                        ?>
                    <tr>

                        <th scope="row"><?php echo $urut++ ?></th>
                        <td scope="row"><?php echo $nama ?></th>
                        <td scope="row"><?php echo $umur ?></th>
                        <td scope="row"><?php echo $alamat ?></th>
                        <td scope="row"><?php echo $phone ?></th>

                        <td scope="row">
                            <a href="crud.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href= "crud.php?op=delete&id=<?php echo $id ?>" onclick ="return confirm('Hapus Data?')"><button type="button" class="btn btn-danger">Delete</button></a>

                            


                        </td>
                    </tr>
                    <?php
                    }

                    ?>
                </tbody>

                </thead>
            </table>



        </div>
    </div>


    </div>
</body>

</html>