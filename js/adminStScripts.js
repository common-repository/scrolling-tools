function sliding(id) {
    jQuery(".fieldContainer .fieldContent").css("display", "none");
    jQuery(".editItemRow").css("display", "none");
    jQuery(".fieldContainer #"+id.replace("H2", "Content")).slideDown();
}

function editSlide(id) {
    jQuery(".editItemRow").css("display", "none");
    jQuery("#"+id.replace("editItem", "editItemRow")).slideDown();
}

function delItem(id) {
    if (confirm("This action is irreversible."))
	jQuery("#"+id.replace("delItem", "deletingItem")).submit();
}

function bgReset() {
    if (confirm("Really want to load the default backgrounds ? Your current Background will be lost."))
	jQuery("#bgReseting").submit();

}

function allReset() {
    if (confirm("You are going to reset all data. The items and the style will be reset as default. Current settings will be lost. Ok ?"))
	jQuery("#allReseting").submit();

}

function init() {
    jQuery(".fieldContainer h2").click(function(event) { sliding(event.target.id); });
    sliding("itemsH2");
    jQuery(".editItem").click(function(event) { editSlide(event.target.id); })
    jQuery(".delItem").click(function(event) { delItem(event.target.id); })
    jQuery("#bgReset").click(function() { bgReset(); })
    jQuery("#allReset").click(function() { allReset(); })
}



window.onload = init;
