<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        We<span>Care</span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="sidebar-body">
      <ul class="nav">
        <li class="nav-item nav-category">Main</li>
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>

        <li class="nav-item nav-category">Health Care</li>
        @can('viewAny',\App\Models\Specializations::class)
        <li class="nav-item">
            <a href="{{ route('specialization.index') }}" class="nav-link">
              <i class="link-icon" data-feather="stop-circle"></i>
              <span class="link-title">Specialization</span>
            </a>
        </li>
        @endcan
        @can('viewAny',\App\Models\Doctor::class)
            <li class="nav-item">
                <a href="{{ route('doctors.index') }}" class="nav-link">
                <i class="link-icon" data-feather="user-plus"></i>
                <span class="link-title">Doctors</span>
                </a>
            </li>
        @endcan
        @can('viewAny',\App\Models\HealthCare::class)
            <li class="nav-item">
                <a href="{{ route('healthcare.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="airplay"></i>
                    <span class="link-title">Health Care</span>
                </a>
            </li>
        @endcan
        @can('viewAny',\App\Models\Appointments::class)
        <li class="nav-item nav-category">Appointments</li>
        <li class="nav-item">
            <a href="{{ route('appointments.index') }}" class="nav-link">
                <i class="link-icon" data-feather="at-sign"></i>
                <span class="link-title">Appointments</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('recordings.index') }}" class="nav-link">
                <i class="link-icon" data-feather="link"></i>
                <span class="link-title">Recordings</span>
            </a>
        </li>
        @endcan


        <li class="nav-item nav-category">Users</li>
            <li class="nav-item">
                <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="link-icon" data-feather="edit"></i>
                <span class="link-title">Profile</span>
                </a>
            </li>
        @can('viewAny',\App\Models\User::class)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users" role="button" aria-expanded="false" aria-controls="users">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Manage Users</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="users">
                <ul class="nav sub-menu">
                    @can('viewAny',\App\Models\User::class)
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                        </li>
                    @endcan
                    @can('viewAny',\App\Models\UserType::class)
                        <li class="nav-item">
                        <a href="{{ route('usertype.index') }}" class="nav-link">Permissions</a>
                        </li>
                    @endcan
                </ul>
                </div>
            </li>
        @endcan
      </ul>
    </div>
</nav>
