<?php
// Ensure $section is set and sanitize input to prevent security issues
$section = isset($_GET['section']) ? trim($_GET['section']) : "";
?>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php echo $section ?> | SUMBO APP</title>
<meta name="description" content="SUMBO WEB APP">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="shortcut icon" type="image/x-icon" href="dash-assets/img/favicon.ico">

<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

<link rel="stylesheet" href="dash-assets/css/bootstrap.min.css">

<link rel="stylesheet" href="dash-assets/css/font-awesome.min.css">

<link rel="stylesheet" href="dash-assets/css/nalika-icon.css">

<link rel="stylesheet" href="dash-assets/css/owl.carousel.css">
<link rel="stylesheet" href="dash-assets/css/owl.theme.css">
<link rel="stylesheet" href="dash-assets/css/owl.transitions.css">

<link rel="stylesheet" href="dash-assets/css/animate.css">

<link rel="stylesheet" href="dash-assets/css/normalize.css">
<link rel="stylesheet" href="dash-assets/css/meanmenu.min.css">

<link rel="stylesheet" href="dash-assets/css/main.css">

<link rel="stylesheet" href="dash-assets/css/morrisjs/morris.css">

<link rel="stylesheet" href="dash-assets/css/scrollbar/jquery.mCustomScrollbar.min.css">

<link rel="stylesheet" href="dash-assets/css/metisMenu/metisMenu.min.css">
<link rel="stylesheet" href="dash-assets/css/metisMenu/metisMenu-vertical.css">

<link rel="stylesheet" href="dash-assets/css/calendar/fullcalendar.min.css">
<link rel="stylesheet" href="dash-assets/css/calendar/fullcalendar.print.min.css">

<link rel="stylesheet" href="dash-assets/css/style.css">

<link rel="stylesheet" href="dash-assets/css/responsive.css">
<script src="dash-assets/js/vendor/modernizr-2.8.3.min.js"></script>

<script src="dash-assets/js/vendor/jquery-1.12.4.min.js"></script>

<style>
    
/* Style the table */
table {
    border: 2px solid white;
    color: white;
    width: 100%;
}

/* Style table headers */
th {
    background: #222; /* Dark background for contrast */
    color: white;
    border: 2px solid white;
    padding: 10px;
    text-align: left;
}

/* Style table rows */
td {
    border: 2px solid white;
    padding: 10px;
}

/* Style table row on hover */
tr:hover {
    background: rgba(255, 255, 255, 0.1);
}

/* Make input text white */
input#search {
    color: white;
    background: transparent;
    border: 1px solid white;
    padding: 8px;
}

/* Placeholder text color */
input#search::placeholder {
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
}
</style>