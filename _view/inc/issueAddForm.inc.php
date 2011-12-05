<h1>Add Issue</h1>
<form name="issueadd" method="post" action="" id="event-submission">
    <div id="">
        <!--<fieldset class="event-submission">-->

        <div class="field">
            <input type="hidden" name="page" value="issue" />
            <input type="hidden" name="todo" value="add" />
            <input type="hidden" name="intSessionID" value="<?php echo $this->sessionArr['intSessionID']; ?>" />
        </div>
        <div class="groupopa">
            <div class="labelopa">
                <label for="intProjectMemberID" title="Automatic name field.">Issue Raised By:</label>
            </div>
            <div class="fieldopa">
                <input type="text" class="input-text" id="intProjectMemberID" value="<?php echo $this->memberArr['strMemberFirstName'] . " " .
 $this->memberArr['strMemberLastName'];
?>"  size="28" maxlength="40" disabled="disabled" />
            </div>
            <div class="labelopa">
                <label for="strProjectName" title="Automatic name field.">Project Name:</label>
            </div>
            <div class="fieldopa">
                <input type="text" id="strProjectName" class="input-text"  size="35" maxlength="40" value="<?php echo $this->projectArr['strProjectName']; ?>" class="input-text"  size="28" maxlength="43" disabled="disabled" />
            </div> 
        </div>
        <div class="groupopa">    
            <div class="labelopa">
                <label for="enmIssueStatus "  title="Choose whether Status is open or closed.">Issue Status:</label>
            </div>
            <div class="fieldopa"> 
                <select name="enmIssueStatus" class="form_dropdown">
                    <?php
                    //print_r($allIssueStatusArr);
                    foreach ($allIssueStatusArr as $id => $value_not_used) {
                        echo '<option value="' . $allIssueStatusArr[$id] . '"';
                        echo '>' . $allIssueStatusArr[$id] . "</option>\n";
                    }
                    ?>
            </select>
            </div> 
        </div>
        <div class="groupopa"> 
            <div class="labelopadate">
                <label for="dmtIssueDateRaised "  title="Current date will be populated unless you choose to change it.">Date Raised:</label>
            </div>
            <div class="fieldopadate">
                <input type="text" id="dmtIssueDateRaised" class="input-text" size="28" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" />
            </div>

            <div class="labelopadate">
                <label for="dmtIssueDeadline"  title="The date the issue needs to be fixed. Current date is poulated-please change to required date.">Issue Deadline:</label>
            </div>
            <div class="fieldopadate">
                <input type="text" id="dmtIssueDeadline" class="input-text" size="28" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" />
            </div>
        </div> <!--end of dateraised / deadline group-->

        <div class="groupopa"> <!--start description group-->
            <div class="labelopa">
                <label for="strIssueDescription"  title="A description of the issue.">Issue Description:</label>
            </div>
            <div class="fieldopa"> 
                <textarea name="strIssueDescription" title="A description of the issue."  class="form_textarea" rows="2" cols="80"></textarea>
            </div>
        </div> <!--end of description group-->

        <div class="groupopa"> <!--start type group-->

            <div class="labelopa">
                <label for="enmIssueType"  title="Select the type of issue">Issue Type:</label>
            </div>
            <div class="fieldopa">
                <select name="strIssueTypeID" class="form_dropdown">


                    <?php
                    foreach ($allIssueTypeArr as $id => $value_not_used) {
                        echo '<option value="' . $allIssueTypeArr[$id]['strIssueTypeID'] . '"';
                        echo '>' . $allIssueTypeArr[$id]['strIssueTypeID'] . "</option>\n";
                    }
                    ?>
                </select>
            </div>

        </div> <!--end of issue type group-->

        <div class="groupopa"><!--start Priority group-->
            <div class="labelopa">
                <label for="enmIssuePriority" title="Select the priority from the dropdown list.">Issue Priority:</label>
            </div>
            <div class="fieldopa">
                <select name="enmIssuePriority" title="Choose a priority from the dropdown list." class="form_dropdown">

                    <?php
                    //print_r($allIssuePriorityArr);
                    foreach ($allIssuePriorityArr as $id => $value_not_used) {
                        echo '<option value="' . $allIssuePriorityArr[$id] . '"';
                        echo '>' . $allIssuePriorityArr[$id] . "</option>\n";
                    }
                    ?>
                </select>
            </div> 
            </di> <!--end of issue priority group-->

            <div class="groupopa"><!--start Assigned To group-->
                <div class="labelopa">
                    <label for="$intProjectMemberAssignedID" title="Choose a project member to Assign the Issue." >Assigned To:</label>
                </div>
                <div class="fieldopa">
                    <select name="intProjectMemberAssignedID" class="form_dropdown">

                        <?php
                        $memberAssignedObj = new Member();
                        $allMembersArr = $memberAssignedObj->getAllProjectMembers($this->sessionArr['intProjectID']);

                        foreach ($allMembersArr as $id => $value) {
                            $intMemberAssignedID = $memberAssignedObj->getMemberID($allMembersArr[$id]['intMemberID']);
                            $memberAssignedObj->setID($intMemberAssignedID);
                            $memberAssignedArr = $memberAssignedObj->getDetails();

                            echo '<option value="' . $allMembersArr[$id]['intMemberID'] . '">' .
                            $allMembersArr[$id]['strMemberFirstName'] . " " .
                            $allMembersArr[$id]['strMemberLastName'] . "</option>\n";
                        }
                        ?>

                    </select>
                </div>

            </div><!--end of Assigned to group-->
            <div class="groupopa"><!--start Date closed group-->
                <div class="labelopadate">
                    <label for="dmtIssueDateClosed "  title="The day the issue was closed is automatically set to current date.">Date Closed:</label>
                </div>
                <div class="fieldopadate">
                    <input type="text" id="dmtIssueDateClosed" title="The day the issue was closed is automatically set to current date." class="input-text" size="28" maxlength="10" value="<?php echo $_ENV['currentDate']; ?>" />
                </div>

                <div class="labelopa">
                    <label for="$strIssueOutcome"  title="Type in the outcome of the issue ie: resolved, still current issue-but closed.">Issue Outcome:</label>
                </div>
                <div class="fieldopa">

                </div>
            </div> <!--End of Outcome group-->


            <?php
            include_once("attachmentAddForm.inc.php");
            ?>

            <input type="image" src="images/submit.gif" alt="submit button"    value="Submit" class="submit" />


        </div>     
        <!-- </fieldset>-->
</form>
