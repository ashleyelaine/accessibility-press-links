jQuery( document ).ready(function() {
	jQuery('a[target="_blank"]').addClass('ap_ExternalLink');
	jQuery('.ap_ExternalLink').append(' <span class="sr-only">Opens in new window</span><i aria-hidden="true" class="fa fa-edit fa-external-link"></i>');
});
