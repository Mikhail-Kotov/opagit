// The function is fired on the submit hyperlink click 
// it validates the input and redirects to the Browse international (domestic) courses page of the system
// It also enforces population of the Keyword field on the page with the text entered in the Keyword box

function ValidateAndRedirect()
{
	try{
		var keywordToSearchFor = document.getElementById("txtSearch").value;
	 	if ( keywordToSearchFor == "" )
	 	{
	 		showHideKeywordsValidation(true);
	 		return;
	 	}
		
		var btn = valSelectionById();
	 	if (btn == null )
	 	{
	 		showHideStudentValidation(true);
	 		return;
	 	}
	 	
	 	if ( btn == "0")
	 		document.location = "http://courses.swinburne.edu.au/courses/BrowseCourse.aspx?KeywordSearch=" + keywordToSearchFor + "&Populate=true";
	 	else
	 		document.location = "http://courses.swinburne.edu.au/courses/BrowseCourseIntl.aspx?KeywordSearch=" + keywordToSearchFor + "&Populate=true";
	 }catch(e){}

}
	 				
// The function returns the selection of the radio button group
// returns "0" if "Local Students" selection is made
// returns "1" if "International Students" selection is made
// returns null if no selection is made
// The function utilizes getElementById (as opposed to document.all or document.forms) 
// so shall work for all the browsers
function valSelectionById()
{
	var local = document.getElementById("radLocal");
	var international = document.getElementById("radInternational");
	if ( local.checked )
	 	return "0";
	if ( international.checked )
	 	return "1";
	return null;
}

// The function hides the Div with id="DivStudentValidationDetails"
// The function utilizes getElementById (as opposed to document.all or document.forms) 
// to get the handle of the div html elelment
// so shall work for all the browsers
// the function uses style.display = 'block' ('none') (as opposed to visibility='visible' : 'hidden' to display/hide the div element
// as per request from SUT staff
function showHideStudentValidation(show)
{
	var studentVal = document.getElementById("DivStudentValidationDetails");
	studentVal.style.display = show ? 'block' : 'none';
}
	 				
// The function hides the Div with id="DivKeywordValidationDetails"
// The function utilizes getElementById (as opposed to document.all or document.forms) 
// to get the handle of the div html elelment
// so shall work for all the browsers
// the function uses style.display = 'block' ('none') (as opposed to visibility='visible' : 'hidden' to display/hide the div element
// as per request from SUT staff
function showHideKeywordsValidation(show)
{
	var keywordVal = document.getElementById("DivKeywordValidationDetails");
	keywordVal.style.display = show ? 'block' : 'none';
}