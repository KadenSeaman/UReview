<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=2, initial-scale=1.0">
    <title>U Review</title>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="icon" href="../../assets/favicon.ico?" type="image/x-icon">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-left-container">
            <h1 class="dashboard-nav-title">U Review</h1>
            <?php
                require_once "../../components/dashboardleftContainer.php";
            ?>
        </div>
        <div class="dashboard-right-container">
            <?php
                require_once "../../components/dashboardNavBar.php";
            ?>
            <div class="dashboard-main">
                <div class="title">revenue report</div>
                <div class="dashboard-list-container">
                    <?php
                        $page_roles = array('admin');
                        require_once '../../security/checksession.php';
                        require_once '../../db.php';

                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);

                        $query = "SELECT SUM(amount) as sum FROM subscription";
                        $result = $conn->query($query);
                        if(!$result) die($conn->error);

                        $totalRevenue = "Error";

                        if($result->num_rows > 0){
                            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                $totalRevenue = $row['sum'];
                            }
                        }   

                        echo "<h1 class='title'>total revenues: \$$totalRevenue</h1>"
                    ?>
                </div>
            </div>
    </div>
</body>
</html>