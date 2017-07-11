@include('__partials.stand_details')
<div class="container">
    <a href="#" id="btn_stand_details" data-activates="stand_details" data-sidenav="right" data-menuwidth="500"
       data-closeonclick="true" style="display: none;"></a>

    <div class="row">
        <div class="col s12">
            <a ui-sref="home" class="btn">Back</a>

            <h1>[[ event.name ]]</h1>

            <p>[[ event.description ]]</p>

            <p><b>Address:</b> [[ event.address ]]</p>

            <p><b>From:</b> [[ event.start_date ]]</p>

            <p><b>To:</b> [[ event.end_date ]]</p>
            <hr>
            <div class="stands col s12">
                <div class="col s3" ng-repeat="stand in lstStands" ng-class="stand.status"
                     ng-click="standDetails(stand.id)" back-image="[[ getLogoCompany(stand.company_id) ]]">
                    <span ng-if="stand.status == 'free'">[[ stand.price | currency:"$ " ]]</span>
                </div>
            </div>
        </div>
    </div>
</div>
