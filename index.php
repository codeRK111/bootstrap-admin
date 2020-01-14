<?php
 include('config/db.php'); 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");

    
    
    exit;
    
}

if ($_SESSION["role"] == 'user') {
    echo $_SESSION["role"];
    header("location: useroverview.php");
   
} 


 $mockups = array();

$sql = $conn->prepare("SELECT id ,
                              name 
                              from quizname 
                              ");
//$sql->bind_param();
$sql->execute();
$result = $sql->get_result();


if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()) 
    {
        array_push($mockups, $row);
    }
    
}

// print_r($mockups[0]['id']);






?>



<?php include "includes/header.php"; ?>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul
                class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
                id="accordionSidebar"
            >
                <!-- Sidebar - Brand -->
                <a
                    class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="index.php"
                >
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        SB Admin <sup>2</sup>
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0" />

                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a
                    >
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider" />

                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Interface
                </div> -->

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseTwo"
                        aria-expanded="true"
                        aria-controls="collapseTwo"
                    >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Components</span>
                    </a>
                    <div
                        id="collapseTwo"
                        class="collapse"
                        aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Components:</h6>
                            <a class="collapse-item" href="buttons.html"
                                >Buttons</a
                            >
                            <a class="collapse-item" href="cards.html">Cards</a>
                        </div>
                    </div>
                </li> -->

                <!-- Nav Item - Utilities Collapse Menu -->
                <!-- <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseUtilities"
                        aria-expanded="true"
                        aria-controls="collapseUtilities"
                    >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div
                        id="collapseUtilities"
                        class="collapse"
                        aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="utilities-color.html"
                                >Colors</a
                            >
                            <a
                                class="collapse-item"
                                href="utilities-border.html"
                                >Borders</a
                            >
                            <a
                                class="collapse-item"
                                href="utilities-animation.html"
                                >Animations</a
                            >
                            <a class="collapse-item" href="utilities-other.html"
                                >Other</a
                            >
                        </div>
                    </div>
                </li> -->

                <!-- Divider -->
                <!-- <hr class="sidebar-divider" /> -->

                <!-- Heading -->
                <!-- <div class="sidebar-heading">
                    Addons
                </div> -->

                <!-- Nav Item - Pages Collapse Menu -->
                <!-- <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapsePages"
                        aria-expanded="true"
                        aria-controls="collapsePages"
                    >
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div
                        id="collapsePages"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Login Screens:</h6>
                            <a class="collapse-item" href="login.html">Login</a>
                            <a class="collapse-item" href="register.html"
                                >Register</a
                            >
                            <a class="collapse-item" href="forgot-password.html"
                                >Forgot Password</a
                            >
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Other Pages:</h6>
                            <a class="collapse-item" href="404.html"
                                >404 Page</a
                            >
                            <a class="collapse-item" href="blank.html"
                                >Blank Page</a
                            >
                        </div>
                    </div>
                </li> -->

                <!-- Nav Item - Charts -->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Charts</span></a
                    >
                </li> -->

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Questions</span></a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Users</span></a
                    >
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block" />

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button
                        class="rounded-circle border-0"
                        id="sidebarToggle"
                    ></button>
                </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav
                        class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
                    >
                        <!-- Sidebar Toggle (Topbar) -->
                        <button
                            id="sidebarToggleTop"
                            class="btn btn-link d-md-none rounded-circle mr-3"
                        >
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        >
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control bg-light border-0 small"
                                    placeholder="Search for..."
                                    aria-label="Search"
                                    aria-describedby="basic-addon2"
                                />
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-primary"
                                        type="button"
                                    >
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="searchDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div
                                    class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown"
                                >
                                    <form
                                        class="form-inline mr-auto w-100 navbar-search"
                                    >
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control bg-light border-0 small"
                                                placeholder="Search for..."
                                                aria-label="Search"
                                                aria-describedby="basic-addon2"
                                            />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-primary"
                                                    type="button"
                                                >
                                                    <i
                                                        class="fas fa-search fa-sm"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="alertsDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span
                                        class="badge badge-danger badge-counter"
                                        >3+</span
                                    >
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div
                                    class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown"
                                >
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i
                                                    class="fas fa-file-alt text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 12, 2019
                                            </div>
                                            <span class="font-weight-bold"
                                                >A new monthly report is ready
                                                to download!</span
                                            >
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i
                                                    class="fas fa-donate text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 7, 2019
                                            </div>
                                            $290.29 has been deposited into your
                                            account!
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i
                                                    class="fas fa-exclamation-triangle text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 2, 2019
                                            </div>
                                            Spending Alert: We've noticed
                                            unusually high spending for your
                                            account.
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item text-center small text-gray-500"
                                        href="#"
                                        >Show All Alerts</a
                                    >
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messagesDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span
                                        class="badge badge-danger badge-counter"
                                        >7</span
                                    >
                                </a>
                                <!-- Dropdown - Messages -->
                                <div
                                    class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown"
                                >
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="https://source.unsplash.com/fn_BT9fwg_E/60x60"
                                                alt=""
                                            />
                                            <div
                                                class="status-indicator bg-success"
                                            ></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">
                                                Hi there! I am wondering if you
                                                can help me with a problem I've
                                                been having.
                                            </div>
                                            <div class="small text-gray-500">
                                                Emily Fowler · 58m
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="https://source.unsplash.com/AU4VPcFN4LE/60x60"
                                                alt=""
                                            />
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                I have the photos that you
                                                ordered last month, how would
                                                you like them sent to you?
                                            </div>
                                            <div class="small text-gray-500">
                                                Jae Chun · 1d
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="https://source.unsplash.com/CS2uCrpNzJY/60x60"
                                                alt=""
                                            />
                                            <div
                                                class="status-indicator bg-warning"
                                            ></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                Last month's report looks great,
                                                I am very happy with the
                                                progress so far, keep up the
                                                good work!
                                            </div>
                                            <div class="small text-gray-500">
                                                Morgan Alvarez · 2d
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt=""
                                            />
                                            <div
                                                class="status-indicator bg-success"
                                            ></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                Am I a good boy? The reason I
                                                ask is because someone told me
                                                that people say this to all
                                                dogs, even if they aren't
                                                good...
                                            </div>
                                            <div class="small text-gray-500">
                                                Chicken the Dog · 2w
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item text-center small text-gray-500"
                                        href="#"
                                        >Read More Messages</a
                                    >
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="userDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small"
                                        >Valerie Luna</span
                                    >
                                    <img
                                        class="img-profile rounded-circle"
                                        src="https://source.unsplash.com/QAB-WJcbgJk/60x60"
                                    />
                                </a>
                                <!-- Dropdown - User Information -->
                                <div
                                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown"
                                >
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#logoutModal"
                                    >
                                        <i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div
                            class="d-sm-flex align-items-center justify-content-between mb-4"
                        >
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#exampleModal"
                            >
                                <?php echo "Add Mockup" ?>
                            </button>

                            <div
                                class="modal"
                                id="exampleModal"
                                tabindex="-1"
                                role="dialog"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true"
                            >
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5
                                                class="modal-title"
                                                id="exampleModalLabel"
                                            >
                                                Add mockup
                                            </h5>
                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close"
                                            >
                                                <span aria-hidden="true"
                                                    >&times;</span
                                                >
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                       
                                           <form class="form-horizontal" method="post" action="config/actions.php">
                                               <div class="form-group">
                                                   <!-- Email -->
                                                   <label
                                                       for="email_id "
                                                       class="control-label font-weight-bold ml-3"
                                                       >Name</label
                                                   >
                                                   <div class="col-sm-10">
                                                       <input
                                                           type="text"
                                                           class="form-control"
                                                           id="email_id"
                                                           name="mockup_name"
                                                           placeholder="Test 123"
                                                           required
                                                       />
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label
                                                       for="full_name_id"
                                                       class="control-label  ml-3 font-weight-bold"
                                                       >Type</label
                                                   >
                                                   <div class="col-sm-10">
                                                       <select
                                                           class="form-control"
                                                           id="exampleFormControlSelect1"
                                                           name="mockup_type"
                                                           required
                                                       >
                                                           <option
                                                           value="0"
                                                               >Free</option
                                                           >
                                                           <option
                                                           value="1"
                                                               >Paid</option
                                                           >
                                                           
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <!-- Full Name -->
                                                   <label
                                                       for="full_name_id"
                                                       class="control-label  ml-3 font-weight-bold"
                                                       >Cost ( If paid )</label
                                                   >
                                                   <div class="col-sm-10">
                                                       <input
                                                           type="number"
                                                           class="form-control"
                                                           id="full_name_id"
                                                           name="mockup_price"
                                                           placeholder="price"
                                                       />
                                                   </div>
                                               </div>
                                              
                                               <hr />
                                              

                                               <div class="form-group">
                                                   <!-- Submit Button -->
                                                   <div
                                                       class="col-sm-10 col-sm-offset-2"
                                                   >
                                                       <button
                                                           type="submit"
                                                           class="btn btn-primary"
                                                           name="add-mockup"
                                                       >
                                                           Add Mockup
                                                       </button>
                                                   </div>
                                               </div>
                                           </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ----------------------------------------- ROW 1 start--------------------------------------- -->
                        <div class="row">
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card border-left-primary shadow h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row no-gutters align-items-center"
                                        >
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-primary text-uppercase mb-1"
                                                >
                                                    Select Test
                                                </div>
                                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div> -->
                                                <div class="dropdown">
                                                    <button
                                                        class="btn btn-primary dropdown-toggle"
                                                        type="button"
                                                        id="dropdownMenuButton"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                    >
                                                        Select Mockup
                                                    </button>
                                                    <div
                                                        class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton"
                                                    >

                                                    <?php

                                                    foreach($mockups as $x) {
                                                      echo "<a class='dropdown-item' href='index.php?id=". $x["id"]. "'
                                                          >". $x["name"]."</a
                                                      >";
                                                    }

                                                    ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i
                                                    class="fas fa-calendar fa-2x text-gray-300"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card border-left-success shadow h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row no-gutters align-items-center"
                                        >
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                                >
                                                    Number of questions
                                                </div>
                                                <div
                                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                                >
                                                    15
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                                <i
                                                    class="fas fa-question-circle fa-2x text-gray-300"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card border-left-success shadow h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row no-gutters align-items-center"
                                        >
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1"
                                                >
                                                    Number of student ateempts
                                                </div>
                                                <div
                                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                                >
                                                    200
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                                                <i
                                                    class="fas fa-user-alt fa-2x text-gray-300"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Requests Card Example -->
                            <div class="col-xl-3 col-md-6 mb-4">
                                <div
                                    class="card border-left-warning shadow h-100 py-2"
                                >
                                    <div class="card-body">
                                        <div
                                            class="row no-gutters align-items-center"
                                        >
                                            <div class="col mr-2">
                                                <div
                                                    class="text-xs font-weight-bold text-warning text-uppercase mb-1"
                                                >
                                                    Total Payments
                                                </div>
                                                <div
                                                    class="h5 mb-0 font-weight-bold text-gray-800"
                                                >
                                                    1000
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i
                                                    class="fas fa-rupee-sign fa-2x text-gray-300"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------------- ROW 1 end --------------------------------------- -->

                        <!-- ----------------------------------------- ROW 2 start--------------------------------------- -->
                        <div class="row">
                            <!-- Area Chart -->
                            <div class="col-xl-8 col-lg-7 mb-4">
                                <div class="card shadow">
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                    >
                                        <h6
                                            class="m-0 font-weight-bold text-primary"
                                        >
                                            Add questions
                                        </h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" action="config/actions.php">
                                            <div class="form-group">
                                                <label
                                                    for="full_name_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Select mockup</label
                                                >
                                                <div class="col-sm-10">
                                                    <select
                                                        class="form-control"
                                                        id="exampleFormControlSelect1"
                                                        name="mockup"
                                                    >

                                                    <?php
                                                    
                                                    foreach($mockups as $x) {
                                                      echo "<option value='". $x["id"]. "'
                                                          >". $x["name"]."</option
                                                      >";
                                                    }
                                                    
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Full Name -->
                                                <label
                                                    for="full_name_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Question Name</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="full_name_id"
                                                        name="name"
                                                        placeholder="John Deer"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Full Name -->
                                                <label
                                                    for="full_name_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Mark</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        id="full_name_id"
                                                        name="mark"
                                                        
                                                    />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <!-- Email -->
                                                <label
                                                    for="email_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Choice 1</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="email_id"
                                                        name="choice_1"
                                                        placeholder="Choice 1"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Email -->
                                                <label
                                                    for="email_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Choice 2</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="email_id"
                                                        name="choice_2"
                                                        placeholder="Choice 2"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Email -->
                                                <label
                                                    for="email_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Choice 3</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="email_id"
                                                        name="choice_3"
                                                        placeholder="Choice 3"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Email -->
                                                <label
                                                    for="email_id"
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Choice 4</label
                                                >
                                                <div class="col-sm-10">
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="email_id"
                                                        name="choice_4"
                                                        placeholder="Choice 4"
                                                        required
                                                    />
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group">
                                                <!-- Frequency Field -->
                                                <label
                                                    class="control-label col-sm-2 font-weight-bold"
                                                    >Correct answer</label
                                                >
                                                <div class="col-sm-10">
                                                    <div class="radio">
                                                        <label class="radio">
                                                            <input
                                                                type="radio"
                                                                value="1"
                                                                name="correct_choice"
                                                                required
                                                                checked
                                                            />
                                                            choice 1
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="radio">
                                                            <input
                                                                type="radio"
                                                                value="2"
                                                                name="correct_choice"
                                                            />
                                                            choice 2
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="radio">
                                                            <input
                                                                type="radio"
                                                                value="3"
                                                                name="correct_choice"
                                                            />
                                                            choice 3
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label class="radio">
                                                            <input
                                                                type="radio"
                                                                value="4"
                                                                name="correct_choice"
                                                            />
                                                            choice 4
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <!-- Submit Button -->
                                                <div
                                                    class="col-sm-10 col-sm-offset-2"
                                                >
                                                    <button
                                                        type="submit"
                                                        class="btn btn-primary"
                                                        name="add-question"
                                                    >
                                                        Add Question
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5 mb-4">
                                <div class="card shadow fullHeight">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
                                    >
                                        <h6
                                            class="m-0 font-weight-bold text-primary"
                                        >
                                            Question Info
                                        </h6>
                                        <div class="dropdown no-arrow">
                                            <a
                                                class="dropdown-toggle"
                                                href="#"
                                                role="button"
                                                id="dropdownMenuLink"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                            >
                                                <i
                                                    class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"
                                                ></i>
                                            </a>
                                            <div
                                                class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                                aria-labelledby="dropdownMenuLink"
                                            >
                                                <div class="dropdown-header">
                                                    Dropdown Header:
                                                </div>
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Action</a
                                                >
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Another action</a
                                                >
                                                <div
                                                    class="dropdown-divider"
                                                ></div>
                                                <a
                                                    class="dropdown-item"
                                                    href="#"
                                                    >Something else here</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body fullHeight center">
                                        <div>
                                            <h3>
                                                Total number of question added :
                                            </h3>
                                            <h1
                                                class="text-center text-primary"
                                            >
                                                100
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ----------------------------------------- ROW 2 end --------------------------------------- -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ready to Leave?
                        </h5>
                        <button
                            class="close"
                            type="button"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your
                        current session.
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <a class="btn btn-primary" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        
<?php include 'includes/footer.php'; ?>
