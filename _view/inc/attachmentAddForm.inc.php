<!--
        <div class="field"><input type="file" name="file" id="file" value="" /></div>
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
-->

<div class="statusgrp">
    <div class="labeladd">
        <label for="strAttachmentLink0" title="Browse for a file to substantiate your status e.g. Gantt image. You can upload the following file types: PDF, jpg, tiff, png, docx, xls.">Attachment 1:</label>
    </div>
    <div class="fieldthestatus">
        <input type="file" name="strAttachmentLink0" />
    </div>
</div>
    
<div class="statusgrp">
    <div class="labeladd">
        <label for="strAttachmentComment0" title="Name your attachment or add a comment.">Attachment Comment:</label>
    </div>
    <div class="fieldthestatus">
        <input type="text" name="strAttachmentComment0" />
    </div>
</div>

<div class="statusgrp">
    <div>&nbsp;</div>   
    <input type="button" onclick="addAttachmentLink()" src="images/add-more-attachments.gif" name="add" value="Add more attachments" />     
<!--    <input type="button" onclick="addAttachmentLink()" id="add-more-attachments" 
           title="Add more attachments button will enable 3 more attachments to be attached." 
           src="images/add-more-attachments.gif" alt="add more attachments button" name="add" value="Add more attachments" />-->
</div>


