  <style>
      .table-schedule tr th {
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 1rem;
      }
  </style>


  <table class="table table-bordered table-schedule">
      <tbody>

          <tr>
              <td colspan="2" align="center"><strong> <?php echo ucfirst(@$status->status); ?> Scheduled List</strong> </td>
          </tr>
      </tbody>
  </table>

  <?php
    $x = 1;
    foreach ($days as $key => $day) {
        $i = 0;

    ?>

      <table class="table table-bordered table-schedule">
          <tbody>

              <tr class="table-info">
                  <th colspan="2" align="center"><strong> Week {{$x}}, Sunday <?php echo $day->date; ?> </strong> <span id="show<?php echo $x; ?>" style="cursor:pointer">Show/Hide</span> </th>
                  </th>

              <tr id="tbd<?php echo $x ?>" <?php if ($x > 1) { ?> style="display:none" <?php } ?>>

                  <td colspan="2">
                      <table width="100%">
                          <tr>
                              <td><strong>SN.</strong> </td>
                              <td><strong>Place</strong> </td>
                              <td><strong>Speaker</strong> </td>
                          </tr>
                          <?php

                            foreach ($cities as $key => $city) {
                                $members = json_decode(getUsers());
                                $userID =   getUserID($day->id, $city->id);
                            ?>
                              <tr>
                                  <td> <?php echo $city->id; ?> </td>
                                  <td>

                                      <a data-toggle="modal" data-target="#myModal" id="<?php echo $city->id; ?>" onclick="showModal(this.id)" data-num="0"><?php echo $city->city_name; ?> </a>

                                      <input type="hidden" name="city[]" value="{{ $city->id}}">
                                      <input type="hidden" value="{{$day->id}}" name="dayIDs[]">

                                  </td>

                                  <td>
                                      <select name="member[]" id="member" class="btn btn-sm btn-outline-primary dropdown-toggle" required>

                                          <option value="" class="dropdown-item">Select speaker</option>
                                          <?php
                                            foreach ($members as $member) {
                                            ?>
                                              <option value="<?php echo $member->id ?>" class="dropdown-item" <?php if ($member->id == @$userID->user_id) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $member->name ?></option>
                                          <?php } ?>

                                      </select>
                                  </td>
                              </tr>

                          <?php $i++;
                            } ?>

                      </table>
                  </td>

              </tr>

          </tbody>
      </table>

  <?php $x++;
    } ?>
  <br>
  <br>


  <button type="submit" name="update" value="save" class="btn btn-primary">Save & Publish</button>
  <button type="submit" name="draft" value="draft" class="btn btn-primary">Save Draft</button>

  <!-- <button type="submit" name="pdf" value="pdf" class="btn btn-primary">Download PDF </button> --> 
  <a href="{{@$yearId}}/{{@$monthId}}/pdf" class="btn btn-primary btn-sm">Download PDF </a> 

  <script>
      $(function() {

          $("#show1").click(function() {

              $("#tbd1").toggle();

              $("#tbd2").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd4").css("display", "none");
              $("#tbd5").css("display", "none");
          });


          $("#show2").click(function() {

              $("#tbd2").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd4").css("display", "none");
              $("#tbd5").css("display", "none");
          });


          $("#show3").click(function() {
              $("#tbd3").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd2").css("display", "none");
              $("#tbd4").css("display", "none");
              $("#tbd5").css("display", "none");
          });

          $("#show4").click(function() {
              $("#tbd4").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd2").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd5").css("display", "none");
          });

          $("#show5").click(function() {
              $("#tbd5").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd2").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd4").css("display", "none");
          });


      });
  </script>



  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">User Details</h4>
              </div>
              <div class="modal-body" id="response">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideModal()">Close</button>

              </div>
          </div>
      </div>
  </div>


  <script>
      function showModal(modalId) {

          var city_id = modalId
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              url: baseUrlAdmin + '/schedulers/get_city_modal',
              method: "GET",
              data: {
                  'city_id': city_id
              },
              success: function(data) {
                  $('#myModal').modal('show'); // Show modal 
                  $("#response").html(data.html);
              }
          });

      }

      function hideModal() {
          $('#myModal').modal('hide'); // Hide modal
      }
  </script>