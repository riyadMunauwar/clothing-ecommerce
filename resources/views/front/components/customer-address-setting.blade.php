<div class="row">

    @foreach($addresses as $address)
        <div class="col-lg-6">
            <div class="card card-dashboard">
                <div class="card-body">
                    <h3 class="card-title">Address {{ ++$loopt->index }}</h3><!-- End .card-title -->

                    <p>{{ $address->name }}<br>
                    {{ $address->mobile_no }}<br>
                    {{ $address->email }}<br>
                    {{ $address->street }}<br>
                    {{ $address->zip }}<br>
                    {{ $address->city }}<br>
                    {{ $address->state }}<br>
                    {{ $address->country }}<br>
                    <!-- <a href="https://portotheme.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="31485e44435c50585d715c50585d1f525e5c">[email&#160;protected]</a><br> -->
                    <!-- <a href="#">Edit <i class="icon-edit"></i></a></p> -->
                </div>
            </div><!-- End .card-dashboard -->
        </div><!-- End .col-lg-6 -->
    @endforeach


<!-- 
    <div class="col-lg-6">
        <div class="card card-dashboard">
            <div class="card-body">
                <h3 class="card-title">Shipping Address</h3>

                <p>You have not set up this type of address yet.<br>
                <a href="#">Edit <i class="icon-edit"></i></a></p>
            </div>
        </div>
    </div> -->

</div><!-- End .row -->