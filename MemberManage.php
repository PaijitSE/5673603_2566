<!DOCTYPE html>
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();
?>

<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Management</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/adminStyle.css">
</head>

<body class="">
    <div class="adminHeader">
        <div class="main">
            <div class="title">
                Admin Zone
            </div>
            <p>Hi, <?php echo "ชินจัง"; ?><button><a href="index.php">Logout</a></b></button></p>
            <ul class="menubar">
                <li><b><a href="#">Product</b></li>
                <li><b><a href="EmployeeManage.php">Employee</a></b></li>
                <li><b><a href="MemberManage.php">Member</a></b></li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="adminZone">
            <div class="headTopic">
                Member Management
            </div>
            <div class="col zoneLeft">
                <div class="">
                    <label>Member</label>
                    <button class="button1"><a href="?st=A">New Data</a></button>
                    <br><input type="text" name="Tsearch"><button class="button3">ค้นหา</button><br>
                </div><br>
                <div class="">
                    <?php $Data = $db_handle->Textquery("SELECT *, CONCAT(TRIM(Cust_firstname),'  ',Cust_lastname) AS New_name FROM CUSTOMER INNER JOIN MEMBER_LEVEL ON (CUSTOMER.Cust_level=MEMBER_LEVEL.Lev_id);"); ?>
                    <table class="mainTable">
                        <tr>
                            <th>#id</th>
                            <th width="50%">Member name</th>
                            <th>Work</th>
                        </tr>
                        <?php foreach ($Data as $key => $value) { ?>
                            <tr>
                                <td><?php echo $Data[$key]["Product_id"]; ?></td>
                                <td><?php echo $Data[$key]["New_name"]; ?></td>
                                <td><button class="button2 bg-warning"><a href="?st=V&id=<?php echo $Data[$key]['Cust_id']; ?>">View</a></button>
                                    <button class="button2 bg-danger" onclick="return confirm('กรุณายืนยันการลบข้อมูล ?')"><a href="memberProcess.php?st=D&id=<?php echo $Data[$key]['Cust_id']; ?>">Delete</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col zoneRight">
                <?php
                $id = $Data[0]['Cust_id'];
                $st = 'V';
                if (isset($_GET['st'])) {
                    $st = $_GET['st'];
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                if (isset($_GET['st'])) {
                    if ($_GET['st'] == 'A') {
                        $id = '';
                    }
                }
                $DataMember = $db_handle->Textquery("SELECT * FROM CUSTOMER WHERE Cust_id = '$id'");
                ?>
                <form action="memberProcess.php?st=<?php echo $st; ?>" method="POST">
                    <div class=" detail">
                        <div class="row mb-2">
                            <div class="col-4 p-0"><b>Member id :</b></div>
                            <div class="col-4">
                                <input type="text" name="cid" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">User Name :</div>
                            <div class="col-4">
                                <input type="text" name="uname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_UN"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Password :</div>
                            <div class="col-4">
                                <input type="text" name="passwd" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_PW"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0"> Prename :</div>
                            <div class="col">
                                <input type="text" name="pname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_prename"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Member Name :</div>
                            <div class="col-4 pr-0"><input type="text" name="fname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_firstname"]; ?>"></div>
                            <div class="col-4 pl-0"><input type="text" name="lname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_lastname"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Member Level :</div>
                            <div class="col"><input type="text" name="mlevel" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_level"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Birthday :</div>
                            <div class="col"><input type="text" name="birth" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_birth"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Address :</div>
                            <div class="col"><textarea class="form-control p-0 pl-2" name="address" rows=3><?php echo $DataMember[0]["Cust_address"]; ?></textarea></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Telephone :</div>
                            <div class="col"><input type="text" name="tel" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_tel"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <img src="<?php echo $DataMember[0]["Cust_picture"]; ?>">
                                <p class="pl-4">รูปสมาชิก</p>

                            </div>
                            <div class="col-5 "><button type="submit">Insert / Update Data</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer">
        Copyright@2022 : Student Group 641226601, Software Engineering, LPRU
    </footer>
</body>

</html>