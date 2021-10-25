<!-- 

18-2-2021 ABHISHEK  CREATED CONSTANTS FOR FILES AND IMAGES
21-2-2021 ABHISHEK  CREATED FUNCTION FOR HTML START AND END. AND THE TAX CALCULATOR
26-2-2021 ABHISHEK  CREATED FORM ,ADVERTISEMENT FUNCTION,TESTING BY CALLING
27-2-2021 ABHISHEK  CREATED MORE FUNCTIONS FOR DISPLAYING IMAGES AND CONTENT
28-2-2021 ABHISHEK  WORKED ON SAVING FORM DATA TO ARRAY,DEBUGGING
5-3-2021  ABHISHEK  CREATED FUNCTION FOR TABLES AND SAVING DATA TO FILE
5-3-2021  ABHISHEK  STARTED ADDING CSS
8-3-2021  ABHISHEK  WORKED ON GETTING COMMAND FOR ORDERS PAGE
9-3-2021  ABHISHEK  ADDED ERROR HANDLING AND EXCEPTION HANDLING

-->
<?php

define("DEFAULT_TAX_RATE", 0.1225);//constant for tax
//constants for folders
define("FOLDER_IMAGES", "images/");
define("FOLDER_CSS", "CSS/");
define("FOLDER_ORDER", "orders/");
define("FOLDER_ERRORS", "Errors/");
//constants for pages
define("FILE_HOME", "home.php");
define("FILE_BUYING", "buying.php");
define("FILE_ORDERS", "orders.php");
define("FILE_TEST", "test.php");
define("FILE_ERRORS", "errors.php");
//constants for files
define("FILE_CSS", FOLDER_CSS."main.css");
define("FILE_ORDER_LOG", FOLDER_ORDER."log.txt");
define("FILE_CHEAT_SHEET", FOLDER_ORDER."CheatSheat.txt");
//constants for images
define("FILE_LOGO", FOLDER_IMAGES."grand.jpeg");//logo
define("FILE_AD1", FOLDER_IMAGES."1.jpg");//for ads
define("FILE_AD2", FOLDER_IMAGES."2.jpg");
define("FILE_AD3", FOLDER_IMAGES."3.jpg");//will be tested as special ad
define("FILE_AD4", FOLDER_IMAGES."4.jpg");
define("FILE_AD5", FOLDER_IMAGES."5.jpg");
define("FILE_P1", FOLDER_IMAGES."B1.jpg");
define("FILE_P2", FOLDER_IMAGES."B2.jpg");
define("FILE_P3", FOLDER_IMAGES."B3.jpg");
define("FILE_P4", FOLDER_IMAGES."B4.jpg");

//website link for random ads
define("ADVERTISEMENT_WEBSITE", 'https://www.google.ca/');

#Validation Constants
define("MAX_LEN_PROD_CODE", 12);
define("MAX_LEN_FIRST_NAME", 20);
define("MAX_LEN_LAST_NAME", 20);
define("MAX_LEN_CITY", 8);
define("MAX_LEN_COMMENT", 200);
define("MAX_PRICE", 10000);
define("MAX_QUANTITY", 99);

#CSS CLASS CONSTANTS
define("DEFAULT_BACKGROUND_CLASS", 'body');///////////////////////////////

function CheckCommandPrint()//for orders page
{
    $class="";
    if(isset($_GET["command"]))//check if user gives command input in URL 
    {
        $input= htmlspecialchars($_GET["command"]);//preventiong injections
        if($input=='print')
        {
            $class='bodyPrint';//css with no background
        }
         else{
            
            $class='body'; //normal with picture background
        }
    }
    else{           
            $class='body'; //normal with picture background
        }
    return $class;
        
}

function CreatePageTop($title,$class=DEFAULT_BACKGROUND_CLASS)//function for beginig html code for pages
{
    if(!isset($_SERVER["HTTPS"])||$_SERVER["HTTPS"]!="on")
    {
        header('Location:https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]);
            exit();
    }
    //to prevent page caching
    header("Content-Type: text/html; charset=UTF-8");
    header('Expires: Fri, 15 Sep 2000 16:00:00 GMT');
    header('Cache-Control: no-cache');
    header('Pragma: no-cache');
   
    ?>
    <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8"/>
            <title><?php echo $title ?></title>       
         <link rel="stylesheet" href='<?php echo FILE_CSS ;?>'>
        </head>
        <body class=<?PHP echo $class; ?>>  
    <?php

}

function CreatePageBottom()//closing html tags
{
    ?>
        </body>
        </html>  
    <?php  
}

function CreateNavigationBar() //navigation bar
{
    ?><div class="topnav">
<!--        link for webpages-->
        <a href="<?php echo FILE_HOME; ?>">Home</a>
        <a href="<?php echo FILE_BUYING; ?>">Buying</a>
        <a href="<?php echo FILE_ORDERS; ?>">Orders</a>
        
    </div> 
    <?php
    
}

function DisplayCopyright()
{
    ?>
<!--        getting current year-->
        <?php $currentYear= date("Y");?> 
         <div class="copyright">
            <p>Copyright Abhishek Abhishek (1933848) <?php echo $currentYear ?></p> 
            <a href="https://www.facebook.com/grandepoch/"> <img src="images/fb.png" /></a> 
            <a href="https://www.instagram.com/epochgrand/?igshid=1w83tst1f9852"><img src="images/insta.png" /></a>
        </div>
    <?php
}
function CalculateSubtotal($quantity, $price) //gives the subtotal without tax
{
        return ($quantity*$price);       
}
function CalculateTaxAmount($subtotal,$taxRate=DEFAULT_TAX_RATE) //calculates the tax amount on subtotal
{
    return round($subtotal*$taxRate,2);
}
function CalculateTotal($subtotal, $taxAmount)
{
       
       return round($subtotal+$taxAmount,2); //grand total
}

function ValidatePcode($pCode)
{
   #Validating product code          
    $ErrorpCode="";
    if($pCode=="")#cannot be empty
    {
        $ErrorpCode="Please enter a Product Code";      
    }
    else #if not empty
    {
        $first_letter= strtoupper(substr($pCode,0,1));
        if($first_letter!="P") #check first letter
        {
            $ErrorpCode="First letter must be p or P";
        }
        if(mb_strlen($pCode)>MAX_LEN_PROD_CODE) #veryfying the legth
        {
            $ErrorpCode="Must be less than " .MAX_LEN_PROD_CODE. " characters";
        }  
    }   
        
    return $ErrorpCode;
}

function ValidateFname($firstName)
{   $ErrorfirstName="";
        #Validating first name
        if($firstName=="")#cannot be empty
        {
           $ErrorfirstName="Please enter a first name";
        }
        else #if not empty
        {
            if(mb_strlen($firstName)>MAX_LEN_FIRST_NAME) #veryfying the legth
            {
                $ErrorfirstName="Must be less than ".MAX_LEN_FIRST_NAME." characters";
            }  
        }
    
    return $ErrorfirstName;
}

function ValidateLname($lastName)
{
    #Validating last name
    $ErrorlastName="";
    if($lastName=="")#cannot be empty
        {
           $ErrorlastName="Please enter a last name";
        }
        else #if not empty
        {
            if(mb_strlen($lastName)>MAX_LEN_LAST_NAME) #veryfying the legnth
            {
                $ErrorlastName="Must be less than ".MAX_LEN_LAST_NAME. " characters";
            }  
        }
    return $ErrorlastName;
}

function ValidateCity($city)
{
    #Validating city name
    $Errorcity="";
    if($city=="")#cannot be empty
    {
        $Errorcity="Please enter a city";
    }
    else #if not empty
    {
        if(mb_strlen($city)>MAX_LEN_CITY) #veryfying the legnth
        {
            $Errorcity="Must be less than " .MAX_LEN_CITY. " characters";
        }  
    }         
    return $Errorcity;
}

function ValidateComments($comment)
{
    #Validating comments
    $Errorcomment="";
    if(mb_strlen($comment)>MAX_LEN_COMMENT) #veryfying the legnth
    {
        $Errorcomment="Must be less than " .MAX_LEN_COMMENT. " characters";
    }     
    return $Errorcomment;
}

function ValidatePrice($price)
{
    #validating price
    $Errorprice="";
    if ($price=="")#cannot be empty
    {
        $Errorprice="Please enter a price";
    }           
    else if(is_numeric($price))
    {
        if($price>MAX_PRICE||$price<=0)//checking if price is less than 10000
        {
            $Errorprice="Price cannto be more than ".MAX_PRICE." ,0 or negative";
        }
    }
    else
    {
        $Errorprice="Enter a numeric value";
    }
    return $Errorprice;
}

function ValidateQuantity($quantity)
{
    $Errorquantity="";
            
    if ($quantity=="")#cannot be empty
        {
            $Errorquantity="Please enter a quantity";
        }           
        else if(!(is_numeric($quantity)))//must be a numeric entry
        {
            $Errorquantity= "Enter a numeric value";             
        }
        else if((int)$quantity!= floatval ($quantity)) //if this is false that means there is a decimal used
        {
                $Errorquantity="Quantity cannot contain decimal";
        }
        elseif($quantity>MAX_QUANTITY||$quantity<=0)//checking if price is less than 10000
        {
            $Errorquantity="Quantity cannto be more than ".MAX_QUANTITY." ,0 or negative";
        }  
        return $Errorquantity;
}

function CreateForm()//function to display form, get and validate data and save it in file
{
        //initializing variables
        $pCode="";
        $firstName="";
        $lastName="";
        $city="";
        $comment="";
        $price=0;
        $quantity=0;
        $subtotal=0;
        $taxes=0;
        $total=0;
        //Variables for error messages
        $ErrorpCode="";
        $ErrorfirstName="";
        $ErrorlastName="";
        $Errorcity="";
        $Errorcomment="";
        $Errorprice="";
        $Errorquantity="";
         
        $message_save="";
        if(isset($_POST['save']))//checking if svae has been clicked
        {//protecting against injections
            $pCode= htmlspecialchars(trim($_POST['code']));// trim is used to prevent unnecessary space in end or begiining
            $firstName=htmlspecialchars(trim($_POST['fname']));
            $lastName=htmlspecialchars(trim($_POST['lname']));
            $city=htmlspecialchars(trim($_POST['city']));
            $comment=htmlspecialchars(trim($_POST['comment']));
            $price=htmlspecialchars(trim($_POST['price']));
            $quantity=htmlspecialchars(trim($_POST['quantity']));                       
            
            $ErrorpCode=ValidatePcode($pCode);
            $ErrorfirstName= ValidateFname($firstName);
            $ErrorlastName= ValidateLname($lastName);
            $Errorcity= ValidateCity($city);
            $Errorcomment= ValidateComments($comment);
            $Errorprice= ValidatePrice($price);
            $Errorquantity= ValidateQuantity($quantity);        
            #no errrors
//            var_dump($ErrorpCode);          
//            var_dump($ErrorfirstName);
//            var_dump($ErrorlastName);
//            var_dump($Errorcity);      
//            var_dump($Errorcomment);
//            var_dump($Errorprice);
//            var_dump($Errorquantity);
            if($ErrorpCode=="" && $ErrorfirstName=="" && $ErrorlastName=="" && $Errorcity=="" && $Errorcomment=="" && $Errorprice=="" && $Errorquantity=="")
            {
               
              //var_dump($Errorcomment);
                $subtotal= CalculateSubtotal($quantity, $price);
                $taxes= CalculateTaxAmount($subtotal);
                $total= CalculateTotal($subtotal,$taxes);//getting grand total
                $arr_orders=array //creating an array with the variables stored with valid form data
               (
                   "pCode"=>$pCode,
                   "firstName"=>$firstName,
                   "lastName"=>$lastName,
                   "city"=>$city,
                   "comment"=>$comment,
                   "price"=>$price,
                   "quantity"=>$quantity,
                   "subtotal"=>$subtotal,
                   "taxes"=>$taxes,
                   "grandTotal"=>$total
                );
                
                //var_dump($arr_orders);
                $json_orders= json_encode($arr_orders)    ; //converting arry to json
                if(file_exists(FILE_ORDER_LOG))
                {
                    $openFile = fopen(FILE_ORDER_LOG, 'a') or die("Cannot open order logs.");
                    file_put_contents(FILE_ORDER_LOG, $json_orders."\n",FILE_APPEND); //adding new orders               
                    fclose($openFile);
                }
                //emptying all variables
                $pCode="";
                $firstName="";
                $lastName="";
                $city="";
                $comment="";
                $price=0;
                $quantity=0;
                $subtotal=0;
                $taxes=0;
                $total=0;   
            }
       }
       else
       {
           $message="No data";
       }  
       ?>
        <!-- creating form to get purchase data --->
        <div class='form'>
            <h1 class="golden">Place your Order</h1>
            <form action="<?php echo FILE_BUYING; ?>" method="POST">

            <label class="label">Product Code:</label><br />
            <input class="input" type="text" name="code" value="<?php echo $pCode; ?> " placeholder="Must start with 'P'"  />
            <span class="red"> <?php echo $ErrorpCode; ?> </span><br />
            
            <label class="label">First name:</label><br />
            <input class="input" type="text" name="fname" value=" <?php echo $firstName; ?>" placeholder="1-20 Characters*"   />
            <span class="red"> <?php echo $ErrorfirstName; ?> </span><br />
            
            <label class="label">Last Name:</label><br />
            <input class="input" type="text" name="lname" value="<?php echo $lastName; ?>" placeholder="1-20 Characters*"  />
            <span class="red"> <?php echo $ErrorlastName; ?> </span><br />
            
            <label class="label">City:</label><br />
            <input class="input" type="text" name="city" value="<?php echo $city; ?>" placeholder="1-8 Characters*"  />
            <span class="red"> <?php echo $Errorcity; ?> </span><br />
            
            <label class="label">Comments:</label><br />
            <textarea class="input" name="comment" value="<?php echo $comment;  ?>" placeholder="0-200 Characters*"></textarea>
            <span class="red"> <?php echo $Errorcomment; ?> </span><br />
            
            <label class="label">Price:</label><br />
            <input class="input" type="text" name="price" value="<?php echo $price;  ?>" placeholder="In CAD$ *"/>
            <span class="red"> <?php echo $Errorprice; ?> </span><br />
            
            <label class="label">Quantity:</label><br />
            <input class="input" type="text" name="quantity" value="<?php echo $quantity;  ?>" placeholder="1-99*"/>
            <span class="red"> <?php echo $Errorquantity; ?> </span><br />
            
            <input name="save" type="submit" value="Save"class="save" />
            </form>
        </div>
        <?php
}

function CreateOrderTable()
{
   // $arr_orders=ReadOrders();
    $arr_orders=array();
    $css='';
    ?>
        <table><!-- table headings --->
            <tr>
                <th>Product ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Comments</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Taxes</th>
                <th>Grand Total</th>
            </tr>
            
                 
                <?PHP  
                if(file_exists(FILE_ORDER_LOG))//Checking existence to preventt code crashing
                {
                    $openFile = fopen(FILE_ORDER_LOG, 'r') or die("Cannot open order logs.");//reading the file

                    while(!feof($openFile))//until the end is reached
                    {
                        $json_orders= fgets($openFile);//get lines of file

                        $arr_orders= json_decode($json_orders,true);//decode them and convert into array
                           if($arr_orders!=NULL)//no arrray should be empty
                           {
                             //var_dump($arr_orders)."\n";
                                ?>
                                <tr><!-- New row --> 
                                    <td><?php echo $arr_orders["pCode"]?> </td><!--- getting elements of decoded array by keys-->
                                    <td><?php echo $arr_orders["firstName"]?> </td>
                                    <td><?php echo $arr_orders["lastName"]?> </td>
                                    <td><?php echo $arr_orders["city"]?> </td>   
                                    <td class='bigTD'><?php echo $arr_orders["comment"]?> </td>
                                    <td ><?php echo $arr_orders["price"]." $"?> </td>
                                    <td><?php echo $arr_orders["quantity"]?> </td>    
                                    <?php 
                                        $css="";
                                        if(isset($_GET["command"]))//if command is given  in URL
                                        {
                                            $input= htmlspecialchars($_GET["command"]);//preventing injections
                                            if($input=='color')//if its a color command
                                            {   
                                                //check the subtotal category and select css
                                                $subtotal=$arr_orders["subtotal"];
                                                if($subtotal<=100){$css='red';}
                                                else if($subtotal>100&&$subtotal<1000){$css='orange';}
                                                else if($subtotal>1000){$css='green';}
                                            }
                                            else
                                            {
                                                    $css='';//normal
                                            }
                                        }
                                       else
                                       {
                                            $css='';//normal
                                       }
                                ?>
                                    <td class='<?php echo $css; ?>'><?php echo $arr_orders["subtotal"]." $"?> </td>
                                    <td><?php echo $arr_orders["taxes"]." $"?> </td>
                                    <td><?php echo $arr_orders["grandTotal"]." $"?> </td>
                                </tr>

                         <?php
                        }
                    }
                }
                ?>
        </table> 
    <?php  
    fclose($openFile);
}

function DisplayAdvertisement()
{
    $ads=array(FILE_AD1,FILE_AD2,FILE_AD3,FILE_AD4,FILE_AD5);
    shuffle($ads);//shuffling the array to get random ads
    ?>      
    <div class="adbox">
    <h2>Book your show at grand epoch events!!!</h2>
    <h4>(This is an <strong> Advertisement</strong>)</h4>
    <?php 
    $temp=$ads[0];
    $cls="";
    if($temp==FILE_AD3)// to display one picture bigger than others with red border
    {
        $cls='specialAd';// different css than others
    }
    else // other pictures
    {
        $cls='ad';
    }
    echo "<a href='". ADVERTISEMENT_WEBSITE."'><img class=$cls src='".$temp."'></a>"; ?><!---directing to google if image is clicked-->
    </div>
    <?php
}

function DisplayWelcome()//displaying introduction of website
{?>
        <div class="main">
        <h1>Welcome to <strong>The Grand Epoch</strong></h1>
        <h3 >We bring your brands together</h3>
        <h3 >For Men and Women </h3>
        <?php displayimages(); ?>
        </div>
        <?php
}

function displayimages()//general images related to products
{
    echo "<div class='icon'><img src='".FILE_P1 ."'></div>";
    echo "<div class='icon'><img src='".FILE_P2 ."'></div>";
    echo "<div class='icon'><img src='".FILE_P3 ."'></div>";
    echo "<div class='icon'><img src='".FILE_P4 ."'></div>";
}

function OpenCheatSheet()// function to open cheet sheat
{
    echo "<div class='cheat'><a href='". FILE_CHEAT_SHEET."' >OPEN CHEAT SHEET</a></div>";
}

function DownloadCheatSheet()// function to download cheet sheat
{
    echo "<div class='cheat'><a href='". FILE_CHEAT_SHEET."' download>DOWNLOAD CHEAT SHEET</a></div>";
}

function createLogo()// function to display logo picture
{
    echo "<a href='". FILE_HOME."'><div class='grand'><img src='".FILE_LOGO ."'></div></a>";
}
 
//Error handling
$debug=false;// so that clients don't see the details of our errors
function manageError($errorNumber, $errorMessage,$errorFile,$errorLine)
{
    global $debug;
    echo "An error occured";
    $error="An error number: ".$errorNumber." : ".$errorMessage ."occured in".$errorFile."at line.$errorLine"." at ".date("h:i:sa")." on ".date("Y-m-d");
    if($debug==false)
    {
        echo $error;
    }
    else//write into log
    {
        if(file_exists(FILE_ERRORS))//checking file existence
                {
                $openFile = fopen(FILE_ERRORS, 'a') or die("Cannot open ERRORS.");
                file_put_contents(FILE_ERRORS, $error."\n",FILE_APPEND); //adding new errors         
                fclose($openFile);
                }
    }
    die();
}
function manageException($errorObject)//exception handling
{
    global $debug;// so that clients don't see the details of our errors
    echo "An error occured";
    $exc="An error ".$errorObject->getMessage()." occured in ".$errorObject->getFile(). " at line ".$errorObject->GetLine()." at ".date("h:i:sa")." on ".date("Y-m-d");
    if($debug==false)
    {
        echo $exc;
    }
    else
    { //put into a file
         if(file_exists(FILE_ERRORS))
            {
            $openFile = fopen(FILE_ERRORS, 'a') or die("Cannot open ERRORS.");
            file_put_contents(FILE_ERRORS, $exc."\n",FILE_APPEND); //adding new errors           
            fclose($openFile);
            }
    }
    die();
}