<aside class="sidebar-left">
  <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <h1><a class="navbar-brand" href="index.html"><span class="fa fa-area-chart"></span> Glance<span class="dashboard_text">Design dashboard</span></a></h1>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="treeview">
            <a href="{{ route('admin.index') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
    <li class="treeview">
            <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Products</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ route('products.index') }}"><i class="fa fa-angle-right"></i> All Products</a></li>
              <li><a href="#"><i class="fa fa-angle-right"></i> Create Product</a></li>
            </ul>
          </li>

          <li class="treeview">
          <li class="treeview">
            <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="general.html"><i class="fa fa-angle-right"></i> General</a></li>
              <li><a href="icons.html"><i class="fa fa-angle-right"></i> Icons</a></li>
              <li><a href="buttons.html"><i class="fa fa-angle-right"></i> Buttons</a></li>
              <li><a href="typography.html"><i class="fa fa-angle-right"></i> Typography</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="forms.html"><i class="fa fa-angle-right"></i> General Forms</a></li>
              <li><a href="validation.html"><i class="fa fa-angle-right"></i> Form Validations</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li><a href="tables.html"><i class="fa fa-angle-right"></i> Simple tables</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->

      
  </nav>
  
</aside>