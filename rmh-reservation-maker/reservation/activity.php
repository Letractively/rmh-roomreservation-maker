<?php
//start the session and set cache expiry
session_start();
session_cache_expire(30);

$title = "Activity"; //This should be the title for the page, included in the <title></title>

include('../header.php'); //including this will further include (globalFunctions.php and config.php)
include(ROOT_DIR.'/database/dbReservation.php');
include(ROOT_DIR.'/database/dbProfileActivity.php');

$request = array();
$errors = array();
if(isset($_GET['type']) && isset($_GET['request']))
{
    //type of activity and request id is set, do the following
    $requestType = sanitize($_GET['type']);
    $requestId = sanitize($_GET['request']);
    
    switch($requestType)
    {
        //depending on the request type, perform the following actions
        case 'reservation':
            //request about reservation, get the information about the reservation, display the information first
            $reservation = retrieve_RoomReservationActivity_byRequestId($requestId);
            $request = array(
                            'Request ID' => $reservation->get_roomReservationRequestID(),
                            'Family' => $reservation->get_familyProfileId(),
                            'Social Worker' => $reservation->get_swFirstName().' '.$reservation->get_swLastName(),
                            'Date Submitted' => $reservation->get_swDateStatusSubmitted(),
                            'Activity Type'=>$reservation->get_activityType(),
                            'Begin Date' => $reservation->get_beginDate(),
                            'End Date' => $reservation->get_endDate(),
                            'Diagnosis' => $reservation->get_patientDiagnosis(),
                            'Room Notes' => $reservation->get_roomnote()
                            );
            break;
        
        case 'profile':
            //request is about profile change/add/cancel, display the information first
            $profileActivity = retrieve_ProfileActivity_byRequestId($requestId);
            $request = array(
                            'Request ID' => $profileActivity->get_profileActivityRequestId(),
                            'Social Worker' => $profileActivity->get_swFirstName().' '.$profileActivity->get_swLastName(),
                            'Date Submitted' => $profileActivity->get_swDateStatusSubm(),
                            'Activity Type'=>$profileActivity->get_activityType(),
                            'Family Profile ID'=> $profileActivity->get_familyProfileId(),
                            'Parent\'s First Name'=> $profileActivity->get_parentFirstName(),
                            'Parent\'s Last Name'=> $profileActivity->get_parentLastName(),
                            'Email'=> $profileActivity->get_parentEmail(),
                            'Phone 1'=> $profileActivity->get_parentPhone1(),
                            'Phone 2'=> $profileActivity->get_parentPhone2(),
                            'Address'=> $profileActivity->get_parentAddress(),
                            'City'=> $profileActivity->get_parentCity(),
                            'State'=> $profileActivity->get_parentState(),
                            'ZIP'=> $profileActivity->get_parentZip(),
                            'Country'=> $profileActivity->get_parentCountry(),
                            'Patient\'s Firt Name'=> $profileActivity->get_patientFirstName(),
                            'Patient\'s Last Name'=> $profileActivity->get_patientLastName(),
                            'Relation to the patient'=> $profileActivity->get_patientRelation(),
                            'Patient Date of Birth'=> $profileActivity->get_patientDOB(),
                            'PDF Form'=> $profileActivity->get_formPdf(),
                            'Notes'=> $profileActivity->get_familyNotes()
                            );
            
            break;
        default:
            $errors['invalid_parameter'] = "Invalid parameters supplied";
            break;
    }
}
    else
    {
        //there was no POST DATA
        $errors['invalid_request'] = "The request you made is not allowed";
    }
        

?>

<div id="container">
    <div id="content">
        <?php
        if(!empty($errors))
        {
            echo implode('<br/>',$errors);
        }
        else
        {
            
        
        //output the request and submit form
            echo '<table cellpadding="3">';
            foreach($request as $title=>$value)
            {
                echo '<tr>
                        <td style="text-align:right; padding-right: 10px;">
                            <strong>'.$title.'</strong>
                       </td>
                        
                        <td>'
                            .$value.
                       '</td>
                      </tr>';
            }
            echo '</table>';
        ?>
        <form method="post" action="<?php echo BASE_DIR;?>/reservation/activityHandler.php">
            <?php echo generateTokenField(); ?>
            <input type="hidden" name="activityType" value="<?php echo $requestType;?>"/>
            <input type="hidden" name="requestID" value="<?php echo $requestId;?>"/>
            <input type="radio" id="approve" name="status" checked="true" value="approve" />
            <label for="approve">Approve</label>
            <input type="radio" id="deny" name="status" value="deny" />
            <label for="deny">Deny</label>
            <br />
            <input type="submit" name="Submit" value="Submit"/>
       </form>
        <?php
        }
        ?>
        
    </div>
</div>
<?php 
include (ROOT_DIR.'/footer.php'); //include the footer file, this contains the proper </body> and </html> ending tag.
?>