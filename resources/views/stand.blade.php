<h1>Stand [[ stand.number ]]</h1>
<p><b>Price:</b> [[ stand.price | currency:"$ " ]]</p>
<hr>
<h5>Register form:</h5>
<div class="row">
    <form class="col s12" ng-submit="save()">
        <div class="row">
            <div class="input-field col s12">
                <input id="company" type="text" maxlength="45" data-length="45" ng-model="stand.company" auto-focus>
                <label for="company">Company</label>
            </div>
            <div class="input-field col s12">
                <input id="email" type="email" maxlength="45" data-length="45" ng-model="stand.email">
                <label for="email">Contact email</label>
            </div>
            <div class="input-field col s12">
                <input id="phone" type="text" maxlength="45" data-length="45" ng-model="stand.phone">
                <label for="phone">Contact phone</label>
            </div>
            <div class="input-field col s12">
                <input id="address" type="text" maxlength="45" data-length="45" ng-model="stand.address">
                <label for="address">Address</label>
            </div>
            <input type="submit" class="btn" value="Reserve">
        </div>
    </form>
</div>