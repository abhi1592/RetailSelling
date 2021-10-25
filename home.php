<?php

//25-2-2021 ABHISHEK  CALLED FUNCTIONS FOR HTML AND LOGO
//27-2-2021 ABHISHEK  CALLED FUNCTION FOR ADVERTISEMENT AND IMAGES
//1-3-2021  ABHISHEK  ADDED NAVIGATION AND COPYRIGHT
//4-3-2021  ABHISHEK  COMPLETED THIS PAGE
require_once 'functions/common.php';

set_error_handler("manageError");
set_exception_handler("manageException");
CreatePageTop("Home");
createLogo();
CreateNavigationBar();
DisplayWelcome();
//displayimages();
DisplayAdvertisement();
OpenCheatSheet();
DisplayCopyright();
CreatePageBottom();


