        <b>Add Status</b><br /><br />
        <form name="statusadd" method="post" action="">
            <input type="hidden" name="page" value="status" />
            <input type="hidden" name="todo" value="add" />
            <input type="hidden" name="intSessionID" value="<?php echo $this->sessionObj->getID(); ?>" />
            User:<br />
            some user<br /><br />
            Status Creation Date:<br />
            <input type="text" name="dmtStatusCurrentDate" value="<?php echo $_ENV['currentDate']; ?>"/><br /><br />
            Project Name:<br />
            <select name ="intProjectID">
                <?php
                $projectsArr = getProjects($this->memberObj->getID());
                foreach ($projectsArr as $columnName => $value) {
                    echo '<option value="' . $value['intProjectID'] . '"';
                    if ($value['intProjectID'] == $this->projectObj->getID()) {
                        echo ' selected="selected"';
                    }
                    echo'>' . $value['strProjectName'] . "</option>\n";
                }
                ?>
            </select>
            <br /><br />
            Actual Baseline:<br />
            <textarea name="strActualBaseline" /></textarea><br /><br />
        Plan Baseline:<br />
        <textarea name="strPlanBaseline" /></textarea><br /><br />
        Variation:<br />
        <textarea name="strStatusVariation"></textarea><br /><br />
        Notes/Reasons:<br />
        <textarea name="strStatusNotes"></textarea><br /><br />
        Attachment 1:<br />
        <input type="text" name="strAttachmentLink0" value="http://"/><br /><br />
        Attachment 1 Comment:<br />
        <input type="text" name="strAttachmentComment0" /><br /><br />
        <div id="text">
            
        </div>
        <input type="button" onclick="addAttachmentLink()" name="add" value="Add more attachments" /><br />
            
        <br />
        <input type="submit" value="Submit" />
        </form>
