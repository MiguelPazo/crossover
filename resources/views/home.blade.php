@include('__partials.event_details')

<a href="#" id="btn_event_details" data-activates="event_details" data-sidenav="right" data-menuwidth="500"
   data-closeonclick="true" style="display: none;"></a>

<ui-gmap-google-map center="map.center"
                    zoom="map.zoom"
                    draggable="true"
                    options="map.options"
                    control="map.control">
    <ui-gmap-markers models="lstEvents"
                     coords="'coords'"
                     click="eventDetails(id)"
                     options="'options'">
    </ui-gmap-markers>
</ui-gmap-google-map>

