/* ------------------------------------------------------------------------------
 *
 *  # Custom JS code
 *
 *  Place here all your custom js. Make sure it's loaded after app.js
 *
 * ---------------------------------------------------------------------------- */

function onStartProcess()
{
	let dfd = $.Deferred();

    $('.page-content').block({
    	centerY: false,
    	centerX: false,
        message: '<div class="font-size-lg alert alert-primary alert-rounded alert-dismissible">' + window.text_loading + '</div>',
        overlayCSS: {
        	zIndex: 1200,
            backgroundColor: '#fff',
            opacity: 0.8,
            cursor: 'wait'
        },
        css: {
        	zIndex: 1201,
        	position: 'fixed',
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        },
        onBlock: function() { 
            dfd.resolve();
        }
    });

    return dfd.promise();
}

function onEndProcess()
{
	let dfd = $.Deferred();
	
	$('.page-content').unblock({
		onUnblock: function() { 
            dfd.resolve();
        }
	});

	return dfd.promise();
}