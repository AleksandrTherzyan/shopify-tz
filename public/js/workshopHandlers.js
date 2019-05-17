

$(document).ready(function() {

    addGuest();
    removeGuest();
    checkErrors();

    getCustomerFromApi();
    CustomerSearchGuestListHandler();
    CustomerSearchCustomerListHandler()

});

/**
 * add guest area for participant form
 */
function addGuest()
{

    $('[name=add_guest]').click(function (e) {
        e.preventDefault();

        $(".guests").append($('#guest-template').html().replace(/_index_/g, $('.guests .form-group').length));

    });
}

/**
 * remove guest area for participant form
 */
function removeGuest()
{

    $('.guests').on('click', '.remove-guest', function(event) {
        $(event.target).closest('.form-group').remove();
    });
}

/**
 * We check whether it does not already participate
 */
function checkParticipate(form)
{

    var success = false;
    axios.post('/check-participate', {
        workshop_id : $('[name=workshop_id] option:selected').val(),
        customer_name: $('#customer_name').val()
    } )
        .then(response => {

            if ( response.data.response.length > 0) {
                $('.form-errors').html(response.data.response);
            } else {
                $('.form-errors').empty();

                checkFreeSeats(form)

            }

        })
        .catch(error => {
            console.log(error);
            this.errored = true;
        });

    return success;
}

/**
 *  Сheck available space
 */
function checkFreeSeats(form)
{
    axios.post('/check-free-seats', {
        workshop_id : $('[name=workshop_id] option:selected').val(),
        registered_participants_count : $('.guests .form-group').length + 1,
    } )
        .then(response => {

            if ( response.data.response.length > 0) {
                $('.form-errors').html(response.data.response);
            } else {
                $('.form-errors').empty();
                form.submit();
            }

        })
        .catch(error => {
            console.log(error);
            this.errored = true;
        })

}



function checkErrors() {

    $('.register-to-workshop').on('submit', function (e) {
        e.preventDefault();

        var form = this;

        checkParticipate(form);



    });
}


/**
 * Get  shopify customers by name
 */
function getCustomerFromApi()
{

    $( document ).on( "input", ".guest-name", function() {

        var input = $(this);

        axios.post('api/shopify/customer/find', {
            query : 'query=' + input.val(),
        } )
            .then(response => {

                $.each(response.data.customers, function (key, value) {
                    input.next( ".search-result" ).append("<li class='list-group-item search-list' data-email="+ value.email  +" >"+ value.first_name + " " + value.last_name +  "</li>")
                });
            })
            .catch(error => {
                console.log(error);
                this.errored = true;
            })

    });


    $( document ).on( "input", "#customer_name", function() {

        var input = $(this);

        axios.post('api/shopify/customer/find', {
            query : 'query=' + input.val(),
        } )
            .then(response => {

                $.each(response.data.customers, function (key, value) {
                    input.next( ".search-customer-result" ).append("<li class='list-group-item search-customer-list' data-phone="+ value.addresses[0]['phone']  +" >"+ value.first_name + " " + value.last_name +  "</li>")
                });

            })
            .catch(error => {
                console.log(error);
                this.errored = true;
            })

    });




}



function CustomerSearchGuestListHandler()
{

    $(document).on('click', '.search-list', function () {

        $(this).parent().prev('.guest-name').val($(this).text());
        $(this).parent().next().next().val($(this).data('email'));
        $(this).parent().empty();

    });

}


function CustomerSearchCustomerListHandler()
{

    $(document).on('click', '.search-customer-list', function () {

        $(this).parent().prev('#customer_name').val($(this).text());
        $(this).parent().next().next().val($(this).data('phone'));
        $(this).parent().empty();

    });

}
































