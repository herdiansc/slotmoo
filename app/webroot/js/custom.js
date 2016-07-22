var Custom = [];
/*
Custom.editorInit = function() {
    tinyMCE.init({
        mode:"exact",
        elements:"NoteContent",
        theme : "ntmed",
        width: "100%",
        plugins : "syntaxhl", 
        
        // Theme options
        theme_ntmed_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,image,link,unlink,|,blockquote,syntaxhl",
        theme_ntmed_buttons3 : "",
        theme_ntmed_buttons2 : "",
        theme_ntmed_buttons4 : "",
        theme_ntmed_toolbar_location : "top",
        theme_ntmed_toolbar_align : "left",
        skin : "ntmed",
        //skin : "notemetinymce",
        //skin : "default",
        setup : function(ed) {
            // Add a custom button
            ed.addButton('ntcode', {
                title : 'Code Wrapper',
                image : '',
                onclick : function() {
                    ed.focus();
                    var str = ed.selection.getContent();
                    str = str.replace(/(<([^>]+)>)/ig,"");
                    ed.selection.setContent('<pre class="code">'+str+'</pre>');
                }
            });
        }
    });
};

Custom.commentEditorInit = function() {
    tinyMCE.init({
        mode:"exact",
        elements:"CommentContent",
        theme : "ntmed",
        width: "100%",
        plugins : "syntaxhl", 
        
        // Theme options
        theme_ntmed_buttons1 : "bold,italic,underline,strikethrough,|,link,unlink,|,blockquote,syntaxhl",
        theme_ntmed_buttons3 : "",
        theme_ntmed_buttons2 : "",
        theme_ntmed_buttons4 : "",
        theme_ntmed_toolbar_location : "top",
        theme_ntmed_toolbar_align : "left",
        skin : "ntmed",
        //skin : "notemetinymce",
        //skin : "default",
        setup : function(ed) {
            // Add a custom button
            ed.addButton('ntcode', {
                title : 'Code Wrapper',
                image : '',
                onclick : function() {
                    ed.focus();
                    var str = ed.selection.getContent();
                    str = str.replace(/(<([^>]+)>)/ig,"");
                    ed.selection.setContent('<pre class="code">'+str+'</pre>');
                }
            });
        }
    });
};

Custom.initShareThisStyle = function() {
    $('.social-media-wrapper').bind('mouseover',function(){
        $(this).attr('style','opacity:1');
    }).bind('mouseout',function(){
        $(this).attr('style','opacity:0.1');
    });
}
*/
Custom.initTopicAutocomplete = function(elem,url) {
/*
	$( elem ).autocomplete({
		source: url,
		minLength: 2,
		select: function(event,ui) {
		    var jsoned = '{"id":"'+ui.item.id+'","label":"'+ui.item.label+'"}';
		    var html = '<li>'+
                '<div class="topic-container">'+
                    '<input name="keyword[]" type="hidden" value=\''+jsoned+'\'>'+
                    '<span class="topic-name">'+ui.item.label+'</span>'+
                    '<span class="topic-act" onclick="$(this).parent().parent().fadeOut(function(){$(this).remove()})" title="Remove this topic">x</span>'+
                '</div>'+
            '</li>';
            
            $('li.input-holder').before(html);
            $(this).val('');
            return false;
		}
	})
	.bind('keydown',function(e){
	    if(e.which == 188) {
	        var jsoned = '{"label":"'+$(this).val()+'"}';
		    var html = '<li>'+
                '<div class="topic-container">'+
                    '<input name="keyword[]" type="hidden" value=\''+jsoned+'\'>'+
                    '<span class="topic-name">'+$(this).val()+'</span>'+
                    '<span class="topic-act" onclick="$(this).parent().parent().fadeOut(function(){$(this).remove()})" title="Remove this topic">x</span>'+
                '</div>'+
            '</li>';
            $('li.input-holder').before(html);
            $(this).val('');
            return false;
	    }
	});	
*/
    var cache = {};
    $( elem ).autocomplete({
        source: function(request, response) {
            var term          = request.term.toLowerCase(),
                element       = this.element,
                cache         = this.element.data('autocompleteCache') || {},
                foundInCache  = false;

            $.each(cache, function(key, data){
                if (term.indexOf(key) === 0 && data.length > 0) {
                    response(data);
                    foundInCache = true;
                    return;
                }
            });

            if (foundInCache) return;

            $.ajax({
                url: url,
                dataType: "json",
                data: request,
                success: function(data) {
                    cache[term] = data;
                    element.data('autocompleteCache', cache);
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function(event,ui) {
            var jsoned = '{"id":"'+ui.item.id+'","label":"'+ui.item.label+'"}';
            var html = '<li>'+
                '<div class="topic-container">'+
                    '<input name="keyword[]" type="hidden" value=\''+jsoned+'\'>'+
                    '<span class="topic-name">'+ui.item.label+'</span>'+
                    '<span class="topic-act" onclick="$(this).parent().parent().fadeOut(function(){$(this).remove()})" title="Remove this topic">x</span>'+
                '</div>'+
            '</li>';
            
            $('li.input-holder').before(html);
            $(this).val('');
            return false;
        }
    })
    .bind('keydown',function(e){
        if(e.which == 188) {
            var jsoned = '{"label":"'+$(this).val()+'"}';
	        var html = '<li>'+
                '<div class="topic-container">'+
                    '<input name="keyword[]" type="hidden" value=\''+jsoned+'\'>'+
                    '<span class="topic-name">'+$(this).val()+'</span>'+
                    '<span class="topic-act" onclick="$(this).parent().parent().fadeOut(function(){$(this).remove()})" title="Remove this topic">x</span>'+
                '</div>'+
            '</li>';
            $('li.input-holder').before(html);
            $(this).val('');
            return false;
        }
    });
}

Custom.hideNotif = function(msg,notif_class) {
    $('.ajax-loading').addClass(notif_class).html(msg);
    setTimeout(function(){
        $('.ajax-loading').fadeOut(function(){
            $('.ajax-loading').removeClass(notif_class);
        })
    },3000);
}

Custom.deleteImage = function (el) {
    var url = $(el).attr('data-url');
    $.ajax({
        url:url,
        global:false,
        beforeSend:function() {
            $('.ajax-loading').html('Sedang menghapus...').show();
        },
        success:function(response) {
            var obj = $.parseJSON(response);
            if(obj.status == 'success') {
                var li = $(el).parent().parent();
                $(li).find('.image-thumb').fadeOut(function(){
                    $(this).empty();
                    $(li).find('.add-image').show();
                });
                var notif_class = 'success-floating-notif';
            }else {
                var notif_class = 'error-floating-notif';
            }        
            Custom.hideNotif(obj.message,notif_class);
        }
    })
}

Custom.deleteKeywordListing = function (el) {
    var id = $(el).attr('data-id');
    var listing_id = $(el).attr('data-listing-id');
    $.get(BASE_URL+'keywords/delete_keyword_listing/'+id+'/'+listing_id,function(response){
        var obj = $.parseJSON(response);
        if(obj.status == 'success') {
            $(el).parent().parent().fadeOut(function(){$(el).remove()})
        }
    });
}

Custom.follow = function(el) {
    $.get(BASE_URL+'keywords/follow/'+$(el).attr('data-id'),function(response){
        var obj = $.parseJSON(response);
        if(obj.status == 'success') {
         //   $(el).parent().find('.keyword-unfollow').show();
         //   $(el).hide();
            $(el).removeClass('blue').addClass('red').attr('onclick','Custom.unfollow(this);').text('Unfollow');
            return false;
        }
    });
    return false;
}
Custom.unfollow = function(el) {
    $.get(BASE_URL+'keywords/unfollow/'+$(el).attr('data-id'),function(response){
        var obj = $.parseJSON(response);
        if(obj.status == 'success') {
            //$(el).parent().find('.keyword-follow').show();
            //$(el).hide();
            $(el).removeClass('red').addClass('blue').attr('onclick','Custom.follow(this);').text('Follow');
            return false;
        }
    });
    return false;
}

jQuery.fn.grow = function() {
  this.each(function() {
    // attaching to change makes it paste-aware
    $(this).bind('keyup, change', function() {
      var textarea = $(this);
      // line-height is something like '12px', we need the number
      var lineHeight = $(textarea).css('line-height').split(/\D/)[0];
      var newHeight = $(textarea).attr('scrollHeight');
      var currentHeight = $(textarea).attr('clientHeight');

      if (newHeight > currentHeight) {
        $(textarea).css('overflow', 'hidden'); // prevent scrollbar appearance
        $(textarea).css('height', newHeight + 2 * lineHeight + 'px');
      }
    });
  });
}
