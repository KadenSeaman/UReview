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
                <div class="title">manage users</div>
                <form method="POST" onchange="updateSort()" id="sort-by-form">
                <label for="sort-by-form">sort by:</label>
                            <select name="sortby" id="sortby">
                                <?php
                                    $values = ['username','name','email','role'];

                                    $sortBy = $values[0];

                                    if(isset($_POST['sortby'])){
                                        $sortBy = $_POST['sortby'];
                                    }

                                    foreach($values as $value){
                                        if($value == $sortBy){
                                            echo "<option selected value=$value>$value</option>";
                                        }
                                        else{
                                            echo "<option value=$value>$value</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </form>

                <div class="dashboard-list-container">
                    <ul>
                        <li class="restaurant-list-item header-list-item">
                            <p>username:</p>
                            <p>name:</p>
                            <p>email:</p>
                            <p>role:</p>
                            <a href="" id="userFiller"></a>
                            <a href="addUser.php" id="new-restaurant-btn">+ new user</a>
                        </li>
                        <?php
                            $page_roles = array('admin, user, owner');
                            require_once '../../security/checksession.php';
                            require_once '../../db.php';
                            require_once '../../security/sanitize.php';

                            $sortBy = "username";

                            if(isset($_POST['sortby'])){
                                $sortBy = $_POST['sortby'];
                            }
                            

                            $conn = new mysqli($hn,$un,$pw,$db);
                            if($conn->connect_error) die($conn->connect_error);

                            $query = "SELECT * FROM user ORDER BY $sortBy";

                            $result = $conn->query($query);
                            if(!$result) die($conn->error);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                                    echo <<< _END
                                            <li class="restaurant-list-item header-list-item">
                                                <p>$row[username]</p>
                                                <p>$row[name]</p>
                                                <p>$row[email]</p>
                                                <p>$row[role]</p>
                                                <a href="updateUser.php?user_id=$row[user_id]">edit</a>
                                                <form action='deleteUser.php' method='post'>
                                                    <input type='hidden' name='delete' value='yes'>
                                                    <input type='hidden' name='user_id' value='$row[user_id]'>
                                                    <input class="delete-btn" type='submit' value='- delete'>
                                                </form>
                                            </li>
                                    _END;
                                }
                            }
                            else{
                                echo "No data found <br>";
                            }

                            $result->close();
                            $conn->close();
                        ?>
                    </ul>
                </div>
            </div>
    </div>
</body>
<script>
    const updateSort = () => {
        document.getElementById("sort-by-form").submit();
    }
</script>
</html>