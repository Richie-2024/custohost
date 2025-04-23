<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CustoHost- Modern Hostel Management</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Poppins', 'sans-serif'],
                },
                extend: {
                    colors: {
                        primary: tailwind.colors.sky[500],    // Sky blue
                        secondary: '#f59e0b',  // Amber
                        accent: '#ec4899',     // Pink
                        teal: '#14b8a6',       // Teal
                        dark: '#1e293b',       // Dark slate
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-text {
            background: linear-gradient(45deg, #3b82f6, #ec4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .room-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .testimonial-card {
            transition: all 0.3s ease;
        }
        .testimonial-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .feature-icon {
            transition: all 0.3s ease;
        }
        .feature-card:hover .feature-icon {
            transform: rotateY(180deg);
            background-color: #3b82f6 !important;
            color: white !important;
        }
        .stats-counter {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(45deg, #3b82f6, #ec4899);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <!-- Sticky Navbar -->
    <nav class="navbar bg-sky-500 text-white py-3 sticky top-0 z-50 shadow-md animate__animated animate__fadeInDown">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <i class="fas fa-home text-2xl"></i>
                <span class="font-bold text-2xl">Hostel<span class="text-amber-300">Hub</span></span>
            </div>
            
            <!-- Desktop Navigation -->
            <ul class="hidden md:flex space-x-8 items-center">
                <li><a href="#home" class="nav-link hover:text-amber-300 transition">Home</a></li>
                <li><a href="#features" class="nav-link hover:text-amber-300 transition">Features</a></li>
                <li><a href="#rooms" class="nav-link hover:text-amber-300 transition">Rooms</a></li>
                <li><a href="#facilities" class="nav-link hover:text-amber-300 transition">Facilities</a></li>
                <li><a href="#pricing" class="nav-link hover:text-amber-300 transition">Pricing</a></li>
                <li><a href="#testimonials" class="nav-link hover:text-amber-300 transition">Testimonials</a></li>
                <li><a href="#faq" class="nav-link hover:text-amber-300 transition">FAQ</a></li>
                <li>
                    <a href="{{route('login')}}" class="bg-amber-400 hover:bg-amber-500 text-white px-6 py-2 rounded-full font-semibold ml-4 transition animate__animated animate__pulse animate__infinite">
                        Account <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </li>
            </ul>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white focus:outline-none" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden bg-sky-600 md:hidden px-6 pb-4">
            <ul class="space-y-3">
                <li><a href="#home" class="block py-2 hover:text-amber-300 transition">Home</a></li>
                <li><a href="#features" class="block py-2 hover:text-amber-300 transition">Features</a></li>
                <li><a href="#rooms" class="block py-2 hover:text-amber-300 transition">Rooms</a></li>
                <li><a href="#facilities" class="block py-2 hover:text-amber-300 transition">Facilities</a></li>
                <li><a href="#pricing" class="block py-2 hover:text-amber-300 transition">Pricing</a></li>
                <li><a href="#testimonials" class="block py-2 hover:text-amber-300 transition">Testimonials</a></li>
                <li><a href="#faq" class="block py-2 hover:text-amber-300 transition">FAQ</a></li>
            </ul>
            <div class="mt-4">
                <a href="#apply" class="bg-amber-400 hover:bg-amber-500 text-white px-6 py-2 rounded-full font-semibold inline-block w-full text-center transition">
                    Book Now
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center text-white pt-20 pb-10 parallax" 
             style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80');">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0 animate__animated animate__fadeInLeft">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                        Your <span class="gradient-text">Perfect</span> Student Accommodation
                    </h1>
                    <p class="text-xl mb-8 text-gray-200">Modern, Secure, and Vibrant Living Spaces Designed for Academic Success</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                            <i class="fas fa-shield-alt text-sky-400 mr-3 text-xl"></i>
                            <span>24/7 Security</span>
                        </div>
                        <div class="flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                            <i class="fas fa-wifi text-sky-400 mr-3 text-xl"></i>
                            <span>High-Speed Wi-Fi</span>
                        </div>
                        <div class="flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                            <i class="fas fa-utensils text-sky-400 mr-3 text-xl"></i>
                            <span>Healthy Meals</span>
                        </div>
                        <div class="flex items-center bg-white bg-opacity-10 p-3 rounded-lg">
                            <i class="fas fa-dumbbell text-sky-400 mr-3 text-xl"></i>
                            <span>Fitness Center</span>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="{{route('login')}}" class="bg-sky-500 hover:bg-sky-600 text-white px-8 py-3 rounded-full font-bold transition duration-300 transform hover:scale-105">
                            Book Your Room <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#video-tour" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-full font-bold transition duration-300 hover:bg-white hover:text-sky-500">
                            <i class="fas fa-play mr-2"></i> Watch Tour
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 animate__animated animate__fadeInRight animate__delay-1s">
                    <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-sm border border-gray-300 border-opacity-20">
                        <h3 class="text-2xl font-bold mb-4">Check Availability</h3>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-gray-200 mb-2">Room Type</label>
                                <select class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-gray-300 border-opacity-20 text-white">
                                    <option>Standard Single</option>
                                    <option>Deluxe AC Room</option>
                                    <option>Shared Suite</option>
                                    <option>Premium Studio</option>
                                </select>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-200 mb-2">Check-In</label>
                                    <input type="date" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-gray-300 border-opacity-20 text-white">
                                </div>
                                <div>
                                    <label class="block text-gray-200 mb-2">Check-Out</label>
                                    <input type="date" class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-10 border border-gray-300 border-opacity-20 text-white">
                                </div>
                            </div>
                            <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Check Availability
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="animate__animated animate__fadeInUp">
                    <div class="stats-counter">1,250+</div>
                    <p class="text-gray-600">Happy Students</p>
                </div>
                <div class="animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="stats-counter">98%</div>
                    <p class="text-gray-600">Satisfaction Rate</p>
                </div>
                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="stats-counter">24/7</div>
                    <p class="text-gray-600">Support Available</p>
                </div>
                <div class="animate__animated animate__fadeInUp animate__delay-3s">
                    <div class="stats-counter">15+</div>
                    <p class="text-gray-600">Years Experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">Why Choose CustoHost?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">We provide everything you need for comfortable living and academic success</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-amber-100 text-amber-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Advanced Security</h3>
                    <p class="text-gray-600">24/7 CCTV surveillance, biometric access, and security personnel ensure your safety at all times.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-sky-100 text-sky-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">High-Speed Internet</h3>
                    <p class="text-gray-600">Fiber optic internet with 500 Mbps speeds and dedicated study network for uninterrupted learning.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-teal-100 text-teal-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Healthy Dining</h3>
                    <p class="text-gray-600">Nutritious meals prepared by professional chefs with options for all dietary requirements.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-purple-100 text-purple-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-book"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Study Facilities</h3>
                    <p class="text-gray-600">Quiet study rooms, group discussion areas, and 24/7 access to computer labs.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-pink-100 text-pink-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Fitness Center</h3>
                    <p class="text-gray-600">Fully equipped gym, yoga studio, and regular fitness classes to keep you active.</p>
                </div>
                
                <div class="feature-card bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition duration-300">
                    <div class="feature-icon bg-green-100 text-green-500 w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Community Events</h3>
                    <p class="text-gray-600">Regular social events, workshops, and networking opportunities to build connections.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Tour Section -->
    <section id="video-tour" class="py-16 bg-sky-500 text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <h2 class="text-4xl font-bold mb-6">Take a Virtual Tour</h2>
                    <p class="text-xl mb-8 text-gray-100">Explore our facilities and living spaces from the comfort of your home. Our 360° virtual tour gives you an immersive experience of CustoHost.</p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-300 mt-1 mr-3"></i>
                            <span>Interactive 360° views of all rooms and facilities</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-300 mt-1 mr-3"></i>
                            <span>Detailed information about each space</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-amber-300 mt-1 mr-3"></i>
                            <span>Available 24/7 on any device</span>
                        </li>
                    </ul>
                    <a href="#" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-3 px-8 rounded-lg inline-block transition duration-300 transform hover:scale-105">
                        Start Virtual Tour <i class="fas fa-vr-cardboard ml-2"></i>
                    </a>
                </div>
                <div class="lg:w-1/2 relative">
                    <div class="rounded-xl overflow-hidden shadow-2xl transform hover:scale-105 transition duration-300">
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="https://images.unsplash.com/photo-1558002038-1055907df827?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="CustoHost Virtual Tour" class="w-full h-full object-cover">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <button class="bg-white bg-opacity-80 rounded-full w-20 h-20 flex items-center justify-center text-sky-500 hover:bg-opacity-100 transition duration-300">
                                    <i class="fas fa-play text-3xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">Our Room Options</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Comfortable living spaces designed for students</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="room-card bg-white rounded-xl shadow-md overflow-hidden transition duration-300">
                    <div class="relative overflow-hidden h-64">
                        <img src="images/pho1.jpg">
                        <div class="absolute top-4 right-4 bg-sky-500 text-white px-3 py-1 rounded-full text-sm font-bold">Most Popular</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Standard Single</h3>
                        <p class="text-gray-600 mb-4">Private room with study desk, wardrobe and shared bathroom facilities.</p>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-sky-500 font-bold text-xl">1.5M/semester</span>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-bed mr-2"></i> Single Bed
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-ruler-combined mr-2"></i> 12m²
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-wifi mr-2"></i> Free WiFi
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-users mr-2"></i> Shared Bath
                            </div>
                        </div>
                        <a href="#apply" class="block w-full bg-sky-500 hover:bg-sky-600 text-white text-center font-bold py-3 px-4 rounded-lg transition duration-300">
                            Book Now
                        </a>
                    </div>
                </div>
                
                <div class="room-card bg-white rounded-xl shadow-md overflow-hidden transition duration-300">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Deluxe AC Room" class="w-full h-full object-cover transition duration-500 hover:scale-110">
                        <div class="absolute top-4 right-4 bg-amber-400 text-white px-3 py-1 rounded-full text-sm font-bold">Best Value</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Deluxe AC Room</h3>
                        <p class="text-gray-600 mb-4">Spacious AC room with private bathroom, study lounge access and premium amenities.</p>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-sky-500 font-bold text-xl">2M/semester</span>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-bed mr-2"></i> Queen Bed
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-ruler-combined mr-2"></i> 18m²
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-snowflake mr-2"></i> Air Conditioned
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-bath mr-2"></i> Private Bath
                            </div>
                        </div>
                        <a href="#apply" class="block w-full bg-sky-500 hover:bg-sky-600 text-white text-center font-bold py-3 px-4 rounded-lg transition duration-300">
                            Book Now
                        </a>
                    </div>
                </div>
                
                <div class="room-card bg-white rounded-xl shadow-md overflow-hidden transition duration-300">
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Shared Suite" class="w-full h-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Shared Suite</h3>
                        <p class="text-gray-600 mb-4">Double occupancy with shared common area, perfect for friends studying together.</p>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <span class="text-sky-500 font-bold text-xl">900K/semester</span>
                            </div>
                            <div class="flex items-center text-amber-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-bed mr-2"></i> Twin Beds
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-ruler-combined mr-2"></i> 25m²
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-couch mr-2"></i> Lounge Area
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-bath mr-2"></i> Shared Bath
                            </div>
                        </div>
                        <a href="#apply" class="block w-full bg-sky-500 hover:bg-sky-600 text-white text-center font-bold py-3 px-4 rounded-lg transition duration-300">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block border-2 border-sky-500 text-sky-500 font-bold py-3 px-8 rounded-full hover:bg-sky-500 hover:text-white transition duration-300">
                    View All Room Options <i class="fas fa-chevron-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">Our Premium Facilities</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Everything you need for comfortable living and academic success</p>
            </div>
            
            <div class="flex flex-col lg:flex-row items-center mb-16">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <h3 class="text-3xl font-bold mb-6">Study & Learning Spaces</h3>
                    <p class="text-gray-600 mb-8">Our state-of-the-art study facilities are designed to help you achieve academic excellence with minimal distractions.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-sky-100 text-sky-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-book-open text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">24/7 Study Lounge</h4>
                                <p class="text-gray-600">Quiet, well-lit spaces with comfortable seating and individual study carrels available around the clock.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-amber-100 text-amber-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-laptop-code text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Computer Lab</h4>
                                <p class="text-gray-600">High-performance computers with all necessary software for your coursework and projects.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-teal-100 text-teal-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Group Study Rooms</h4>
                                <p class="text-gray-600">Soundproof rooms equipped with whiteboards and presentation screens for collaborative work.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" alt="Study Lounge" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1470&q=80" alt="Group Study" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="col-span-2 rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1541178735493-479c1a27ed24?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" alt="Computer Lab" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:order-2 lg:pl-10">
                    <h3 class="text-3xl font-bold mb-6">Recreation & Wellness</h3>
                    <p class="text-gray-600 mb-8">We believe in holistic development, which is why we provide excellent facilities for your physical and mental well-being.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-pink-100 text-pink-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-dumbbell text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Fitness Center</h4>
                                <p class="text-gray-600">Modern gym with cardio and strength training equipment, open 24/7 for your convenience.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-purple-100 text-purple-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-spa text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Yoga & Meditation</h4>
                                <p class="text-gray-600">Regular classes and dedicated spaces for yoga, meditation and mindfulness practices.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-green-100 text-green-500 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-gamepad text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-2">Game Room</h4>
                                <p class="text-gray-600">Pool tables, foosball, board games and video game consoles for relaxation and socializing.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 lg:order-1">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1075&q=80" alt="Fitness Center" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1520&q=80" alt="Yoga Class" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                        <div class="col-span-2 rounded-xl overflow-hidden shadow-lg">
                            <img src="https://images.unsplash.com/photo-1600861195091-690c92f1d2cc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1471&q=80" alt="Game Room" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">Simple, Transparent Pricing</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">All-inclusive pricing with no hidden fees</p>
            </div>
            
            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-full bg-gray-200 p-1">
                    <button class="px-6 py-2 rounded-full bg-sky-500 text-white font-semibold">Semester</button>
                    <button class="px-6 py-2 rounded-full text-gray-700 font-semibold">Monthly</button>
                    <button class="px-6 py-2 rounded-full text-gray-700 font-semibold">Annual</button>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-gray-200 hover:border-sky-500 transition duration-300">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold mb-4">Standard Single</h3>
                        <div class="text-5xl font-bold mb-4 text-sky-500">1.5M</div>
                        <p class="text-gray-600 mb-6">per semester</p>
                        <a href="#apply" class="block w-full bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded-lg mb-6 transition duration-300">
                            Book Now
                        </a>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="p-8">
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Private room (12m²)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Shared bathroom</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Study desk & chair</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>High-speed WiFi</span>
                                </li>
                                <li class="flex items-start text-gray-400">
                                    <i class="fas fa-times mt-1 mr-3"></i>
                                    <span>Air conditioning</span>
                                </li>
                                <li class="flex items-start text-gray-400">
                                    <i class="fas fa-times mt-1 mr-3"></i>
                                    <span>Private bathroom</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-xl overflow-hidden border-2 border-sky-500 transform scale-105 relative">
                    <div class="absolute top-0 right-0 bg-sky-500 text-white px-4 py-1 text-sm font-bold rounded-bl-lg">Most Popular</div>
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold mb-4">Deluxe AC Room</h3>
                        <div class="text-5xl font-bold mb-4 text-sky-500">2M</div>
                        <p class="text-gray-600 mb-6">per semester</p>
                        <a href="#apply" class="block w-full bg-amber-400 hover:bg-amber-500 text-white font-bold py-3 px-4 rounded-lg mb-6 transition duration-300">
                            Book Now
                        </a>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="p-8">
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Private room (18m²)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Private bathroom</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Air conditioning</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Premium WiFi (500Mbps)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Study lounge access</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Weekly cleaning</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-gray-200 hover:border-sky-500 transition duration-300">
                    <div class="p-8 text-center">
                        <h3 class="text-2xl font-bold mb-4">Shared Suite</h3>
                        <div class="text-5xl font-bold mb-4 text-sky-500">900K</div>
                        <p class="text-gray-600 mb-6">per semester</p>
                        <a href="#apply" class="block w-full bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded-lg mb-6 transition duration-300">
                            Book Now
                        </a>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="p-8">
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Shared room (25m²)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Shared bathroom</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Two study desks</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>High-speed WiFi</span>
                                </li>
                                <li class="flex items-start text-gray-400">
                                    <i class="fas fa-times mt-1 mr-3"></i>
                                    <span>Air conditioning</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                                    <span>Common lounge area</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <div class="bg-gray-100 rounded-xl p-6 inline-block max-w-2xl">
                    <h4 class="text-xl font-bold mb-2">Need a custom solution?</h4>
                    <p class="text-gray-600 mb-4">We offer flexible options for groups, long-term stays, and special requirements.</p>
                    <a href="#contact" class="inline-block border-2 border-sky-500 text-sky-500 font-bold py-2 px-6 rounded-full hover:bg-sky-500 hover:text-white transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">What Our Students Say</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Hear from students who've made CustoHost their home</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="testimonial-card bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Sarah Johnson</h4>
                            <p class="text-gray-600">Computer Science, 3rd Year</p>
                            <div class="flex text-amber-400 mt-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"The facilities are excellent! The rooms are clean, the Wi-Fi is fast, and the staff is very helpful. The study lounges helped me ace my exams last semester!"</p>
                    <div class="flex space-x-2">
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Cleanliness</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">WiFi</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Staff</span>
                    </div>
                </div>
                
                <div class="testimonial-card bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Michael Chen" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Michael Chen</h4>
                            <p class="text-gray-600">Business, 2nd Year</p>
                            <div class="flex text-amber-400 mt-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"I love the community here. The regular events helped me make friends quickly. The gym is well-equipped and open 24/7 which fits my schedule perfectly."</p>
                    <div class="flex space-x-2">
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Community</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Gym</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Events</span>
                    </div>
                </div>
                
                <div class="testimonial-card bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-6">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Priya Patel" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold">Priya Patel</h4>
                            <p class="text-gray-600">Medicine, 4th Year</p>
                            <div class="flex text-amber-400 mt-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-700 italic mb-6">"The food in the mess is delicious and hygienic. Management is very responsive to any issues. The location is perfect - just 10 minutes from campus!"</p>
                    <div class="flex space-x-2">
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Food</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Management</span>
                        <span class="bg-sky-100 text-sky-500 text-xs px-3 py-1 rounded-full">Location</span>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center text-sky-500 font-bold">
                    Read more reviews <i class="fas fa-chevron-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-sky-500">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Find answers to common questions about CustoHost</p>
            </div>
            
            <div class="max-w-3xl mx-auto">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4 overflow-hidden">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button bg-white text-left font-bold text-lg px-6 py-4 w-full hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                What's included in the room price?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-6 py-4 text-gray-600">
                                Our room prices include all utilities (electricity, water, WiFi), basic furnishings (bed, study desk, wardrobe), access to common facilities (study lounges, fitness center), and weekly cleaning services. Meal plans are available as an optional add-on.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4 overflow-hidden">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed bg-white text-left font-bold text-lg px-6 py-4 w-full hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How do I apply for accommodation?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-6 py-4 text-gray-600">
                                You can apply online through our website by filling out the application form and submitting the required documents (student ID, proof of enrollment). Once submitted, our team will review your application and get back to you within 3 business days with confirmation and payment details.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4 overflow-hidden">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed bg-white text-left font-bold text-lg px-6 py-4 w-full hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What is the cancellation policy?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-6 py-4 text-gray-600">
                                Cancellations made more than 30 days before check-in receive a full refund. Between 15-30 days, we refund 50% of the payment. Cancellations within 15 days of check-in are non-refundable. All cancellations must be made in writing via email to our support team.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4 overflow-hidden">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed bg-white text-left font-bold text-lg px-6 py-4 w-full hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Can I choose my roommate?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-6 py-4 text-gray-600">
                                Yes! If you're applying with a friend, you can request to be roommates by mentioning each other's names in the application. For individual applicants, we carefully match roommates based on academic programs, schedules, and lifestyle preferences to ensure compatibility.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4 overflow-hidden">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed bg-white text-left font-bold text-lg px-6 py-4 w-full hover:bg-gray-50 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Are there laundry facilities available?
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                            <div class="accordion-body px-6 py-4 text-gray-600">
                                Yes, we have coin-operated laundry facilities on each floor with washing machines and dryers. We also offer a premium laundry service where staff will wash, dry, and fold your clothes for an additional fee.
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-12">
                    <p class="text-gray-600 mb-4">Still have questions? We're happy to help!</p>
                    <a href="#contact" class="inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Apply Section -->
    <section id="apply" class="py-16 bg-gradient-to-r from-sky-500 to-teal-400 text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <h2 class="text-4xl font-bold mb-6">Ready to Join Our Community?</h2>
                    <p class="text-xl mb-8">Limited rooms available for the upcoming semester. Apply now to secure your spot!</p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="register.html" class="bg-white hover:bg-gray-100 text-sky-500 px-8 py-4 rounded-full font-bold transition duration-300 transform hover:scale-105">
                            Apply Now <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#contact" class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-bold transition duration-300 hover:bg-white hover:text-sky-500">
                            <i class="fas fa-phone-alt mr-2"></i> Call Us
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <div class="bg-white bg-opacity-20 p-8 rounded-xl backdrop-blur-sm border border-white border-opacity-30">
                        <h3 class="text-2xl font-bold mb-6">Application Deadline</h3>
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Fall Semester</span>
                                <span>August 15, 2025</span>
                            </div>
                            <div class="w-full bg-white bg-opacity-30 rounded-full h-2.5">
                                <div class="bg-amber-400 h-2.5 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="mb-8">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Spring Semester</span>
                                <span>December 15, 2025</span>
                            </div>
                            <div class="w-full bg-white bg-opacity-30 rounded-full h-2.5">
                                <div class="bg-amber-400 h-2.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="bg-white bg-opacity-30 p-4 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-gift text-amber-400 text-2xl mr-4"></i>
                                <div>
                                    <h4 class="font-bold">Early Bird Discount</h4>
                                    <p class="text-sm">Apply before July 1st and get 15% off your first semester!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-1/2 mb-10 lg:mb-0 lg:pr-10">
                    <h2 class="text-4xl font-bold mb-6 text-sky-500">Get In Touch</h2>
                    <p class="text-xl text-gray-600 mb-8">Have questions? Our team is here to help you with anything you need.</p>
                    
                    <div class="space-y-6 mb-8">
                        <div class="flex items-start">
                            <div class="bg-sky-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1">Location</h4>
                                <p class="text-gray-600">123 University Avenue, Campus Town, CT 06510</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-sky-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1">Phone</h4>
                                <p class="text-gray-600">+256-741-474-780 (24/7 Support)</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-sky-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold mb-1">Email</h4>
                                <p class="text-gray-600">hello@CustoHost.edu</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-sky-100 text-sky-500 w-10 h-10 rounded-full flex items-center justify-center hover:bg-sky-500 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-sky-100 text-sky-500 w-10 h-10 rounded-full flex items-center justify-center hover:bg-sky-500 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-sky-100 text-sky-500 w-10 h-10 rounded-full flex items-center justify-center hover:bg-sky-500 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-sky-100 text-sky-500 w-10 h-10 rounded-full flex items-center justify-center hover:bg-sky-500 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div class="lg:w-1/2">
                    <div class="bg-white p-8 rounded-xl shadow-lg">
                        <h3 class="text-2xl font-bold mb-6 text-sky-500">Send Us a Message</h3>
                        <form class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 mb-2">First Name</label>
                                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 mb-2">Last Name</label>
                                    <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Email</label>
                                <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Subject</label>
                                <select class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500">
                                    <option>General Inquiry</option>
                                    <option>Booking Question</option>
                                    <option>Payment Issue</option>
                                    <option>Facility Request</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Message</label>
                                <textarea rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-sky-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded-lg transition duration-300">
                                Send Message <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <div class="h-96 w-full">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215573291234!2d-73.98784492416432!3d40.7484409713898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1689870313458!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <i class="fas fa-home text-2xl text-sky-400"></i>
                        <span class="font-bold text-2xl">Spark<span class="text-amber-300">Host</span></span>
                    </div>
                    <p class="text-gray-400 mb-6">Providing premium student accommodation since 2012. Our mission is to create safe, comfortable, and inspiring living spaces.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h5 class="text-lg font-bold mb-6">Quick Links</h5>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-gray-400 hover:text-white transition duration-300">Home</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition duration-300">Features</a></li>
                        <li><a href="#rooms" class="text-gray-400 hover:text-white transition duration-300">Rooms</a></li>
                        <li><a href="#facilities" class="text-gray-400 hover:text-white transition duration-300">Facilities</a></li>
                        <li><a href="#pricing" class="text-gray-400 hover:text-white transition duration-300">Pricing</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="text-lg font-bold mb-6">Support</h5>
                    <ul class="space-y-3">
                        <li><a href="#faq" class="text-gray-400 hover:text-white transition duration-300">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Terms of Service</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Cookie Policy</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition duration-300">Contact Us</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="text-lg font-bold mb-6">Newsletter</h5>
                    <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates and offers.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your Email" class="px-4 py-3 rounded-l-lg w-full focus:outline-none text-gray-800">
                        <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white px-4 rounded-r-lg transition duration-300">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-2">We'll never share your email with anyone else.</p>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 mb-4 md:mb-0">&copy; 2025 CustoHost. All rights reserved.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">Terms of Service</a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#home" id="back-to-top" class="fixed bottom-8 right-8 bg-sky-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-sky-600 transition duration-300 opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </a>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Mobile menu toggle functionality
        const navToggle = document.getElementById('nav-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        navToggle.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            
            // Toggle icon between hamburger and X
            if (!isExpanded) {
                this.innerHTML = `
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                `;
            } else {
                this.innerHTML = `
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            }
        });
        
        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                navToggle.setAttribute('aria-expanded', 'false');
                navToggle.innerHTML = `
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                `;
            });
        });

        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });
        
        // Smooth scrolling for navigation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Update active nav link on scroll
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', function() {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('text-amber-300');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('text-amber-300');
                }
            });
        });
        
        // Animate elements when they come into view
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.animate__animated');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementPosition < windowHeight - 100) {
                    const animationClass = element.classList[1];
                    element.classList.add(animationClass);
                }
            });
        };
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
        
        // Room card hover effect
        const roomCards = document.querySelectorAll('.room-card');
        
        roomCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                const img = this.querySelector('img');
                img.style.transform = 'scale(1.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                const img = this.querySelector('img');
                img.style.transform = 'scale(1)';
            });
        });
        
        // Testimonial card hover effect
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        
        testimonialCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Feature icon hover effect
        const featureIcons = document.querySelectorAll('.feature-icon');
        
        featureIcons.forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'rotateY(180deg)';
            });
            
            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'rotateY(0)';
            });
        });
    </script>
</body>
</html>