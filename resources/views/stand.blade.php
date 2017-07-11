<div class="container">
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
                <div class="input-field col s12">
                    <label for="address" class="active">Logo company</label>

                    <div id="upload_logo">
                        <p><b>Logo:</b>[[ stand.logo.name ]]</p>
                    </div>
                    <a id="btn_upload_logo" class="btn btn-separate">Upload logo</a>
                </div>

                <div class="input-field col s12">
                    <label for="address" class="active">Marketing documents</label>

                    <div id="upload_files">
                        <table class="striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Document</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="document in lstDocuments track by $index">
                                <td>[[ $index + 1 ]]</td>
                                <td>[[ document.name ]]</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <a id="btn_upload_files" class="btn btn-separate">Upload documents</a>
                </div>
                <div class="input-field col s12 right-align" ng-if="!uploading">
                    <input type="submit" class="btn" value="Confirm Reservation">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="preview-upload" style="display: none;"></div>