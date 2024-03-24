<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link">
        <div class="nav-profile-image">
          <img src="{{asset('admin/assets/images/faces/face1.jpg')}}" alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">

          @auth
          <span class="font-weight-bold mb-2">{{auth()->user()->name}}&nbsp;</span>

          @endauth

        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-home menu-icon"></i>
      </a>
    </li>
    @role(['super admin','sub admin','schedule editor','schedule viewer'])
    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link">Users</a>
      <a href="{{ route('city.index') }}" class="nav-link">Places</a>
      <a href="{{ route('years.index') }}" class="nav-link">Years</a>
      <a href="{{ route('days.index') }}" class="nav-link">Days</a>
      <a href="{{ route('schedulers.saved_scheduler') }}" class="nav-link">Schedulers</a>
      <!-- <a href="{{ route('schedulers.list') }}" class="nav-link">Schedulers</a> -->

      <!-- <a href="{{ route('message_giver.index') }}" class="nav-link">Message Giver Task</a>  -->
      <a href="{{ route('roles.index') }}" class="nav-link">Roles</a>
      <a href="{{ route('permissions.index') }}" class="nav-link">Permissions</a>
    </li>
    @endrole

    @role(['message giver','care taker','sub care taker'])
    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link">Users</a>
      <a href="{{ route('tasks.index') }}" class="nav-link">Tasks</a>
    </li>
    @endrole


  </ul>
</nav>