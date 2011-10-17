fields = 1;
function addAttachmentLink() {
    if (fields != 10) {
        document.getElementById('text').innerHTML += '<hr /><br />Attachment ' + (fields+1) + ':<br /><input type="text" name="strAttachmentLink' + fields + '" value="http://"/><br /><br />Attachment '+ (fields+1) + ' Comment:<br /><input type="text" name="strAttachmentComment' + fields + '" /><br /><br />';
        fields += 1;
    } else {
        document.getElementById('text').innerHTML += "<br />Only 10 upload fields allowed.";
        document.statusadd.add.disabled=true;
    }
}
