$( function() {

    // FORM

    // form fix
    $( "form" ).on( "submit", function() {
        var $form = $( this );
        var $files = $form.find( "input[type='file']" );
        if ( $files.length > 0 ) {
            $files.each( function() {
                var $this = $( this );

                if ( $this.val() == "" ) $this.attr( "disabled", "disabled" );
            } )
        }
    } );

    $( ".form-file input[type='file']" ).off( "change" ).on( "change", function() {
        var $this = $( this );
        var file = $this.val().split( "\\" ).pop();
        var $file = $this.closest( '.form-file' );
        var $span = $file.find( 'span' );

        if ( file !== "" ) {
            $span.text( file );
            $file.addClass( 'active' );
        }
        else {
            $span.text( $span.data( 'title' ) );
            $file.removeClass( 'active' );
        }
    } );

    $( ".form-select select" ).off( "change" ).on( "change", function() {
        var $this = $( this );
        var $select = $this.closest( ".form-select" );
        $select.addClass( 'active' );
    } );


    $(".form-error" ).off().on("click", function() {
        var $this = $( this );
        $this.siblings("input,textarea" ).focus();

    });

    $(".form-group.has-error .form-control" ).on("focus", function() {
        $( this ).siblings(".form-error").stop().fadeOut(300);
    }).on("blur", function() {
        $( this ).siblings(".form-error").stop().fadeIn(300);
    })

    $(".form-error" ).each(function() {
        var $this = $( this );
        perc = 100;
        while ( perc > 50 && $this[0].scrollWidth > $this.innerWidth() )
        {
            perc -= 5;
            $this.css({'font-size': perc+'%','line-height': '20px'});
        }
    });

    // SELECT (multiple relations)
    var multiple_update = function() {
        $( ".form-group ul.list-group.select .close" ).off( "click" ).on( "click", function() {
            var $li = $( this ).closest( ".list-group-item" );
            var $ul = $li.closest( '.list-group' );
            var $input = $li.find( 'input[type="hidden"]' );
            var $select = $li.closest( '.form-group' ).find( "select" );
            $select.find( 'option[value="' + $input.val() + '"]' ).removeAttr( 'disabled' ).show();

            $li.remove();

            if ( $ul.find( ".list-group-item" ).length == 0 ) $ul.addClass( 'hidden' );
        } )
    }

    $( "select.multiple" ).off( "change" ).on( "change", function() {

        var $this = $( this );
        var $group = $this.closest( '.form-group' );
        var $ul = $group.find( "ul.list-group" );
        var o = '';
        var $option = $this.find( "option:selected" );

        if ( $option.length > 1 ) $option = $( $option[0] );

        o += '<li class="list-group-item">';
        o += '   <input type="hidden" name="' + $this.data( 'name' ) + '[]" value="' + $option.val() + '"/>';
        o += '    ' + $option.text();
        o += '   <a class="close"><i class="fa fa-times"></i></a>';
        o += '</li>';

        $ul.removeClass( 'hidden' );
        $ul.append( o );

        $option.attr( 'disabled', '' ).hide();

        $this.find( "option:first" ).prop( "selected", true );

        multiple_update();

    } );

    multiple_update();

    $( ".form-group ul.list-group.select input[type='hidden']" ).each( function() {
        var $this = $( this );
        var $select = $this.closest( '.form-group' ).find( "select" );

        if ( $select.length == 1 ) {
            $select.find( 'option[value="' + $this.val() + '"]' ).prop( 'selected', true ).change();
            $this.remove();
        }
        else {
            $this.find("")
        }
    } );

    // DELETE
    $( ".form-group ul.list-group.delete input[disabled]" ).addClass("disabled");

    $( ".form-group ul.list-group.delete .close" ).off( "click" ).on( "click", function() {
        var $this = $( this );
        var $li = $( this ).closest( ".list-group-item" );
        var $input = $li.find( 'input.disabled' );
        var $inputs = $li.find( 'input:not(.disabled)' );

        if( $li.hasClass("disabled") )
        {
            $li.removeClass("disabled");
            $input.attr("disabled","true");
            $inputs.removeAttr("disabled");
            $this.find("i.fa" ).removeClass("fa-check" ).addClass("fa-times");
        }
        else {
            $li.addClass("disabled");
            $input.removeAttr("disabled");
            $inputs.attr("disabled","true");
            $this.find("i.fa" ).addClass("fa-check" ).removeClass("fa-times");
        }

    } )
} );
