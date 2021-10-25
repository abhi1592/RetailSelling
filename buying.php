<?php
//25-2-2021 ABHISHEK  CALLED FUNCTIONS FOR HTML
//1-3-2021  ABHISHEK  ADDED LOGO, NAVIGATION AND COPYRIGHT
//5-3-2021  ABHISHEK  ADDED FORM
require_once 'functions/common.php';
set_error_handler("manageError");
set_exception_handler("manageException");
CreatePageTop("Buying");
createLogo();
CreateNavigationBar();
CreateForm();
//DisplayAdvertisement();
//OpenCheatSheet();
DisplayCopyright();
CreatePageBottom();