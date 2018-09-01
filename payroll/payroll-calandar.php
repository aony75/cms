<?php 

    session_start();

    //constant variable can't be set here like footer and header becasue initalize.php are where the constants were defined
    require_once("../private/initialize.php"); 
    
    validate_session();

    //creates title for page called subjects
    $page_title = "payroll calandar"; 
    
    //requires the inclusion of staff header on this page
    require_once(SHARED_PATH."/header.php"); 
?>
<style>
    .payroll-calandar {
        color: #68fffb !important;
        font-weight: bold;
        border-bottom-style: solid;
        text-shadow: 0px 0px 0px transparent !important;
    }
    
    #mobile-navigation .payroll-calandar {
        border-bottom-style: solid;
        border-top-style: solid;
        border-bottom-color: #68fffb;
        border-top-color: #68fffb;
    }
</style>
<div id="calandar-content" class="content">
    <div class="main-content">
        <div id="year-content">
            <!--disabled previous button <a href="" id="previous-year">&#10096;</a>-->
            <p>CMS Payroll Calandar</p>
            <div id="year">
            </div>
            <!--disabled next button <a href="" id="next-year">&#10097;</a>-->
            <p class="printer-icon"> Print <i class="fa fa-print"></i></p>
        </div>
        <div id="calandars">
            <div id="color-code">
                <span>
                    <p>Start of Pay Period</p>
                    <input disabled>
                </span>
                <span>
                    <p>End of Pay Period</p>
                    <input disabled>
                </span>
                <span>
                    <p>Pay Day</p>
                    <input disabled>
                </span>
            </div>
        <?php
            $caption_month = "janurary";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "feburary";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "march";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "april";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "may";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "june";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "july";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "august";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "september";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "october";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "november";
            require(SHARED_PATH."/calandar.php");

            $caption_month = "december";
            require(SHARED_PATH."/calandar.php");
        ?>
        </div>
        <div id="calandar-legend">
            <table id="calandar-legend-table">
                <caption>Pay Days</caption>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php 
    //requires inclusion of staff footer located in shared folder
    require_once(SHARED_PATH."/footer.php"); 
?>
<script type="text/javascript" src="<?php echo url_for("/scripts/jquery-3.3.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/script-functions.js"); ?>"></script>
<script type="text/javascript" src="<?php echo url_for("/scripts/payroll-calandar.js"); ?>" async></script>
<?php
    require_once(SHARED_PATH."/end-of-page.php");
?>