
<div class="column" >
    <button  type="button" class="btn btn-success participate-modal-btn" data-toggle="modal" data-target="#participateModal" data-whatever="@mdo">Participate</button>

</div>

<div class="modal fade" id="participateModal" tabindex="-1" role="dialog" aria-labelledby="participateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="register-to-workshop" action="{{ route('add-participate') }}" method="post">
        @csrf
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="participateModalLabel">Please, fill out the form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                        <div class="form-group">
                            <label for="customer_name" class="col-form-label">Customer name:</label>
                            <input name="customer[name]" type="text" class="form-control customer_name" id="customer_name" required>

                            <ul class="list-group search-customer-result" ></ul>

                            <label for="phone" class="col-form-label">Phone:</label>
                            <input name="customer[phone]"  class="form-control" id="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="workshop_time" class="col-form-label">Workshop time:</label>
                            <select name = "workshop_id" class="custom-select" id="workshop_time">
                                @foreach($workshops as $workshop)
                                    <option value="{{$workshop->id}}">{{ $workshop->day . ', ' . $workshop->time}}</option>
                                @endforeach
                            </select>
                        </div>

                    <hr>

                    <div class="guests"></div>

                    <div class="form-group">
                        <button  type="button" name="add_guest" class="btn btn-success add-guest-btn">Add guest</button>
                    </div>
                </div>
                <div  class="modal-footer">
                    <div  class="form-errors">
                    </div>
                    <button  type="submit" class="btn btn-primary ">Book workshop</button>
                </div>
            </div>
        </form>

    </div>
</div>


<template id="guest-template" >
    <div class="form-group ">
        <input type="hidden">
        <button   type="button" class="close remove-guest" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <br>

        <label for="guest_name" class="col-form-label">Guest name:</label>
        <input name="guests[_index_][name]"  class="form-control guest-name" value="" required>

        <ul class="list-group search-result" ></ul>

        <label for="guest_email" class="col-form-label">Email:</label>
        <input name="guests[_index_][email]" type="email"  class="form-control guest-email"  required>
        <hr>
    </div>


</template>











