<script language="javascript" type="text/javascript">
jQuery( document ).ready(function() {
	var totalPages = jQuery('#pageExternalLinkScan tbody tr.page').length;
	function clearTables() {
		jQuery('.link-count, .external-link-count').text('0');
		jQuery('.external-links').text(' ');
		var counter = 0;
		jQuery('#progress-bar').css('transition','none');
		jQuery('#progress-bar').css('width','0');
		jQuery('.count').text('0 out of '+totalPages);
		jQuery('#pleaseWait').css('display','block');
		jQuery('#clearTables').css('display','none');
		jQuery('table.previous-builds-table tr:nth-child(even)').css('background','#f9f9f9');
		jQuery('table.previous-builds-table tr:nth-child(odd)').css('background','#fff');
		jQuery('.pagesText').text('Pages ready for scan:');
		jQuery('.hiddenUntilStarted').css('display','none');
	}

	jQuery('#clearTables').click(function(){
		clearTables();
		setTimeout(function(){
		  jQuery('#startImageScan').click();
	  	}, 1000);
	});
	jQuery('#progress-div').append('<span class="count">0 out of '+totalPages+'</span>');
	jQuery('#startImageScan').on( "click", function() {
		//jQuery('.hiddenUntilStarted').fadeIn();
		jQuery('#startImageScan').css('display','none');
		jQuery('#pleaseWait').css('display','block');
		jQuery('#progress-bar').css('transition','width linear 1s');
		jQuery('.hiddenUntilStarted').css('display','none');

		$hideme = jQuery('#hidden');
		var counter = 0;
		jQuery(".page").each(function() {
			var myRow = jQuery(this);
			var myCounter = counter++;
			myCounterFix = myCounter + 1
			var progressPercent = (myCounterFix/totalPages) * 100 + '%';
			jQuery('.progress').css('width', progressPercent);
			jQuery('.count').text(myCounterFix+' out of '+totalPages);
			jQuery.ajax(myRow.find(".url .urlToGrabForScan").text(), {async: false}).done(function(data) {
				html = jQuery.parseHTML( data );//.find('img'),
				$hideme.append(html);
				jQuery(myRow).find(".link-count").text($hideme.find("a").length);

				//myRow;
				$hideme.find("a").each(function() {
					//ALT ATTRIBUTE MISSING
					if(jQuery(this).attr('target') == '_blank') {
						jQuery(myRow).find(".external-link-count").text(parseInt(jQuery(myRow).find(".external-link-count").text()) + 1);
						var aHref = jQuery(this).attr('href');
						jQuery(myRow).find('.external-links').append('<a target="_blank" href="'+aHref+'">'+aHref+' <span class="sr-only">Opens in new window</span></a><br>');
					}
				});
				$hideme.html("");
			});
		});
		jQuery('#pleaseWait').css('display','none');
		jQuery('#clearTables').css('display','block');
		jQuery('.pagesText').text('Scan Complete.');
		jQuery('.hiddenUntilStarted').css('display','block');
		//html = jQuery.parseHTML( str );//.find('img'),
	});
	jQuery('input#myonoffswitch').change(function(){
		//change to checking if checkbox is checked
	    //jQuery(this).toggleClass('on');
		if (jQuery(this).prop('checked') == true) {
			onoffStatus = "on";
		} else {
			onoffStatus = "off";
		}
		addLinkTargetBlank();

	});
	function addLinkTargetBlank() {
		jQuery.ajax({
			url: "<?php echo plugins_url(); ?>/accessibility-press-links/controllers/externalLink-controller.php",
			data: {status: onoffStatus},
			complete: function(data){
				//console.log(data.responseText);
			},
			dataType: "JSON"
		});
	}
});
</script>

<div id="hidden" style="display: none;">
</div>

<div class="wrap">
    <h2>AccessibilityPress: External Links</h2>
    <h3>This tool can be used to help assess where you have external links. It can also add assistive text and an icon for those using a screen reader in order to alert them of a link that is external.</h3>
	<style type="text/css">
		p {margin: 15px 0;}
		h3 {font-size: 16px; font-weight: normal;}
        table.previous-builds-table { padding: 0; width: 100%;}
        table.previous-builds-table tr:nth-child(even) {background: #f9f9f9}
        table.previous-builds-table tr:nth-child(odd) {background: #FFF}
        table.previous-builds-table th { padding: 0 10px; }
		table.previous-builds-table th a {color: #444;}
		table.previous-builds-table th a[data-title]:hover:after {line-height: 1.2em; content: attr(data-title); padding: 4px 10px; color: #333;position: absolute;right:0px;top: 20px;z-index: 20;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-radius: 4px;background: #fff;border: 1px solid #bbbaba; font-weight: normal;width: 180px;}
		table.previous-builds-table th a:hover {cursor: pointer; position: relative;}
        table.previous-builds-table td { padding: 0 2px; }
        table.previous-builds-table #date { max-width: 150px; }
        table.previous-builds-table #build-number p { text-align: center; }
        table.previous-builds-table #status p { text-align: center; }
        table.previous-builds-table td {vertical-align: middle; padding: 0 10px;}
        table.previous-builds-table td > p {margin-top: 0; margin-bottom: 0;}
		table.previous-builds-table th.postPage {width: 500px;}
		table.previous-builds-table th.numberCol {width: 100px;}
		.ulListing {list-style: disc; padding-left: 30px;}
		button {background: #8cc747 none repeat scroll 0 0;border: medium none;border-radius: 4px; color: #fff;font-size: 15px; padding: 11px 20px;text-transform: uppercase;}
    	button:hover {cursor: pointer; opacity: 0.7;}
		.progress {background: #cfcfcf; height: 20px; transition: width linear 1s; width: 0;}
		.progressContainer {background: #fff; border: 1px solid #bbbaba; width: 100%; height: 20px; border-radius: 4px; margin-bottom: 40px;}
		.count {display: block; text-align: center; font-style: italic; padding: 5px 0;}
		.hiddenUntilStarted {display: none;}
		.clearT {display: none; background: #A39E9E;}
		.wait {display: none; background: #fff; color: #444;}
		.wait:hover {cursor: default;}
		.buttons {padding:15px 0 20px;}
		.sr-only {position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden;clip: rect(0, 0, 0, 0); border: 0;}
		table.previous-builds-table tr.addBtn {background: transparent; }
		table.previous-builds-table tr.addBtn td {padding: 30px 0;}
		button.status.on {background: red;}
		.onoffswitch {position: relative; width: 90px;-webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;}
		input.onoffswitch-checkbox {display: none;}
		.onoffswitch-label {display: block; overflow: hidden; cursor: pointer;border: 2px solid #999999; border-radius: 20px;}
		.onoffswitch-inner {display: block; width: 200%; margin-left: -100%;transition: margin 0.3s ease-in 0s;}
		.onoffswitch-inner:before, .onoffswitch-inner:after {display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;box-sizing: border-box;}
		.onoffswitch-inner:before {content: "ON";padding-left: 10px;background-color: #8cc747; color: #FFFFFF;}
		.onoffswitch-inner:after {content: "OFF";padding-right: 10px;background-color: #EEEEEE; color: #999999;text-align: right;}
		.onoffswitch-switch {display: block; width: 18px; margin: 6px;background: #FFFFFF;position: absolute; top: 0; bottom: 0;right: 56px;border: 2px solid #999999; border-radius: 20px;transition: all 0.3s ease-in 0s;}
		input.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {margin-left: 0;}
		input.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {right: 0px;}
    </style>
    <div class="buttons">
        <button id="startImageScan">Start Link Scan</button>
        <button id="pleaseWait" class="wait">Please Wait...</button>
        <button id="clearTables" class="clearT">Rescan</button>
    </div>
    <div id="progress-div" class="progressContainer"><div id="progress-bar" class="progress"></div></div>
	<div class="onoffswitch">
		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php if (get_option('externalLinkFixStatus') == 'on'): ?>checked<?php else: ?> <?php endif; ?>>
		<label class="onoffswitch-label" for="myonoffswitch">
			<span class="onoffswitch-inner"></span>
			<span class="onoffswitch-switch"></span>
		</label>
	</div>
	<p><i>Adds icon and assistive text to external links.<br> Example: <a target="_blank">Test External Link <span class="sr-only">Opens in new window</span><i aria-hidden="true" class="fa fa-edit fa-external-link"></i></a></i></p>
	<br>
	<div class="hiddenUntilStarted">
    	<p class="pagesText">Pages ready for scan:</p>
        <?php
			$customPostTypeArgs = array(
			   'public'   => true
			 );
			$customPostTypes = get_post_types($customPostTypeArgs);
			$allPostsList = array();
			foreach ( $customPostTypes  as $post_type ) {
				$allPostsList[] = $post_type;
			}
			$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			$args = array(
				'post_type' => $allPostsList,
				'posts_per_page' => '-1',
				'paged'=>$paged
			);
			$posts = get_posts($args);
		?>

        <table id="pageExternalLinkScan" class="previous-builds-table"><tbody>
            <tr valign="top">
                <th class="postPage"><p>Page</p></th>
                <th class="numberCol"><p><a data-title="Total number of links on the page">Total&nbsp;Link&nbsp;Count</a></p></th>
                <th class="numberCol"><p><a data-title='Number of linkes that have target="_blank" attribute.'>External&nbsp;Link&nbsp;Count</a></p></th>
                <th><p><a data-title='Links that have target="_blank" attribute.'>External&nbsp;Links</a></p></th>
            </tr>
            	<?php foreach($posts as $post): ?>
                <tr class="page">
                    <td class="url"><a target="_blank" href="<?php echo get_permalink($post) ?>"><span class="urlToGrabForScan"><?php echo get_permalink($post) ?></span> <span class="sr-only">Opens in new window</span></a></td>
                    <td class="link-count">0</td>
                    <td class="external-link-count">0</td>
                    <td data-external-link="" class="external-links"></td>
                </tr>
            	<?php endforeach ?>
            <?php wp_reset_query(); ?>
        </tbody></table>
	</div>
</div>
<script src="https://use.fontawesome.com/00d8085e0c.js"></script>
