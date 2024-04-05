<?php 

echo "<nav class='navbar navbar-expand-lg navbar_light_blue'>
  <a class='navbar-brand ml-4' href='admin.php?page=sm-plugin-notices'><i class='fas fa-users mr-1'></i>Client Portal</a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav mr-auto pt-2'>
      <li class='nav-item ml-2'>
          <a class='nav-link' href='admin.php?page=sm-plugin-notices'><i class='fas fa-bullhorn mr-1'></i>Plugin Notices<span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item ml-2'>
          <a class='nav-link' href='admin.php?page=sm-company-settings'><i class='fas fa-gear mr-1'></i>Company Settings<span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item dropdown ml-2'>  
        <a class='nav-link dropdown-toggle' href='admin.php?page=sm-add-clients' role='button' data-toggle='dropdown' aria-expanded='false'>
          <i class='fas fa-school mr-1'></i>
          Tutorials
        </a>
        <div class='dropdown-menu'>
          <a class='dropdown-item' href='admin.php?page=sm-tute-add-clients'>Add Client Tutorial</a>
          <a class='dropdown-item' href='admin.php?page=sm-tute-manage-clients'>Manage Clients Tutorial</a>
          <a class='dropdown-item' href='admin.php?page=sm-tute-quote-creation'>Create Quote Tutorial</a>
          <a class='dropdown-item' href='admin.php?page=sm-tute-search-quotes'>Search Quotes Tutorial</a>
          <a class='dropdown-item' href='admin.php?page=sm-tute-create-invoices'>Create Invoice Tutorial</a>
          <a class='dropdown-item' href='admin.php?page=sm-tute-search-invoices'>Search Invoices Tutorial</a>
        </div>
      </li>
      <li class='nav-item dropdown ml-2'>  
        <a class='nav-link dropdown-toggle' href='admin.php?page=sm-add-clients' role='button' data-toggle='dropdown' aria-expanded='false'>
          <i class='fas fa-dollar-sign mr-1'></i>
          Clients
        </a>
        <div class='dropdown-menu'>
       
          <a class='dropdown-item' href='admin.php?page=sm-add-clients'>Add Client</a>
          <a class='dropdown-item' href='admin.php?page=sm-manage-clients'>Manage Clients</a>
          <a class='dropdown-item' href='admin.php?page=sm-quote-creation-1a'>Create Quote</a>
          <a class='dropdown-item' href='admin.php?page=sm-search-quotes'>Search Quotes</a>
          <a class='dropdown-item' href='admin.php?page=sm-search-quotes'>Create Invoice</a>
          <a class='dropdown-item' href='admin.php?page=sm-search-invoice'>Search Invoices</a>
        </div>
      </li>
      <li class='nav-item ml-2'>
          <a class='nav-link' href='admin.php?page=sm-globals'><i class='fas fa-earth-americas mr-1'></i>Global Tasks<span class='sr-only'>(current)</span></a>
        </li>
      <li class='nav-item ml-2'>
          <a class='nav-link' href='admin.php?page=sm-contact-developers'><i class='fas fa-envelope mr-1'></i>Contact Developers<span class='sr-only'>(current)</span></a>
        </li>
    </ul>
  </div>
</nav>";
