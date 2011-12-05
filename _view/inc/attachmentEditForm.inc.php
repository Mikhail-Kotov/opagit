<?php

if (!empty($attachmentArr['intAttachmentIDArr'][0])) {
    foreach ($attachmentArr['intAttachmentIDArr'] as $id => $value_not_using) {
        echo '<div><input type="hidden" name="intAttachmentID' . $id .
        '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" /></div>' .
        '<div class="statusgrp"><div class="statuslabel">' .
        '<label title="Do you want to change the attachment?">Attachment: </label></div>' . ($id + 1) . ": " .
        '<a href="' . $_ENV['http_dir'] . $_ENV['uploads_dir'] .
        $attachmentArr['strAttachmentLinkArr'][$id] . '">' .
        $attachmentArr['strAttachmentLinkArr'][$id] . '</a></div></div>' .
        '<div class="statusgrp"><div class="statuslabel"><label>Attachment Comment: </label></div>' .
        '<div class="stEditfield">' .
        '<input type="text" title="Do you want to change the attachment comment?" ' .
        'class="input-text" size="35" maxlength="40" name="strAttachmentComment' .
        $id . '" value="' . $attachmentArr['strAttachmentCommentArr'][$id] . '" disabled="disabled" /></div></div>';
        echo '<div class="statusgrp"><div class="statuslabel">' .
        '<label title="Do you want to change the attachment?"><label>Delete Attachment: </label></div>'.
                '<div class="stEditfield"><input type="checkbox" class="" title="Do you want to delete the atachment?" name="deleteattachment' . $id .
        '" value="' . $attachmentArr['intAttachmentIDArr'][$id] . '" /></div></div>';
    }
}
?>