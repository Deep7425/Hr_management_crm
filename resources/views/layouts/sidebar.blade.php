<!--sidebar wrapper -->


<?php
use App\Models\EmployeeProject;
use App\Models\Project;
use App\Models\Task;
 

    use App\Models\User;
    $login_user_data = auth()->user();
	$data = Project::all();
	$data = Task::all();
	$data['project_name'] = $data;
	$data['task'] = $data;
?>
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <!--div>
			<img src="{{ URL::asset('images/logo.webp')}}" class="logo-icon" alt="logo icon">
		</div-->
        <div>
            <h4 class="logo-text"><img src="{{ URL::asset('images/logo.webp')}}" alt="logo icon" style="width: 150px;"></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li class="{{ (Request::is('admin/home/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.home') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if($login_user_data->user_type != 7)
        @if($login_user_data->user_type != 4)
        @if($login_user_data->user_type == 2)
        <li class="{{ (Request::is('admin/candidate/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.candidate.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Profile Data</div>
            </a>
        </li>
        <!-- <li class="{{ (Request::is('admin/currentEmployee/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.currentEmployee.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Current Employee Manager</div>
            </a>
        </li> -->
        @endif

        @if($login_user_data->user_type == 3)


        <li class="{{ (Request::is('admin/invoices/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.invoices.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Invoice Manager</div>
            </a>
        </li>

        <li class="{{ (Request::is('admin/projectss/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.projectss.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">My Projects</div>
            </a>
        </li>

        @endif
        @if($login_user_data->user_type != 3)
        @if($login_user_data->user_type != 2)
        <li class="{{ (Request::is('admin/hradmin/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.hradmin.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">HR Manager</div>
            </a>
        </li>
        <li class="{{ (Request::is('admin/hiringadmin/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.hiringadmin.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Hiring Manager</div>
            </a>
        </li>
        <li class="{{ (Request::is('admin/leadManager/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.leadManager.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Lead Manager</div>
            </a>
        </li>


        <!-- <li class="{{ (Request::is('admin/enquiry/*') ? 'mm-active':'') }}">
			<a href="{{ route('admin.enquiry.index') }}">
				<div class="parent-icon"><i class="bx bx-user"></i>
				</div>
				<div class="menu-title">Enquiries</div>
			</a>
			</li> -->
        <!-- <li class="{{ (Request::is('admin/contacts/*') ? 'mm-active':'') }}">
			<a href="{{ route('admin.contacts.index') }}">
				<div class="parent-icon"><i class="bx bx-user"></i>
				</div>
				<div class="menu-title">Contact Management</div>
			</a>
			</li> -->
        <li class="{{ (Request::is('admin/prospects/*') ? 'mm-active':'') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Prospects</div>
            </a>
            <ul>
                <li class="{{ (Request::is('admin/prospects/lead-dashboard/*') ? 'mm-active':'') }}"> <a href="{{ route('admin.lead-dashboard.index') }}"><i class="bx bx-right-arrow-alt"></i>Lead Dashboard</a>
                </li>
                <li class="{{ (Request::is('admin/prospects/enquiry/*') ? 'mm-active':'') }}"> <a href="{{ route('admin.enquiry.index') }}"><i class="bx bx-right-arrow-alt"></i>Enquiries</a>
                </li>
                <li class="{{ (Request::is('admin/contacts/*') ? 'mm-active':'') }}"> <a href="{{ route('admin.contacts.index') }}"><i class="bx bx-right-arrow-alt"></i>Contact Management</a>
                </li>
            </ul>
        </li>

        <li class="{{ (Request::is('admin/invoices/*') || (Request::is('admin/bank/*'))  ? 'mm-active':'') }}">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Invoice </div>
            </a>
            <ul>
				<li class="{{ (Request::is('admin/clients/*') ? 'mm-active':'') }}">
					<a href="{{ route('admin.clients.index') }}">
						<i class="bx bx-right-arrow-alt"></i>Clients Manager
					</a>
				</li>

                <li class="{{ (Request::is('admin/currentEmployee/*') ? 'mm-active':'') }}">
                    <a href="{{ route('admin.currentEmployee.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>Employee Manager
                    </a>
                </li>
				<li class="{{ (Request::is('admin/projects/*') ? 'mm-active':'') }}">
					<a href="{{ route('admin.projects.index') }}">
						<i class="bx bx-right-arrow-alt"></i>Projects Manager
					</a>
				</li>

                <li class="{{ (Request::is('admin/department/*') ? 'mm-active':'') }}">
				<a href="{{ route('admin.department.index') }}">
						<i class="bx bx-right-arrow-alt"></i>Department Manager
					</a>
				</li>
                
                <li class="{{ (Request::is('admin/technology/*') ? 'mm-active':'') }}">
				<a href="{{ route('admin.technology.index') }}">
						<i class="bx bx-right-arrow-alt"></i>Technology Manager
					</a>
				</li>


                <li class="{{ (Request::is('admin/bank/*') ? 'mm-active':'') }}"> 
                    <a href="{{ route('admin.bank.index') }}"><i class="bx bx-right-arrow-alt"></i>Bank Manager</a>
                </li>


                <li class="{{ (Request::is('admin/invoices/*') ? 'mm-active':'') }}">
                     <a href="{{ route('admin.invoices.index') }}"><i class="bx bx-right-arrow-alt"></i>Invoice Manager</a>
                </li>

            </ul>
        </li>


        @endif
        @endif
        @endif

        @if($login_user_data->user_type == 4)
        <li class="{{ (Request::is('admin/employeeProjects/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.employeeProjects') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Employee Projects</div>
            </a>
        </li>
        <li class="{{ (Request::is('admin/employeeProjects/employeeTask/*') ? 'mm-active':'') }}">
            @foreach($data['project_name'] as $data)
            <a href="{{url('admin/employeeProjects/employeeTask/'.$data->id)}}" title="view" class="btn btn-primary btn-xs edit_btn">{{ $data->project_name}}</a>
            @endforeach
        </li>

        @endif
        @endif
        @if($login_user_data->user_type == 7)
        <li class="{{ (Request::is('admin/contacts/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.contacts.index') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Contact Management</div>

            </a>
            <a href="{{ route('admin.extracts.index') }}">
                <div class="parent-icon"><i class="bx bx-show"></i>
                </div>
                <div class="menu-title">Extract List</div>

            </a>
            @if($login_user_data->user_type == 7)
        <li class="{{ (Request::is('admin/contacts-lead/*') ? 'mm-active':'') }}">
            <a href="{{ route('admin.lead-dashboard.contactsLeadIndex') }}">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Lead Dashboard</div>
            </a>
        </li>
        </li>
        @endif
        @endif

    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
<script>
    $(document).ready(function() {
        $('.has-arrow').on('click', function(e) {
            $(".collapse").css({
                'display': ''
            });
            $(".collapse").removeClass("in");
        });
    });

</script>
