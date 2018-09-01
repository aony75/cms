<?php
    //if page title hasn't been set it will automatically be CMS
    if(!isset($page_title)){
        $page_title = "CMS";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="<?php echo url_for("/css/font-awesome-4.7.0/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" media="all" href="<?php echo url_for("/css/stylesheet.css"); ?>">
        <title>CMS-<?php echo ucwords(h($page_title)); ?></title>
        <meta http-equiv="Content-Type" charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
