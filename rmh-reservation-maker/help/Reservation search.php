<?PHP
/*
 * Brian Harrison Charles Holenstein
 */
session_start();
session_cache_expire(30);
$title = 'Reservation Search Help';
include ('header.php');
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>How to add People to the Database</title>
    </head>
    <body>
        <div align ="Left"><p><strong>How to Add People to the Database</strong><BR>
                <p><B>Step 1:</B>Select <i>"New Referral"</i>from the left panel.<BR><BR>
                    
                <p><B>Step 2:</B>You will now see a long form with information like <i>"First Name</i>and<i>"Last Name"</i>
                   to be filled in.<BR><BR>
                
                <p><B>Step 3:</B>When you are finished, select the <b>Submit</b> button at the bottom of the page.<Br><BR>
                    
                <p><B>Step 4:</B>If an error occurs you will be directed to go back and make the necessary corrections.<BR><BR>
                    
                <p><B>Step 5:</B>If you have no errors, all entered information will be displayed for review.<BR><BR>
                    
                <p><B>Step 6:</B>When you have finished you can return to any other function by selecting it on the navigation bar.<BR><BR>    
    </body>
</html>
<?PHP include('footer.php'); ?>
