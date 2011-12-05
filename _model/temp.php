        $memberObj = new Member();
        $intMemberID = $memberObj->getMemberID($this->intProjectMemberID);
        $memberObj->setID($intMemberID);
        $memberArr = $memberObj->getDetails();
        
        $currentStatusMessage = '<div class="viewgroup"><div class="labelView"><b>DATE: </b></div><div class="fieldstatus"> ' . 
                date("jS F Y", strtotime($this->dmtStatusCurrentDate)) . "</div></div>\n" .
                '<div class="viewgroup"><div class="labelView"><b>Status Created By: </b></div>' . "\n";
        $currentStatusMessage .= '<div class="fieldstatus">' . $memberArr['strMemberFirstName'] . " " . $memberArr['strMemberLastName'];
        $currentStatusMessage .= '</div></div>'  . "\n";
        $currentStatusMessage .= '<div class="viewgroup"><div class="labelView"><b>Project: </b></div>' . "\n"; 
        $currentStatusMessage .= '<div class="fieldstatus"> ' . $this->projectArr['strProjectName'] . "</div></div>" ."\n" .
        '<div class="viewgroup"><div class="labelView"><b>Actual Status: </b></div><div class="fieldstatus"> ' . $this->strActualBaseline . "</div></div>" . "\n" .
        '<div class="viewgroup"><div class="labelView"><b>Planned Baseline: </b></div><div class="fieldstatus"> ' . $this->strPlanBaseline . "</div></div>" . "\n" .
        '<div class="viewgroup"><div class="labelView"><b>Variation: </b></div><div class="fieldstatus"> ' . $this->strStatusVariation . "</div></div>" . "\n" .
        '<div class="viewgroup"><div class="labelView"><b>Notes/Reasons: </b></div><div class="fieldstatus"> ' . $this->strStatusNotes . '</div></div>' . "\n";

