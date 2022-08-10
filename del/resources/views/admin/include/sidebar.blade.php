<!--Main Navigation-->
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <a href="{{ url('admin/dashboard')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav('dashboard'); ?>">
            <i class="fa-solid fa-gauge fa-fw me-3"></i><span>Dashboard</span>
          </a>
          <a
            href="{{ url('admin/user-management')}}"
            class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['user-management','user-information']); ?>"
            aria-current="true"
          >
            <i class="fas fa-users fa-fw me-3"></i><span>&nbsp;User Management</span>
          </a>
           <a href="{{ url('admin/app-intro')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['app-intro','add-new-intro']); ?>">
            <i class="fas fa-solid fa-gears fa-fw me-3"></i><span>&nbsp;App Intro Management</span>

            
          </a>

          <a href="{{ url('admin/category')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['category']); ?>">
            <i class="fas fa-solid fa-bars fa-fw me-3"></i><span>&nbsp;Category Management</span>

            
          </a>

        	<a href="{{ url('admin/all-packages')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['all-packages','package-create','package-details']); ?>">
        		<i class="fas fa-solid fa-boxes-stacked fa-fw me-3"></i><span>&nbsp;Packages</span>
        	</a>

          <a href="{{ url('admin/goals')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['goals']); ?>">
        		<i class="fas fa-solid fa-bullseye-arrow fa-fw me-3"></i><span>&nbsp;Goal Management</span>
        	</a>

          <a href="{{ url('admin/excercise')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['excercise']); ?>">
        		<i class="fa-solid fa-dumbbell"></i>&nbsp;Excercise Management</span>
        	</a>

          <a href="{{ url('admin/free-trial-join-list')}}" class="list-group-item list-group-item-action py-2 ripple <?php active_nav(['free-trial-join-list']); ?>">
        		<i class="fa-solid fa-message-check"></i>&nbsp;Free Trial</span>
        	</a>

          {{--<a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a
          > --}}
          {{-- <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
          </a>
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-globe fa-fw me-3"></i><span>International</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-building fa-fw me-3"></i><span>Partners</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-calendar fa-fw me-3"></i><span>Calendar</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
          >
          <a href="#" class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a
          > --}}
        </div>
      </div>
    </nav>
    <!-- Sidebar -->
  
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button
          class="navbar-toggler"
          type="button"
          data-mdb-toggle="collapse"
          data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i class="fas fa-bars"></i>
        </button>
  
        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <h6 class="head-title">Execubod</h6>
        </a>
        <!-- Search form -->
        
  
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
  
          <!-- Icon -->
         
         
  
          <!-- Avatar -->
          <li class="nav-item dropdown">
            
            <div class="dropdown">

              <a href="{{ url('admin/logout')}}"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
         
             
            </div>
            
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>