<aside id="stand_details" class="side-nav fixed side-details">
    <div ng-if="standSelected != null">
        <img src="" alt="">
        <h4>Stand: [[ standSelected.number ]]</h4>
        <span class="new badge red" data-badge-caption="reserved" ng-if="isReserved(standSelected.status)"></span>
        <p><b>Price:</b> [[ standSelected.price | currency:"$ " ]]</p>
        <hr>
        <a ui-sref="stand_reserve({ id: standSelected.id })" class="btn"
           ng-if="!isReserved(standSelected.status)">Reserve</a>
    </div>

    <div ng-if="standSelected == null">
        <h4>Select a free stand</h4>
    </div>
</aside>
