@include('__partials.stand_details')

<a href="#" id="btn_stand_details" data-activates="stand_details" data-sidenav="right" data-menuwidth="500"
   data-closeonclick="true" style="display: none;"></a>

<div class="row">
    <div class="col s12">
        <h1>[[ event.name ]]</h1>
        <p>[[ event.description ]]</p>
        <p><b>Address:</b> [[ event.address ]]</p>
        <p><b>From:</b> [[ event.start_date ]]</p>
        <p><b>To:</b> [[ event.end_date ]]</p>
        <hr>
        <div class="stands col s12">
            <div class="col s3" ng-repeat="stand in lstStands" ng-class="{free: stand.status == 'free'}"
                 ng-click="standDetails(stand.id)">
                <span ng-if="stand.status == 'free'">[[ stand.price | currency:"$ " ]]</span>
            </div>
        </div>
    </div>
</div>
