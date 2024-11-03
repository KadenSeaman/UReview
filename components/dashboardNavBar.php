<?php
    $page_roles = Array('admin','owner','user');
    require_once '../phpViews/checksession.php';

    $user = $_SESSION['user'];
    $user_roles = $user->getRoles();
    $role = $user_roles[0];

echo <<< _END
<div class="dashboard-nav-bar">
    <p>role: $role</p>
    <a href="home.php">sign out</a>
</div>
_END;
?>