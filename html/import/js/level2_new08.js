/* JavaScript Document
 * Finds all the links in the .main_table, and sets up event listeners
 * onClick=\"javascript:urchinTracker('/current_students/');\" 
 */
 
var level2 = {
	
	init: function(page) {
		// Get all links in top menu
		var topnav = document.getElementById("top_menu");
		var topnavlinks = topnav.getElementsByTagName("a");
		
		// Get all links in content
		var content = document.getElementById("main");
		var links = content.getElementsByTagName("a");
		
		// Get all links in footer
		var footernav = document.getElementById("foot");
		var footernavlinks = footernav.getElementsByTagName("a");
		
		var topclicker = function() {
					
			var linktext = this.innerHTML;
						
			if(linktext.match("em")|| linktext.match("EM")){
				var topnav = this.getElementsByTagName("em")[0];
				var linktext = topnav.title
			}
			var url=page + '/Top Nav - ' + linktext;
			alert(url);
			urchinTracker(url);
		}
		
		var clicker = function() {
			var linktext = this.innerHTML;	
			
			
			if(linktext.match("img")|| linktext.match("IMG")){
				var image = this.getElementsByTagName("img")[0];
				var linktext = image.alt;
			}
			
			var url=page + '/' + linktext;
			alert(url);
			urchinTracker(url);
		}
		
		var footerclicker = function() {
			var linktext = this.innerHTML;	
			var url=page + '/Footer - ' + linktext;
			alert(url);
			urchinTracker(url);
		}
		
		for(var i =0; i < topnavlinks.length; i++) {
			Core.addEventListener(topnavlinks[i], 'click', topclicker);
		}
		
		for(var i =0; i < links.length; i++) {
			Core.addEventListener(links[i], 'click', clicker);
		}
		
		for(var i =0; i < footernavlinks.length; i++) {
			Core.addEventListener(footernavlinks[i], 'click', footerclicker);
		}
	}
}