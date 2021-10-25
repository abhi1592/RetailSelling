<?php

//25-2-2021 ABHISHEK  CALLED FUNCTIONS FOR HTML AND LOGO
//27-2-2021 ABHISHEK  CALLED FUNCTION FOR ADVERTISEMENT AND IMAGES
//1-3-2021  ABHISHEK  ADDED NAVIGATION AND COPYRIGHT
//6-3-2021  ABHISHEK  ADDED TABLE
require_once 'functions/common.php';
set_error_handler("manageError");
set_exception_handler("manageException");
$class= CheckCommandPrint();
//echo $class;
CreatePageTop("Orders",$class);
createLogo();
CreateNavigationBar();
OpenCheatSheet();
DownloadCheatSheet();
CreateOrderTable();
DisplayCopyright();
CreatePageBottom();