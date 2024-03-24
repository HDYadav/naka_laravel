 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDivu3sZUmFgzmbfLFOWkvlh-NS0XpNiRc&callback=initMap" async defer></script>
 <script>
     function initMap() {
         // Specify the coordinates for the map center
         var myLatLng = {
             lat: 28.589537092775284,
             lng: 77.3807854963989
         };

         // Create a map object and specify the DOM element for display
         var map = new google.maps.Map(document.getElementById('map'), {
             center: myLatLng,
             zoom: 8
         });

         // Create a marker and set its position
         var marker = new google.maps.Marker({
             map: map,
             position: myLatLng,
             title: 'Community Project'
         });
     }
 </script>

 <table class="table table-bordered table-schedule">
     <thead>
         <tr>
             <td>Name</td>
             <td>Mobile No</td>
             <td>Address</td>
             <td>Map</td>
         </tr>
     </thead>

     <tbody>
         @foreach($members as $member)
         <tr>
             <td>{{@$member->name}}</td>
             <td>{{@$member->mobile}}</td>
             <td>{{@$member->address}}</td>
             <td>
                 <div id="map" style="height: 200px; width: 100%;"></div>
             </td>
         </tr>
         @endforeach
     </tbody>
 </table>