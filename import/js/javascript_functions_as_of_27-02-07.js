/** Swinburne University of Technology Website: js functions javascript

 *  javascript file including functions destined to the 

 *  implementation of visual effects in the website

 *

 *  MODIFIED:

 *  version 1.0, 12 July 2004.

 * @version 1.1, 28 July 2004.

 * @version 1.2, 27 October 2004. added text size and cookie functions

 * @version 1.3, 6 January 2005. added domain parameter for the text size and cookie functions

 * @version 2.0, 8 January 2007. updated resize text.

 * @author Caroline Rojas crojas@swin.edu.au

 */



/**

 *  Preloads rollover images so they are ready to the rollover effect

 */

 

function function_preloadImages() { 

  var d=document; if(d.images){ if(!d.function_p) d.function_p=new Array();

    var i,j=d.function_p.length,a=function_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.function_p[j]=new Image; d.function_p[j++].src=a[i];}}

}



/**

 *  Restores original images after the rollover effect

 */



function function_swapImgRestore() { 

  var i,x,a=document.function_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;

}



function function_findObj(n, d) { 

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=function_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



/**

 *  Swaps the image when the mouse is over the image doing a rollover effect

 */



function function_swapImage() { 

  var i,j=0,x,a=function_swapImage.arguments; document.function_sr=new Array; for(i=0;i<(a.length-2);i+=3)

   if ((x=function_findObj(a[i]))!=null){document.function_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}

}



//Specify spectrum of different font sizes:

var swin_szs = new Array( 'xx-small','x-small','small','medium','large','x-large','xx-large' );



var swin_tgs = new Array( 'tr','p','td','div','h1','span','h2','a');



//Gets textSize cookie value

function getSwinCookie(name) {

    var swin_dc = document.cookie;

    var swin_prefix = name + "=";

    var swin_begin = swin_dc.indexOf("; " + swin_prefix);

    if (swin_begin == -1) {

        swin_begin = swin_dc.indexOf(swin_prefix);

        if (swin_begin != 0) return null;

    } else {

        swin_begin += 2;

    }

    var swin_end = document.cookie.indexOf(";", swin_begin);

    if (swin_end == -1) {

        swin_end = swin_dc.length;

    }

    return unescape(swin_dc.substring(swin_begin + swin_prefix.length, swin_end));

}



//Updates the font size according to cookie value

function setSwinFontSize(){

 	

	var swin_textSize = getSwinCookie("swinTextSize");

	

	if(swin_textSize==null || swin_textSize=="" || isNaN(swin_textSize))

	{

		

	}

	else {

		

		for (i=0; i<swin_tgs.length; i++) {

			var swintgs = swin_tgs[i];

			

			var swinFontSize=document.getElementsByTagName(swintgs);

			for(var i=0;i<swinFontSize.length;i++)

			{

				swinFontSize[i].style.fontSize = swin_szs[swin_textSize];

			}

		}

		

	}		

}





//create cookies

function swinCreateCookie(swincookie_name,swincookie_value,swincookie_days,swincookie_domain) {

  if (swincookie_days) {

    var swincookie_date = new Date();

    swincookie_date.setTime(swincookie_date.getTime()+(swincookie_days*24*60*60*1000));

    var swincookie_expires = "; expires="+swincookie_date.toGMTString();	

  }

  else swincookie_expires = "";

  if (swincookie_domain) {

	var theDomain = "; domain="+swincookie_domain;

  }

  else swincookie_domain = "";  

  document.cookie = swincookie_name+"="+swincookie_value+swincookie_expires+"; path=/";

}



//Smaller Font

function swinResizeSmall()

{

	var swin_textSize = getSwinCookie("swinTextSize");

		

	if(swin_textSize==null || swin_textSize=="" || isNaN(swin_textSize))

	{

			

		if(navigator.appName == 'Netscape'){

			textsize = 2; 

		} else {

			textsize = 1; 

		}

		

		swin_textSize = textsize;		

		//swin_textSize -= 1;

			

		swinCreateCookie("swinTextSize",swin_textSize,0);

			

		for (i=0; i<swin_tgs.length; i++) {

			var swintgs = swin_tgs[i];

				

			var swinFontSize=document.getElementsByTagName(swintgs);

				

			for(var i=0;i<swinFontSize.length;i++)

			{

				swinFontSize[i].style.fontSize = swin_szs[swin_textSize];

			}

		}



	}

	else {

			

		if (swin_textSize > 1) {

			

			swin_textSize -= 1; 

				

			swinCreateCookie("swinTextSize",swin_textSize,0);

							

			for (i=0; i<swin_tgs.length; i++) {

				var swintgs = swin_tgs[i];

					

				var swinFontSize=document.getElementsByTagName(swintgs);

					

				for(var i=0;i<swinFontSize.length;i++)

				{

					swinFontSize[i].style.fontSize = swin_szs[swin_textSize];

				}

			}

		}

	}

}



//Larger Font

function swinResizeLarge()

{

	var swin_textSize = getSwinCookie("swinTextSize");

		if(swin_textSize==null || swin_textSize=="" || isNaN(swin_textSize))

		{

			if(navigator.appName == 'Netscape'){

				textsize = 3; 

			} else {

				textsize = 2; 

			}

			swin_textSize = textsize;

			swin_textSize = swin_textSize+1 

			swinCreateCookie("swinTextSize",swin_textSize,0);

			

			for (i=0; i<swin_tgs.length; i++) {

				var swintgs = swin_tgs[i];

				

				var swinFontSize=document.getElementsByTagName(swintgs);

				

				for(var i=0;i<swinFontSize.length;i++)

				{

					swinFontSize[i].style.fontSize = swin_szs[swin_textSize];

				}

			}

		}

		else {

			swin_textSize *= 1;

			if (swin_textSize > 0 && swin_textSize < 6) {

			

				swin_textSize += 1 

				

				swinCreateCookie("swinTextSize",swin_textSize,0);

					

				for (i=0; i<swin_tgs.length; i++) {

					var swintgs = swin_tgs[i];

					

					var swinFontSize=document.getElementsByTagName(swintgs);

					

					for(var i=0;i<swinFontSize.length;i++)

					{

						swinFontSize[i].style.fontSize = swin_szs[swin_textSize];

					}

				}

			}

			

		}

}