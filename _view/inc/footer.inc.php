<?php 
 /****************************************************************************************
 * Team Name:  OPA                                                                       *
 * Date:       24 Nov 2011                                                               *
 * Version No: 3                                                                         *
 *                                                                                       *
 * File Name:  footer.inc.php                                                            *
 * Desc:       This file is the HTML footer included on each page                        * 
 ****************************************************************************************/
?>
<!-- Start OPA footer -->
          </div><!-- END content-col -->
        </div><!-- END content -->
        <div class="clear">&nbsp;</div><!--this div is important to be in this order to keep the image on menu-->
      </div><!-- END column -->
    </div><!-- END wrapper -->
  </div><!-- END container -->
</div><!-- END main -->

<!-- START FOOTER WRITER v2.0 --> 

<script type="text/javascript">
    function swinResizeText(param) {
        if(param=='-1') {
            swinResizeSmall();
        } else {
            swinResizeLarge();
        }
    }
</script>
<div id="footer">
  <div id="foot">
    <ul>
      <li>© Swinburne</li>
      <li>CRICOS number 00111D</li>
      <li><a href="http://www.swinburne.edu.au/contact.htm">Contact Us</a></li>
      <li><a href="http://localhost/disclaimer.htm" accesskey="8">Copyright and disclaimer</a></li>
      <li><a href="http://localhost/privacy.htm">Privacy</a></li>
      <li><a href="http://localhost/feedback.htm" accesskey="9">Feedback</a></li>
      <li><a href="http://localhost/accessibility.htm" accesskey="0">Accessibility Information</a></li>
      <li><a href="javascript:swinResizeText('-1')">- Smaller Font</a></li>
      <li class="last"><a href="javascript:swinResizeText('1')">+ Larger Font </a></li>
    </ul>
    <ul>
      <li>Style Last Updated: Wednesday, 18-Jun-2008 17:00:47 EST</li>
      <li>Style maintained by: Caroline Rojas <a href="mailto:webmaster@swin.edu.au">(webmaster@swin.edu.au)</a></li>
      <li>Authorised by: Andrew Normand <a href="mailto:webmaster@swin.edu.au">(webmaster@swin.edu.au)</a></li>
    </ul>
  </div>
</div>

<!-- END FOOTER WRITER --> 
<script type="text/javascript">
// Create the tooltips only on document load
$(document).ready(function() 
{
   // tooltips for title elements, textareas and labels
   $('.input-text').qtip({ style: { name: 'cream', tip: true } })
   $('title').qtip({ style: { name: 'cream', tip: true } })
   $('textarea').qtip({ style: { name: 'cream', tip: true } })
   $('label').qtip({ style: { name: 'cream', tip: true } })
   $('.form_dropdown').qtip({ style: { name: 'cream', tip: true } })
   $('#add-more-attachments ').qtip({ style: { name: 'cream', tip: true } })
   $('.inputDate"').qtip({ style: { name: 'cream', tip: true } })
     
});
</script>


<script type="text/javascript">
    
    //checks to see what the status has been changed to
    //if the status is set to closed the dmtRiskDateClosed input will be enabled
    function statusCheck(){
        
        //checks to see if closed is selected, else set the dmtRiskDateClosed input to true
        if(document.riskadd.enmRiskStatus.value == "Closed"){
            document.getElementById("inputDate2").disabled = false;
        }else{
            document.getElementById("inputDate2").disabled = true;   
        }

    }
    
</script>


</body>
</html>
