var alerts = {
    alertContainer: jQuery('.msgs'),
    validAlertTypes: ['success', 'danger', 'warning', 'info'],
    typeAliases: {
        "error" : 'danger'
    },

    createAlert: function(type, text, dismissable = true, timeout){
        // Missing Parameters?
        if(typeof(type) === 'undefined' || typeof(text) === 'undefined')
            return console.error('Missing Parameters 😭');

        // Is the type and alias?
        if(this.isAlias(type))
            type = this.getAliasValue(type);

        // Is Valid Alert
        if(this.validAlertTypes.indexOf(type) === -1)
            type = 'default';

        var dismissableClass = '';
        if(dismissable)
            dismissableClass = 'alert-dismissible';

        // Create Alert
        var elementHTML = '';
        elementHTML += '<div class="alert '+dismissableClass+' alert-'+type+'" style="display: none">';
        if(dismissable)
            elementHTML += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        elementHTML += '<span aria-hidden="true">&times;</span>';
        elementHTML += '</button>';
        elementHTML += text;
        elementHTML += '</div>';

        // Add to dom
        var element = jQuery(elementHTML).appendTo(this.alertContainer).slideDown("fast");

        if(typeof(timeout) !== 'undefined')
            element.delay(timeout * 1000).queue(function(){
                $(this).remove();
            });


        return element;
    },

    isAlias: function(type){
        if(typeof(type) === 'undefined')
            return console.error('Type not specified! 😱');

        return this.typeAliases.hasOwnProperty(type);
    },

    getAliasValue: function(type){
        if(typeof(type) === 'undefined')
            return console.error('Type not specified! 😱');

        return this.typeAliases[type];
    }
};