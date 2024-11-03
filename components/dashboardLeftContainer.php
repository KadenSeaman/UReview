
<?php
    $page_roles = Array('admin','owner','user');
    require_once '../phpViews/checksession.php';

    $user = $_SESSION['user'];
    $user_roles = $user->getRoles();
    $role = $user_roles[0];

    if ($role == 'admin'){
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="findRestaurants.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="paySubscriptionFees.php" class="dashboard-nav-link">pay subscription fees</a>
                    <a href="accountManagement.php" class="dashboard-nav-link">account management</a>
                    <a href="viewRestaurant.php" class="dashboard-nav-link">manage restaurants</a>
                    <a href="viewUser.php" class="dashboard-nav-link">manage users</a>
                    <a href="revenueReport.php" class="dashboard-nav-link">revenue report</a>
            </div>
        _END;
    }
    else if($role == 'owner'){
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="findRestaurants.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="paySubscriptionFees.php" class="dashboard-nav-link">pay subscription fees</a>
                    <a href="accountManagement.php" class="dashboard-nav-link">account management</a>
                    <a href="viewRestaurant.php" class="dashboard-nav-link">manage restaurants</a>
                    <a href="manageFoodItems.php" class="dashboard-nav-link">manage food items</a>
                    <a href="REVIEWS.php" class="dashboard-nav-link">manage reviews</a>
            </div>
        _END;
    }
    else{
        echo <<< _END
            <div class="dashboard-link-container">
                    <a href="findRestaurants.php" class="dashboard-nav-link">find restaurants</a>
                    <a href="accountManagement.php" class="dashboard-nav-link">account management</a>
            </div>
        _END;
    }
?>