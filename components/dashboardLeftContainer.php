
<?php
    $page_roles = Array('admin','owner','user');
    require_once __DIR__.'/../security/checksession.php';

    $user = $_SESSION['user'];
    $user_roles = $user->getRoles();
    $role = $user_roles[0];

    if ($role == 'admin'){
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="Does not exist.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="Does not exist.php" class="dashboard-nav-link">pay subscription fees</a>
                    <a href="../accountManagement/accountManagement.php" class="dashboard-nav-link">account management</a>
                    <a href="../restaurantManagement/viewRestaurant.php" class="dashboard-nav-link">manage restaurants</a>
                    <a href="../userManagement/viewUser.php" class="dashboard-nav-link">manage users</a>
                    <a href="../revenueReport/revenueReport.php" class="dashboard-nav-link">revenue report</a>
            </div>
        _END;
    }
    else if($role == 'owner'){
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="Does not exist.php.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="Does not exist.php.php" class="dashboard-nav-link">pay subscription fees</a>
                    <a href="../accountManagement/accountManagement.php" class="dashboard-nav-link">account management</a>
                    <a href="../restaurantManagemnet/viewRestaurant.php" class="dashboard-nav-link">manage restaurants</a>
                    <a href="../foodItemManagement/viewFoodItem.php" class="dashboard-nav-link">manage food items</a>
                    <a href="../reviewManagement/viewReview.php" class="dashboard-nav-link">manage reviews</a>
            </div>
        _END;
    }
    else{
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="Does not exist.php.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="../accountManagement/accountManagement.php" class="dashboard-nav-link">account management</a>
            </div>
        _END;
    }
?>