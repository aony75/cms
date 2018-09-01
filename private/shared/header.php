<?php
    //requires head.php for page to function
    require_once("head.php"); 
    
    $payroll_calandar = url_for("/payroll/payroll-calandar.php");
    $clients = url_for("/clients");
    $home = url_for("/home");
    $staff = url_for("/staff");
    $schedules = url_for("/schedules");
    $staff_payroll = url_for("/payroll/staff-payroll.php");
    $logout = url_for("logout.php");
?>
    <body>
        <?php 
        
            require_once("modal-guide.php"); 
        
        ?>
        <div id="main-modal-content" class="modal-content container">
            <div id="main-modal" data-show-edit-wrapper="false" data-person-link-clicked="false" data-last-href="" data-person-description="" class="modal">
            </div>
        </div>
		<div id="filter-wrapper" class="modal-content">
			<div id="filter" class="modal">
			</div>
		</div>
        <div id="current-filters-wrapper" class="modal-content">
			<div id="current-filters" class="modal">
                <form class="display-none">
                </form>
                <div id="current-filters-body">
                </div>
			</div>
		</div>
        <div id="main-container" class="container">
            <div id="navigation">
                <div id="home-bttn-wrapper">
                    <a id="home-bttn">CMS</a>
                </div>
                <a id="mobile-icon" href="">&#9776;</a>
                <ul>
                    <li id="user-menu" class="dropdown">
                        <a href="#">
                            Hi, <?php echo $_SESSION["username"]; ?> <i class="fa fa-user-circle-o"></i>
                        </a>
                        <div id="user-menu-dropdown" class="dropdown-content">
                            <a class="logout-bttn" href="<?php echo $logout; ?>">Logout</a>
                        </div>
                    </li>
                    <li><a class="schedules" href="<?php echo $schedules; ?>">Schedules <i class="fa fa-calendar"></i></a></li>
                    <li id="payroll-menu" class="dropdown">
                        <a class="payroll-calandar" href="<?php echo $payroll_calandar; ?>">Payroll Calander <i class="fa fa-money"></i></a>
                    </li>
                    <li><a class="staff" href="<?php echo $staff; ?>">Staff <i class="fa fa-user-md"></i></a></li>
                    <li><a class="clients" href="<?php echo $clients; ?>">Clients <i class="fa fa-user"></i></a></li>
                </ul>
            </div>
            <div class="mobile-navigation-modal-container container">
                <div id="mobile-navigation">
                    <a href="#" id="close-icon">&#10006;</a>
                    <a class="clients" href="<?php echo $clients; ?>">Clients</a>
                    <a class="staff" href="<?php echo $staff; ?>">Staff</a> 
                    <a class="payroll-calandar" href="<?php echo $payroll_calandar; ?>">Payroll Calander</a>
                    <a class="schedules" href="<?php echo $schedules; ?>">Schedules</a>
                    <a class="logout-bttn" href="<?php echo $logout; ?>">Logout</a>
                </div>
            </div>
       