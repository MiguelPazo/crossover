<aside id="event_details" class="side-nav fixed side-details">
    <div ng-if="eventSelected != null">
        <h1>[[ eventSelected.name ]]</h1>
        <p>[[ eventSelected.description ]]</p>
        <p><b>Address:</b> [[ eventSelected.address ]]</p>
        <p><b>From:</b> [[ eventSelected.start_date ]]</p>
        <p><b>To:</b> [[ eventSelected.end_date ]]</p>
        <hr>
        <p>[[ eventSelected.stands ]] free</p>
        <p>[[ eventSelected.stands_reserved ]] reserved</p>
        <a ui-sref="event({ id: eventSelected.id })" class="btn">Book your place</a>
    </div>

    <div ng-if="eventSelected == null">
        <h4>Select an event from map</h4>
    </div>
</aside>
