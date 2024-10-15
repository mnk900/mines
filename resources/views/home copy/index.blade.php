@extends('layouts.appHome')
@section('content')
<!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="slider-imgs w-100" src="img/food.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Food Sovereignty</h6>
                                <p class="text-white mb-4 animated slideInDown">PKRC in Pakistan empowers local communities to control their food systems, ensuring access to nutritious and culturally appropriate food while promoting sustainable agricultural practices</p>
                                <a href="" class="btn btn-info text-white py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="slider-imgs w-100" src="img/land.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Land Reforms</h6>
                                <p class="text-white mb-4 animated slideInDown">PKRC in Pakistan aim to address issues of land distribution, enhance agricultural productivity, and promote socio-economic equity through measures such as land redistribution and tenancy reforms</p>
                                <a href="" class="btn btn-info text-white py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
					<div class="carousel-item">
                        <img class="slider-imgs w-100" src="img/climate.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Climate Justice</h6>
                                <p class="text-white mb-4 animated slideInDown">PKRC in Pakistan demands equitable and inclusive solutions to address the impacts of climate change, ensuring the most vulnerable communities are safeguarded and empowered</p>
                                <a href="" class="btn btn-info text-white py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
					<div class="carousel-item">
                        <img class="slider-imgs w-100" src="img/fossil.jpg" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Fossil Fuels</h6>
                                <p class="text-white mb-4 animated slideInDown">PKRC in Pakistan aims to address the dual challenge of harnessing Pakistan's abundant fossil fuel resources for economic growth while navigating the imperative for sustainable energy solutions to address environmental concerns.</p>
                                <a href="" class="btn btn-info text-white py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->


        <!-- Booking Start -->
        <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container bg-info shadow">
                <div class="" style="padding: 30px;">
                    <div class="row g-2">
							<div class="text-white text-center ticker_wrap">
							  <div class="ticker__breaking"> Latest News: </div>
							  <div class="ticker__viewport">
								<ul class="ticker__list" data-ticker="list">
									<li class="ticker__item" data-ticker="item"><a href="javascrit:void(0)"><i class="fa fa-star"></i> Swedish Mechanics Are Fighting Tesla for Union Rights </a></li>
									<li class="ticker__item" data-ticker="item"><i class="fa fa-star"></i>Is the UAW strike a watershed moment for worker militancy?</li>
									<li class="ticker__item" data-ticker="item"><i class="fa fa-star"></i>Gig Workers' First Major Victory in India: Rajasthan Leads the Way </li>
								</ul>
							</div>
							</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking End -->


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
					<h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                        <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">PKRC</span></h1>
                        <p class="mb-4">PKRC is a network of 26 small peasant organisations in Pakistan. It became a member of La Via Campesina in 2017, the only Pakistani peasant organisation that is a member of this international platform. </p>
                        <div class="row g-3 pb-4">
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-cookie fa-2x text-info mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">12</h2>
                                        <p class="mb-0">Countries </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-globe fa-2x text-info mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">345</h2>
                                        <p class="mb-0">Volunteers </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="border rounded p-1">
                                    <div class="border rounded text-center p-4">
                                        <i class="fa fa-water fa-2x text-info mb-2"></i>
                                        <h2 class="mb-1" data-toggle="counter-up">10,000</h2>
                                        <p class="mb-0">Community </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-info py-3 px-5 mt-2" href="">Read More</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-3">
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="img/pkrc/1.jpg" style="margin-top: 25%;">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="img/pkrc/2.jpg">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="img/pkrc/3.jpg">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="img/pkrc/4.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Room Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">What <span class="text-info text-uppercase">We Do</span></h1>
					<p class="mb-4">As a network of peasants, farmers and grass-roots organisations in Pakistan, PKRC does research and advocacy on following themes:</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="whatwedo-img img-fluid" src="img/pkrc/14.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-info text-white rounded py-1 px-3 ms-4">Theme</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Food Sovereignty</h5>

                                </div>

                                <p class="text-body mb-3">PKRC in Pakistan empowers local communities to control their food systems, ensuring access to nutritious and culturally appropriate food while promoting sustainable agricultural practices...</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info rounded py-2 px-4" href="">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="whatwedo-img img-fluid" src="img/pkrc/8.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-info text-white rounded py-1 px-3 ms-4">Theme</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Land Reforms</h5>
                                </div>
                                <p class="text-body mb-3">PKRC in Pakistan aim to address issues of land distribution, enhance agricultural productivity, and promote socio-economic equity through measures such as land redistribution... </p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info rounded py-2 px-4" href="">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="whatwedo-img img-fluid" src="img/pkrc/17.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-info text-white rounded py-1 px-3 ms-4">Theme</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Climate Justice</h5>
                                </div>
                                <p class="text-body mb-3">PKRC in Pakistan demands equitable and inclusive solutions to address the impacts of climate change, ensuring the most vulnerable communities are safeguarded and...</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info rounded py-2 px-4" href="">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="whatwedo-img img-fluid" src="img/pkrc/7.jpg" alt="">
                                <small class="position-absolute start-0 top-100 translate-middle-y bg-info text-white rounded py-1 px-3 ms-4">Theme</small>
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Fossil Fuels</h5>
                                </div>
                                <p class="text-body mb-3">PKRC in Pakistan aims to address the dual challenge of harnessing Pakistan's abundant fossil fuel resources for economic growth while navigating the imperative for sustainable...</p>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-sm btn-info rounded py-2 px-4" href="">View Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Room End -->


        <!-- Video Start -->
        <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5">
                        <h6 class="section-title text-start text-white text-uppercase mb-3">Our Vision</h6>
                        <h1 class="text-white mb-4">BALANCING GROWTH AND GREEN IN PAKISTAN</h1>
                        <p class="text-white mb-4">At Pakistan Kissan Rabta Committee, our vision is a united and empowered farming community. We strive to champion farmers' rights, foster collaboration, and promote sustainable practices, envisioning a resilient and prosperous agricultural sector that contributes significantly to Pakistan's overall development.</p>
                        <a href="" class="btn btn-info py-md-3 px-md-5 me-3">Read More</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start -->


        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">Our <span class="text-info text-uppercase">Projects</span></h1>
					<p class="mb-4">Pakistan Kissan Rabta Committee offers a holistic range of projects, advocating for fair policies, providing financial assistance, and promoting sustainable practices. Our commitment to education, community building, and market access reflects our dedication to empowering farmers and ensuring the long-term prosperity of Pakistan's agriculture</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-cookie fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Advocacy and Policy Support</h5>
                            <p class="text-body mb-0">Providing a strong voice for farmers, advocating for their rights, and actively engaging with policymakers to shape agricultural policies that promote fairness and sustainability.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-home fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Education and Training</h5>
                            <p class="text-body mb-0">Offering educational programs and training sessions to empower farmers with knowledge of modern agricultural practices, technologies, and efficient farming methods. </p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-database fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Community Building and Networking</h5>
                            <p class="text-body mb-0">Fostering a sense of community among farmers through networking events, workshops, and collaborative initiatives, promoting mutual support and shared learning experiences.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-book fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Environmental Stewardship Programs</h5>
                            <p class="text-body mb-0">Promoting sustainable farming practices, environmental awareness, and conservation efforts to ensure the long-term health of the land and resources for future generations.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-globe fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Market Access and Value Chain Integration</h5>
                            <p class="text-body mb-0">Facilitating market linkages, connecting farmers with potential buyers, and promoting value chain integration to enhance the economic viability of agricultural activities and ensure fair returns for farmers.</p>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                        <a class="service-item rounded" href="">
                            <div class="service-icon bg-transparent border rounded p-1">
                                <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                    <i class="fa fa-dumbbell fa-2x text-info"></i>
                                </div>
                            </div>
                            <h5 class="mb-3">Consultancy Provision</h5>
                            <p class="text-body mb-0">Our highly skilled and professional team can provide consultancies on construction related projects</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->





        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Our <span class="text-info text-uppercase">Team</span></h1>
					<p class="mb-4">We are a group of activists, academics and grass roots leaders committed to long-term reform and sustainability practices in Pakistan’s agriculture and climate change issues.</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="rounded shadow overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/pkrc/team2.jpg" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Zeghum Abbas</h5>
                                <small>CEO</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="rounded shadow overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/pkrc/team2.jpg" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Zeghum Abbas</h5>
                                <small>Research Analyst</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="rounded shadow overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/pkrc/team2.jpg" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Zeghum Abbas</h5>
                                <small>Program Specialist</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="rounded shadow overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/pkrc/team2.jpg" alt="">
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-info mx-1" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Zeghum Abbas</h5>
                                <small>Industry Specialist</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
@endsection


