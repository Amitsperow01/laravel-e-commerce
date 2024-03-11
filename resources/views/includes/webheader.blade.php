 <!-- Start Top Search -->
 <div class="top-search">
     <div class="container">
         <div class="input-group">
             <span class="input-group-addon"><i class="fa fa-search"></i></span>
             <input type="text" class="form-control" placeholder="Search">
             <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
         </div>
     </div>
 </div>
 <!-- End Top Search -->
 <div class="main-top">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 <div class="text-slid-box">
                    
                 </div>
             </div>
             <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                 
                 <div class="right-phone-box">
                     <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                 </div>
                 <div class="our-link">
                     <ul>
                         @guest
                             <li><i class="fa-solid fa fa-user" style="color: #eeeeec;"></i><a
                                     href="{{ route('customer.login') }}">Sign IN</a></li>
                             <li><i class="fa-solid fa fa-user" style="color: #eeeeec;"></i><a
                                     href="{{ route('customer.create') }}">Sign Up</a></li>

                         @endguest
                         @auth
                             <li><i class="fa-solid fa fa-user" style="color: #eeeeec;"></i><a
                                     href="{{ route('customer.profile') }}">My Account</a></li>
                             {{-- <li><i class="fa-solid fa fa-user" style="color: #eeeeec;"></i><a href="{{ route('customer.logout') }}">Logout</a></li> --}}
                             <a href="{{ route('customer.logout') }}"
                                 onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i
                                     class="fa-solid fa fa-user"></i> Logout</a>
                             <form id="logout-form" action="{{ route('customer.logout') }}" method="POST">
                                 @csrf
                             </form>
                         @endauth
                         {{-- <li><a href="#">Our location</a></li> --}}
                         <li><a href="{{ route('contact') }}">Contact Us</a></li>
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </div>
