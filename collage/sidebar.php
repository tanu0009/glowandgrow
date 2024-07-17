    <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;" data-position="right" class="navbar-default navbar-static-side">

        <div class="sidebar-collapse menu-scroll">

            <ul id="side-menu" class="nav">

				<div class="clearfix"></div>

                <li><a href="index.php"><i class="fa fa-home fa-fw"></i><span class="menu-title">Dashboard</span></a></li>
                
                        
                     <?php if($_SESSION['XDESIG']=='ADIM'){ ?>                 
                                                
                	<li>
						<a href="javascript:void(0);"><i class="fa fa-tasks fa-fw"></i> Master<span class="fa arrow"></span></a>

						<ul class="nav nav-second-level">
                     <div class="clearfix"></div> 
                    <li>
                        <a href="student.php"><i class="fa fa-minus fa-fw"></i><span class="menu-title"> Student</span></a>
                    </li>
                    
                    <li>
                        <a href="teacher.php"><i class="fa fa-minus fa-fw"></i><span class="menu-title"> Teacher</span></a>
                    </li>

                  
					</ul>

                    </li>
                    
                    <li>
						<a href="javascript:void(0);"><i class="fa fa-tasks fa-fw"></i> Form<span class="fa arrow"></span></a>

						<ul class="nav nav-second-level">
                     <div class="clearfix"></div> 
                    <li>
                        <a href="project.php"><i class="fa fa-minus fa-fw"></i><span class="menu-title"> Project</span></a>
                    </li>
                   
                      
                    
                    </ul>
				    </li>
                    
                    <!--<li>
						<a href="javascript:void(0);"><i class="fa fa-file fa-fw"></i> Reports<span class="fa arrow"></span></a>

						<ul class="nav nav-second-level">
                     <div class="clearfix"></div> 
                    <li><a href="javascript:void(0);"><i class="fa fa-minus fa-fw"></i><span class="menu-title"> Sample report</span></a></li>
                    
                   
                </ul>

                    </li>-->
                    <?php }?>
                    <?php if($_SESSION['XDESIG']=='s'){ ?>
                    
                    <li><a href="student.php"><i class="fa fa-user fa-fw"></i><span class="menu-title">Student</span></a></li>
                    
                    <li><a href="project.php"><i class="fa fa-tasks fa-fw"></i><span class="menu-title">Project</span></a></li>
                    <?php }?>
                <li><a href="logout.php?action=logout_user_session&user=<?php echo $_SESSION['XUSRNM']?>"><i class="fa fa-sign-out fa-fw"></i><span class="menu-title">Logout</span></a></li>

             </ul>

        </div>

    </nav>