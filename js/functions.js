fields = 1;
function addAttachmentLink() {
    // only 4 attachments allowed
    if (fields != 4) {
        document.getElementById('text').innerHTML += '<hr /><br />Attachment ' + (fields+1) + 
            ':<br /><input type="text" name="strAttachmentLink' + fields + 
            '" value="http://"/><br /><br />Attachment '+ (fields+1) + 
            ' Comment:<br /><input type="text" name="strAttachmentComment' + fields + '" /><br /><br />';
        fields += 1;
    } else {
        document.getElementById('text').innerHTML += "<br />Only 4 upload fields allowed.";
        document.statusadd.add.disabled=true;
    }
}
