<?php 
 /***************************************************************************************
 * Team Name: OPA                                                                       *
 * Date: 22 Nov 2011                                                                    *
 * Version No: 2                                                                        * 																		*
 *                                                                       		*
 * File Name: riskController.php                                                        *
 * Desc:This file is included once with Controller. The main() function switches between*
 * each menu option                                                                     * 
 ***************************************************************************************/

class RiskController extends IRSController {

    //private $riskObj;
    //protected $attachmentObj;
    //private $sessionArr, $sessionObj;

    public function __construct($memberArr, $projectArr, $sessionArr) {
        parent::__construct('risk', $memberArr, $projectArr, $sessionArr);
    }
    //main function switches between Add risk, Edit risk and delete risk sessions
//     public function main() {
//         switch($this->sessionArr['strPage']) {
//            case "risk":
//                if ($this->sessionArr['strTodo'] != "") {
//                    switch ($this->sessionArr['strTodo']) {
//                        case "add":
//                            $this->todoAddRisk();
//                            break;
//                        case "edit":
//                            $this->todoEditRisk();
//                            break;
//                        case "delete":
//                            $this->todoDeleteRisk();
//                            break;
//                    }
//                }
//                
//                $this->sessionArr['strPage'] = "riskhistory"; // if user choose Risk from Menu
//            //display different screens
//           case "riskhistory":
//               $this->displayHistoryRisk();
//               break;
//           
//           case "riskview":
//               $this->displayViewRisk();
//               break;
//           
//           case "riskpdf":
//               $this->displayPDFRisk();
//               break;
//           
//           case "riskadd":
//               $this->displayAddRiskForm();
//               break;
//           
//           case "riskedit":
//               $this->displayEditRiskForm();
//               break;
//        }
//    }
  
    //Function to Post Add Risk Items
//     private function todoAddRisk() {
//        $intRiskID = $_POST['intRiskID'];
//        $intProjectID = $_POST['intProjectID'];
//        $intProjectMemberID = $_POST['intProjectMemberID'];//raised By
//        $strRiskDescription = $_POST['strRiskDescription'];
//        $strRiskTypeID = $_POST['strRiskTypeID'];
//        $enmRiskStatus = $_POST['enmRiskStatus'];
//        $dmtRiskDateRaised = $_POST['dmtRiskDateRaised'];
//        $dmtRiskDateClosed = $_POST['dmtRiskDateClosed'];
//        $enmRiskLikelihoodOfImpact = $_POST['enmRiskLikelihoodOfImpact'];
//        $strRiskImpactDescription = $_POST['strRiskImpactDescription'];
//        $enmRiskProjectImpactRating  = $_POST['enmRiskProjectImpactRating'];
//        $strRiskMitigationStrategy = $_POST['strRiskMitigationStrategy'];
//        $strRiskContingencyStrategy = $_POST['strRiskContingencyStrategy'];
//        $intProjectMemberAssignedID  = $_POST['intProjectMemberAssignedID '];//Assigned To
//
//        $strAttachmentLinkArr = array();
//        $strAttachmentCommentArr = array();
//        
//        $i = 0;
//        while (isset($_FILES['strAttachmentLink' . ($i)])) {
//            $target = $_ENV['uploads_dir'] . basename($_FILES['strAttachmentLink' . $i]['name']);
//            if (!move_uploaded_file($_FILES['strAttachmentLink' . $i]['tmp_name'], $target)) {
//                echo "Sorry, there was a problem uploading your file."; // <--/this is Alert/
//            } else {
//                $strAttachmentLinkArr[$i] = basename($_FILES['strAttachmentLink' . $i]['name']);
//                $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];
//            }
//            $i++;
//        }
//        
//        $this->riskObj->addDetailsRisk($intRiskID,$intProjectID,$intProjectMemberID,$strRiskDescription,$strRiskTypeID,$enmRiskStatus,$dmtRiskDateRaised,$dmtRiskDateClosed,$enmRiskLikelihoodOfImpact,$strRiskImpactDescription,$enmRiskProjectImpactRating, 
//                $strRiskMitigationStrategy,$strRiskContingencyStrategy,$intProjectMemberAssignedID,$strAttachmentLinkArr, $strAttachmentCommentArr);
//
//        $this->sessionArr['strPage'] = "riskview";
//    }
//  
    
        
//riskcontroller gets Risk Obj sets session ID and calls delete details function
//   private function todoDeleteRisk() {
//        $this->riskObj->setID($this->sessionArr['intRiskID']);
//        $this->riskObj->delDetails();
//
//        $this->sessionArr['intRiskID'] = null;
//        $this->sessionObj->setDetails($this->sessionArr);
//
//        $this->sessionArr['strPage'] = "riskhistory";
//    }
    
 
 //Function for editing risk -posts the risk fields
//    private function todoEditRisk() {
//        $intRiskID = $_POST['intRiskID'];
//        $intProjectID = $_POST['intProjectID'];
//        $intProjectMemberID = $_POST['intProjectMemberID'];//raised By
//        $strRiskDescription = $_POST['strRiskDescription'];
//        $strRiskTypeID = $_POST['strRiskTypeID'];
//        $enmRiskStatus = $_POST['enmRiskStatus'];
//        $dmtRiskDateRaised = $_POST['dmtRiskDateRaised'];
//        $dmtRiskDateClosed = $_POST['dmtRiskDateClosed'];
//        $enmRiskLikelihoodOfImpact = $_POST['enmRiskLikelihoodOfImpact'];
//        $strRiskImpactDescription = $_POST['strRiskImpactDescription'];
//        $enmRiskProjectImpactRating  = $_POST['enmRiskProjectImpactRating'];
//        $strRiskMitigationStrategy = $_POST['strRiskMitigationStrategy'];
//        $strRiskContingencyStrategy = $_POST['strRiskContingencyStrategy'];
//        $intProjectMemberAssignedID  = $_POST['intProjectMemberAssignedID '];//Assigned To
//
//        $isNextAttachment = true;
//        $i = 0;
//        do {
//            $intAttachmentIDArr[$i] = $_POST["intAttachmentID" . $i];
//            $strAttachmentLinkArr[$i] = $_POST["strAttachmentLink" . $i];
//            $strAttachmentCommentArr[$i] = $_POST["strAttachmentComment" . $i];
//
//            if (isset($_POST["intAttachmentID" . ($i + 1)])) {
//                $i++;
//            } else {
//                $isNextAttachment = false;
//            }
//        } while ($isNextAttachment == true);
//
//        $this->riskObj->setDetails($this->sessionArr['intRiskID'], $intRiskID,$intProjectID,$intProjectMemberID,$strRiskDescription,$strRiskTypeID,$enmRiskStatus,$dmtRiskDateRaised,$dmtRiskDateClosed,$enmRiskLikelihoodOfImpact,$strRiskImpactDescription,$enmRiskProjectImpactRating, 
//                $strRiskMitigationStrategy,$strRiskContingencyStrategy,$intProjectMemberAssignedID,$strAttachmentLinkArr, $strAttachmentCommentArr);
//
//        $this->sessionArr['strPage'] = "riskview";
//    }
//    
    
//Function to display the risk History table-gets the last risk ID, 
//creates a new instance of the RiskHistoryGui-calls historyRisk method-displays table and bottom menu
//    private function displayHistoryRisk() {
//        $this->IRSObj->getLastID();
//        $riskHistoryGUIObj = new RiskHistoryGUI();
//        $riskHistoryGUIObj->setSession($this->sessionArr);
//                
//        $intID = $this->IRSObj->getID();
//        if (!empty($intID)) {
//            $this->IRSObj->getDetails();
//            $historyTableArr = $this->IRSObj->historyRisk();
//
//            $riskHistoryGUIObj->display($historyTableArr);
//            //$riskHistoryGUIObj->displayRiskBottomMenu();
//        } else {
//            //if no history items displays Add form
//            $this->sessionArr['strPage'] = "riskadd";
//        }
//    }
 
//Function to display the Risk View if one, otherwise runs the riskadd method
//     private function displayViewRisk() {
//        if (!empty($this->sessionArr['intRiskID'])) {
//            $this->displayViewRiskPart();
//        } else {
//            $this->sessionArr['intRiskID'] = $this->riskObj->getLastRiskID();
//            $this->sessionObj->setDetails($this->sessionArr);
//            if (!empty($this->sessionArr['intRiskID'])) {
//                $this->displayViewRiskPart();
//            } else {
//                $this->sessionArr['strPage'] = "riskadd";
//            }
//        }
//    }
   
 //Function to display part of the Risk View   
//    private function displayViewRiskPart() {
//        $this->riskObj->setIDRisk($this->sessionArr['intRiskID']);
//        $this->riskObj->getDetailsRisk();
//        $currentRiskMessage = $this->riskObj->viewRisk();
//   //Gets the currentRiskMessage(view)     
//        $riskGUIObj = new RiskGUI();
//        $riskGUIObj->setSession($this->sessionArr);
//        $riskGUIObj->display($currentRiskMessage);
//    }
//    
////Function to convert Risk View to a PDF   
//    private function displayPDFRisk() {
//        $this->riskObj->setIDRisk($this->sessionArr['intRiskID']);
//        $this->riskObj->getDetailsRisk();
//        $currentRiskMessage = $this->riskObj->viewRisk();
// //Displays the PDF of the currentRiskMessage       
//        $riskGUIObj = new RiskGUI();
//        $riskGUIObj->setSession($this->sessionArr);
//        $riskGUIObj->displayPDFRisk($currentRiskMessage);
//    }
    
 //Function to display Risk Add Form
//    private function displayAddRiskForm() {
//        $this->sessionArr['intRiskID'] = null;
//        $this->sessionObj->setDetails($this->sessionArr);
//        
//        $riskGUIObj = new RiskGUI();
//        $riskGUIObj->setSession($this->sessionArr);
//        $riskGUIObj->displayAddForm();
//    }
// 
// 
//   
////Function to display the Edit Risk Form
//    private function displayEditRiskForm() {
//        if ($this->sessionArr['intRiskID'] != "") {
//            $this->riskObj->setIDRisk($this->sessionArr['intRiskID']);
//            $riskArr = $this->riskObj->getDetailsRisk();
//            //$this->attachmentObj->setID($this->sessionArr['intRiskID']);
//            //$this->attachmentObj->getDetailsFromDBRisk();
//            //$attachmentArr = $this->attachmentObj->getDetails();
//   //new instance of RiskGui, set session-displays edit form, including risk array and attachment array         
//            $riskGUIObj = new RiskGUI();
//            $riskGUIObj->setSession($this->sessionArr);
//            $riskGUIObj->displayEditForm($riskArr);
//        } else {
//            die("wrong data in edit form");
//        }
//    }
//    
////Function to display the Email Form
//    //Need to add something here
//private function displayEmailRiskForm() {
//        
//    }

}
 
?>
