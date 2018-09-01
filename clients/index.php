<?php
    
    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php");
    
    validate_session();

    $client_set = find_all_clients();

    if(check_session_time() == true){

	//creates title for page called subjects
    $page_title = "clients"; 
    
    //requires the inclusion of staff header on this page
    require(SHARED_PATH."/header.php"); 

	
?>
<style>
    .clients {
        color: #68fffb !important;
        font-weight: bold;
        border-bottom-style: solid;
        text-shadow: 0px 0px 0px transparent !important;
    }
    
    #mobile-navigation .clients {
        border-bottom-style: solid;
        border-top-style: solid;
        border-bottom-color: #68fffb;
        border-top-color: #68fffb;
    }
</style>
<div id="clients-content" class="content">
    <div class="main-content">
        <div class="main-title-wrapper">
            <h1>Clients</h1>
        </div>
        <div class="table-bttns-wrapper">
            <button id="delete-bttn" class="table-bttn">Delete <i class="fa fa-trash-o trash-icon"></i></button>
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
					<span class="column-title">Client</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell amerigroup-id-column sort-column" data-sort-asc="" data-column-number="3">
					<span class="column-title">Ameriset Number</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell medicaid-id-column sort-column" data-sort-asc="" data-column-number="4">
					<span class="column-title">Mediset ID</span>
					<span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell phone-number-column sort-column" data-sort-asc="" data-column-number="5">
					<span class="column-title">Phone Number</span>
                    <span class="sort-symbol"></span>
				</div>
				<div class="table-header-cell delete-column">
				</div>
            </div>
            <div class="table-part-2">
                
                    <?php
                
                        if(mysqli_num_rows($client_set) == 0){
                            
					       echo "<p class='no-results'>no clients found</p>";
                            
                        }else{
                            
				            while($client = mysqli_fetch_assoc($client_set)) { 	 
                    ?>
        
				 <?php
                                require(SHARED_PATH."/client-content/client-row.php");
                                
				            }
                            
                        }
                
                    /*frees space being used to hold the result of the query from mysql_query($db, $sql)*/
                    mysqli_free_result($client_set);
                        
                ?>
            </div>
            <?php } ?>
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
<script type="text/javascript" src="<?php echo url_for("/scripts/clients.js"); ?>" async></script>
<?php
    require_once(SHARED_PATH."/end-of-page.php");
?>