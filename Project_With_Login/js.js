/* Last Name : Chandru, First Name : Jeyanth, Due Date : November 30, 2016,
Project Number : Assignment 4 */
$(document).ready(function(){

	$("#search_value").click(function(){
		$("#value_text_search").show();
		$("#desc_text_search").hide();
		$("#desc_text_search").val('');		
	})
	$("#search_description").click(function(){
		$("#value_text_search").hide();
		$("#value_text_search").val('');		
		$("#desc_text_search").show();
	})
	$("#display_all").click(function(){
		$("#value_text_search").hide();
		$("#value_text_search").val('');		
		$("#desc_text_search").hide();
		$("#desc_text_search").val('');		
	})
})

function hideAll(){
		$("#value_text_search").hide();
		$("#desc_text_search").hide();
}
function showValue()
{
	$("#value_text_search").show();
	$("#search_value").prop("checked", true);
}

function showAuthor()
{
	$("#desc_text_search").show();
	$("#search_description").prop("checked", true);
}

function showAll(){
	$("#display_all").prop("checked", true);

}

jQuery.fn.highlight = function (str, className) {
    var regex = new RegExp(str, "gi");
    return this.each(function () {
        $(this).contents().filter(function() {
            return this.nodeType == 3 && regex.test(this.nodeValue);
        }).replaceWith(function() {
            return (this.nodeValue || "").replace(regex, function(match) {
                return "<span class=\"" + className + "\">" + match + "</span>";
            });
        });
    });
};

function open_script(){
   window.location.assign('http://localhost/WDM/Project4/newuser.php');
}