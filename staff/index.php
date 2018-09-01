<?php 

    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 

    validate_session();

    //creates title for page called subjects
    $page_title = "staff"; 
    
    //requires the inclusion of staff header on this page
    require(SHARED_PATH."/header.php"); 

?>
<style>
    .staff {
        color: #68fffb !important;
        font-weight: bold;
        border-bottom-style: solid;
        text-shadow: 0px 0px 0px transparent !important;
    }
    
    #mobile-navigation .staff {
        border-bottom-style: solid;
        border-top-style: solid;
        border-bottom-color: #68fffb;
        border-top-color: #68fffb;
    }
</style>
<div id="staff-content" class="content">
    <div class="main-content">
        <div class="main-title-wrapper">
            <h1>Staff</h1>
        </div>
        <div class="table-bttns-wrapper">
            <button id="delete-bttn" class="table-bttn">Delete <i class="fa fa-trash-o trash-icon"></i></button>
            <button class="table-bttn mail-bttn">Generate Mailing list <i class="fa fa-envelope-o"></i></button>
            <button class="table-bttn add-new-bttn">Add New <i class="fa fa-plus"></i></button>
            <a href="#" class="table-bttn filter-bttn">Add Filter <i class="fa fa-plus"></i></a>
            <a href="#" class="table-bttn show-current-filters-bttn display-none show-current-filters-bttn-animation">Show Current Filters <i class="fa fa-eye"></i></a>
            <input class="search" maxlength="100" type="text" name="search" placeholder="Search">
        </div>
        <div class="table-wrapper">
            <div class="table-part-1">
                <div class="table-header-cell checkbox-column">
					<div class="checkbox-wrapper">
						<input type="hidden" name="select-all" value="0">
                    	<input type="checkbox" name="select-all" value="1">
					</div>
				</div>
				<div class="table-header-cell evv-id-column sort-column" data-sort-asc="" data-column-number="1">
					<span class="column-title">ID</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell name-column sort-column" data-sort-asc="" data-column-number="2">
					<span class="column-title">Staff</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell phone-number-column sort-column" data-sort-asc="" data-column-number="3">
					<span class="column-title">Phone Number</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell mail-column sort-column" data-sort-asc="" data-column-number="4">
					<span class="column-title">Mail</span>
					<span class="sort-symbol"></span>
				</div>
                <div class="table-header-cell pay-rate-column sort-column" data-sort-asc="" data-column-number="5">
					<span class="column-title">Pay Rate</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell delete-column">
				</div>
            </div>
            <div class="table-part-2">
                <?php 

                    $staff_set = find_all_staff();
                
                    if(mysqli_num_rows($staff_set) == 0){
                            
					       echo "<p class='no-results'>no staff found</p>";
                            
                    }else{
                
                        while($staff = mysqli_fetch_assoc($staff_set)) { 	
              
                            require(SHARED_PATH."/staff-content/staff-row.php"); 
                        
                        }
                    
                    }
                
                    /*frees space being used to hold the result of the query from mysql_query($db, $sql)*/
                    mysqli_free_result($staff_set);
                
                ?>
            </div>
        </div>
    </div>
</div>
<?php 
    //requires inclusion of staff footer located in shared folder
    require_once(SHARED_PATH."/footer.php"); 
?>
<script type="text/javascript" src="<?php echo url_for("/scripts/jquery-3.3.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/script-functions.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/onready.js"); ?>" async></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/staff.js"); ?>" async></script>
<?php
    require_once(SHARED_PATH."/end-of-page.php");
?>