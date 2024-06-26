<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Function to determine if the current page is active
function isPageActive($page_name, $current_page) {
    return ($page_name === $current_page) ? 'active' : '';
}
?>

<nav class="topnav" id="myTopnav">
    <a href="profile.php" class="<?php echo isPageActive('profile.php', $current_page); ?>">Profile</a>
    <a href="my_kpi.php" class="<?php echo isPageActive('my_kpi.php', $current_page); ?>">KPI Indicator</a>
    <a href="my_activities.php" class="<?php echo isPageActive('my_activities.php', $current_page); ?>">List of Activities</a>
    <a href="my_challenge.php" class="<?php echo isPageActive('my_challenge.php', $current_page); ?>">Challenge and Future Plan</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</nav>