  <style>
      /* .show {
          display: block; 
      }

      .hide {
          display: none;           
      } */

      .table-schedule tr th {
          display: flex;
          align-items: center;
          justify-content: space-between;
          gap: 1rem;
      }
  </style>

  <form method="post" action="{{route('schedulers.update')}}">
      @csrf

      <?php
        $x = 1;
        foreach ($days as $key => $day) {
            $i = 0;

        ?>

          <table class="table table-bordered table-schedule">
              <tbody>

                  <tr class="table-info">
                      <th colspan="2" align="center"><strong> Sunday <?php echo $day->date; ?> </strong> <span id="show<?php echo $x; ?>" style="cursor:pointer">Show/Hide</span> </th>
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
                                ?>
                                  <tr>
                                      <td> <?php echo $city->id; ?> </td>
                                      <td>

                                          <a data-toggle="modal" data-target="#myModal" id="<?php echo "cityId_" . $city->id; ?>" onclick="showModal(this.id)" data-num="0"><?php echo $city->city_name; ?> </a>

                                          <input type="hidden" name="city[]" value="{{ $city->id}}">
                                          <input type="hidden" value="{{$day->id}}" name="dayIDs[]">

                                      </td>

                                      <td>
                                          <select name="member[]" id="member" class="form-control form-control-sm">

                                              <option value="">Select speaker</option>
                                              <?php
                                                foreach ($members as $member) {
                                                ?>
                                                  <option value="<?php echo $member->id ?>"><?php echo $member->name ?></option>
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

      <button type="submit" class="btn btn-primary">Save</button>


  </form>

  <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
   <script src="{{asset('admin/assets/js/validation.js')}}"></script> -->



  <script>
      $(function() {

          $("#show1").click(function() {

              $("#tbd1").toggle();

              $("#tbd2").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd4").css("display", "none");

          });


          $("#show2").click(function() {

              $("#tbd2").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd3").css("display", "none");
              $("#tbd4").css("display", "none");

          });


          $("#show3").click(function() {
              $("#tbd3").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd2").css("display", "none");
              $("#tbd4").css("display", "none");

          });

          $("#show4").click(function() {
              $("#tbd4").toggle();
              $("#tbd1").css("display", "none");
              $("#tbd2").css("display", "none");
              $("#tbd3").css("display", "none");
          });

      });
  </script>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">Modal</h4>
              </div>
              <div class="modal-body">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo aut consectetur nihil deserunt ullam at pariatur ipsum, quisquam a cum obcaecati omnis, eaque praesentium fugiat voluptatum ad iste dolor mollitia? Commodi, voluptatibus obcaecati voluptas ipsa itaque neque officia amet, quaerat nobis quod quam praesentium porro ex esse accusantium molestias repellendus saepe, exercitationem aut. Numquam incidunt aspernatur non odit nulla facere nobis cupiditate harum sint possimus quae sit iusto dolore, rem et aperiam voluptas doloremque. Possimus esse tempora ad laudantium distinctio facilis quidem nemo dolorem vero repudiandae. Illo, doloremque accusamus. Molestiae eligendi repellat, obcaecati optio veritatis laudantium dolore qui labore quia odit sequi, nostrum laboriosam minus accusamus rerum recusandae? Voluptatibus temporibus dolores odio officia! Necessitatibus numquam quidem magnam sunt facilis, alias debitis excepturi provident eius perspiciatis tempora voluptatum
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick="hideModal()">Close</button>

              </div>
          </div>
      </div>
  </div>


  <script>
      function showModal(modalId) {
          console.log(modalId)
          $('#myModal').modal('show'); // Show modal
      }

      function hideModal() {
          $('#myModal').modal('hide'); // Hide modal
      }
  </script>