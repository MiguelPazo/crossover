<aside id="stand_details" class="side-nav fixed side-details">
    <div ng-if="standSelected != null">
        <div class="photo_section" back-image="[[ getImage(standSelected.id) ]]"></div>
        <h4>Stand: [[ standSelected.number ]]</h4>
        <span class="new badge red" data-badge-caption="reserved" ng-if="isReserved(standSelected.status)"></span>

        <p><b>Price:</b> [[ standSelected.price | currency:"$ " ]]</p>
        <hr>
        <a ui-sref="stand_reserve({idEvent: standSelected.event_id, id: standSelected.id })" class="btn"
           ng-if="!isReserved(standSelected.status)">Reserve</a>

        <div ng-if="standSelected.status == 'reserved'">
            <p>Marketing documents:</p>
            <table class="striped">
                <tr ng-repeat="document in lstDocuments track by $index" ng-click="downloadDocument(document)"
                    class="documents">
                    <td width="15">[[ $index + 1 ]]</td>
                    <td>[[ document.name ]]</td>
                </tr>
            </table>
        </div>
    </div>

    <div ng-if="standSelected == null">
        <h4>Select a free stand</h4>
    </div>
</aside>
