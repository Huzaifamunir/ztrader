/**
 * Global Variables
 *
 */
var total_amount=0;

/**
 * Close message box.
 *
 * @param id
 * @return
 */
function close_me(id){
	$('#'+id).slideUp('slow');
}

/**
 * Return the XSS free data.
 *
 * @param id
 * @return string 
 */
function check_xss(id){
	data=document.getElementById(id);
	var value=data.value;

	var filtered_data=String(value).replace(/&/g, '&amp;').replace(/</g, '').replace(/>/g, '').replace(/"/g, '&quot;');
	data.value=filtered_data;
}

/**
 * Create click event listner of element.
 *
 * @param id
 * @return 
 */
function add_new_event_listner(id){
	//alert(id);
  document.getElementById(id).addEventListener("dblclick", function(){
      select_me(this.id);
  });
}



/**
 * Show and Hide passwords.
 *
 * @param id
 * @return 
 */
function show_hide_password() {
	if($("#password").attr("type")=="password"){
		$("#password").attr("type","text");
		$("#re_password").attr("type","text");
	}else{
		$("#password").attr("type","password");
		$("#re_password").attr("type","password");
	}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).ready(function() {
	
/**
 * return the XSS free data.
 *
 * @param id
 * @return 
 */
$('#print_challan').click(function () {
	//alert("Printing...");
	window.print();
	 // $('#challan').printThis({
	 //      debug: false,              // show the iframe for debugging
	 //      importCSS: true,           // import page CSS
	 //      printContainer: true,      // grab outer container as well as the contents of the selector
	 //      loadCSS: "/css/w3.css", // path to additional css file
	 //      pageTitle: "",             // add title to print page
	 //      removeInline: false        // remove all inline styles from print elements
	 //  	});
});




}); // end of document.ready()


