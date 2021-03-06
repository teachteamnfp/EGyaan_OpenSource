<?php
include("../../../Resources/sessions.php");

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../manage_privilege/classes/Privilege.php");
require_once("../classes/Role.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);
?>

<html>
<head>
    <?php
    include "../../../Resources/Dashboard/header.php"
    ?>
	<title>View Privileges | EGyaan</title>
</head>
<body>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <br>
            <ol class="breadcrumb">
                <li><a href="../../login/functions/Dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="role.php">Manage Roles</a></li>
                <li class="active"><b>View Privileges</b></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">View Privileges</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                        $privilege=new Privilege($dbConnect->getInstance());

                                        $role_id=$_REQUEST['view'];
                                        $role=new Role($dbConnect->getInstance());

                                        $getRoleName=$role->getRole();
                                        if($getRoleName!=null)
                                        {
                                            while($row=$getRoleName->fetch_assoc())
                                            {
                                                $id=$row['id'];
                                                if($id==$role_id)
                                                {
                                                    $role_name=$row['name'];break;
                                                }
                                            }

                                            echo "<h4>Privilege List : $role_name</h5>";
                                        }

                                        $getPrivilegeRole=$privilege->getPrivilegeRole($role_id);

                                        if($getPrivilegeRole!=null)
                                        {
                                            while($row=$getPrivilegeRole->fetch_assoc())
                                            {
                                                $privilege_id=$row['privilege_id'];

                                            $getPrivilegeName=$privilege->getPrivilege(0,0);
                                            while($privilegeRow=$getPrivilegeName->fetch_assoc())
                                            {
                                                $id=$privilegeRow['id'];
                                                if($id==$privilege_id)
                                                {
                                                    $privilege_name=$privilegeRow['name'];
                                                    echo "<div class='col-md-12'>".$privilege_name."</div>";
                                                }
                                            }

                                            }
                                        }
                                        else
                                        {
                                            echo "<h5>No Privileges Assigned</h5>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
include "../../../Resources/Dashboard/footer.php";
?>
</body>
</html>