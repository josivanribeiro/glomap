/**
 * Opens an accordion section by its id. 
 * 
 * @param id the accordion id.
 */
function openAccordionSection (id) {
	if ($("#" + id).is ('.active')) {
		closeAccordionSection (id);
	} else {
		closeOtherAccordionSections (id);
		$("#" + id).addClass('active');
		$("#" + id).slideDown (300).addClass('open');
	}
}

/**
 * Closes an accordion section by its id.
 * 
 * @param id the accordion id.
 */
function closeAccordionSection (id) {
	$('#' + id).removeClass ('active');
	$('#' + id).slideUp(300).removeClass ('open');
}

/**
 * Closes all other accordion sections with id different of the informed.
 * 
 * @param id the informed id.
 */
function closeOtherAccordionSections (id) {
	var accordionSectionArr = document.getElementsByClassName ("accordion-section-content");
	var sectionNumber = id.replace ("accordion-", "");
	for (var i = 0; i < accordionSectionArr.length; i++) {
		if (i != sectionNumber) {
			closeAccordionSection ("accordion-" + i);
		}
	}
}