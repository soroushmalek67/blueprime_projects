(function() {
    $(".comany-name").click(function(e){
        var twitter = $(this).attr('twitter-url');
        document.getElementById("ifTweets").src = "http://www.blueprime.ca/getTweets.php?name="+twitter.substring(twitter.lastIndexOf("/")+1);
        $(".modal-title").text($(this).text());
        $(".modal-body #details").load( URL+"/companies/"+$(this).attr('id'), function() {
            $('#company-modal').modal();
        });
        
    });


    $(".delete-company").click(function(){
        var this_elem = this; 
        $.ajax({
            url: URL+"/companies/"+$(this_elem).attr("id"),
            type: 'DELETE',
            success: function(response) {
                $(this_elem).parents(".company").fadeOut("slow");
            }
        });
    });


    $("a.destroy").click(function(event) {
        return confirm('Are you sure to delete this record, this can\'t be undone?');
    });

    var linkHandler = {
        start: function() {
            $(document).on('click', 'a[data-method]', this.processLink());
        },
        processLink: function() {
            var self = this;

            return function(e) {
                var link   = $(this),
                    method = link.data('method').toUpperCase();

                if (method === 'PUT' || method === 'DELETE') {
                    self.createForm(link).submit();
                    e.preventDefault();
                }
            };
        },
        createForm: function(link) {
            var form       = document.createElement('form'),
                input      = document.createElement('input'),
                tokenInput;

            form.setAttribute('method', 'POST');
            form.setAttribute('action', link.attr('href'));

            input.setAttribute('name', '_method');
            input.setAttribute('type', 'hidden');
            input.setAttribute('value', link.data('method'));

            if (link.data('token')) {
                tokenInput = document.createElement('input');
                tokenInput.setAttribute('name', 'csrf_token');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('value', link.data('token'));
                form.appendChild(tokenInput);
            }

            form.appendChild(input);
            document.body.appendChild(form);

            return form;
        }
    };

    linkHandler.start();
}());