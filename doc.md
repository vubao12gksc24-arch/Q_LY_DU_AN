├───assets
  │ └───css
  │ │ ├── admin.css
  │ │ ├── guide.css
  │ │ ├── auth.css
  │ │ └── common.css
  │ └───js
  │ │ ├── admin.js
  │ │ ├── guide.js
  │ │ ├── common.js
  │ │ └── notifications.js
  │ └───images
  │ ├── logo.png
  │ └── default-avatar.png
  │
  ├───commons
  │ ├── helpers
  │ │ ├── Session.php
  │ │ ├── Validator.php
  │ │ ├── Upload.php
  │ │ ├── Format.php
  │ │ ├── Pagination.php
  │ │ └── Notification.php
  │ └── middleware
  │ ├── AuthMiddleware.php
  │ ├── AdminMiddleware.php
  │ └── GuideMiddleware.php
  │
  ├───config
  │ ├── autoload.php
  │ ├── env.example.php
  │ └── env.php
  │
  ├───controllers
  │ ├── AuthController.php
  │ │
  │ ├── admin
  │ │ ├── DashboardController.php
  │ │ ├── TourController.php
  │ │ ├── BookingController.php
  │ │ ├── CustomerController.php
  │ │ ├── ServiceController.php
  │ │ ├── ServiceTypeController.php
  │ │ ├── SupplierController.php
  │ │ ├── DestinationController.php
  │ │ ├── CountryController.php
  │ │ ├── CategoryController.php
  │ │ ├── UserController.php
  │ │ ├── RoleController.php
  │ │ ├── PaymentController.php
  │ │ ├── PolicyController.php
  │ │ ├── TourAssignmentController.php
  │ │ ├── ContractController.php
  │ │ ├── NotificationController.php
  │ │ └── ReportController.php
  │ │
  │ └── guide
  │ ├── TourAssignmentController.php
  │ ├── JournalController.php
  │ ├── CheckInController.php
  │ ├── ItineraryController.php
  │ ├── CustomerController.php
  │ └── NotificationController.php
  │
  ├───models
  │ ├── User.php
  │ ├── Role.php
  │ ├── Tour.php
  │ ├── Booking.php
  │ ├── Customer.php
  │ ├── Service.php
  │ ├── ServiceType.php
  │ ├── Supplier.php
  │ ├── Destination.php
  │ ├── Country.php
  │ ├── Category.php
  │ ├── Itinerary.php
  │ ├── Payment.php
  │ ├── Policy.php
  │ ├── TourAssignment.php
  │ ├── Journal.php
  │ ├── CustomerCheckIn.php
  │ ├── CustomerContract.php
  │ └── Notification.php
  │
  ├───routers
  │ └── routes.php # (hoặc file router khác nếu bạn tách riêng)
  │
  ├───uploads
  │ └───destinations
  │ ├── tours
  │ ├── journals
  │ ├── checkins
  │ ├── contracts
  │ └── avatars
  │
  └───views
  ├───components
  │ ├── header.php
  │ ├── sidebar.php
  │ └── footer.php
  │
  ├───admin
  │ ├── dashboard.php
  │ │
  │ ├── tours
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ ├── edit.php
  │ │ └── detail.php
  │ ├── bookings
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ ├── edit.php
  │ │ └── detail.php
  │ ├── customers
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ ├── edit.php
  │ │ └── detail.php
  │ ├── services
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── service-types
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── suppliers
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── destinations
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── countries
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── categories
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── users
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── roles
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── payments
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── detail.php
  │ ├── policies
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── tour-assignments
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── edit.php
  │ ├── contracts
  │ │ ├── index.php
  │ │ ├── create.php
  │ │ └── detail.php
  │ └── notifications
  │ └── index.php
  │
  └───guide
  ├── my-schedule.php
  ├── tour-assignments
  │ ├── index.php
  │ └── detail.php
  ├── journals
  │ ├── index.php
  │ ├── create.php
  │ └── edit.php
  ├── checkins
  │ ├── index.php
  │ └── create.php
  ├── itineraries
  │ └── index.php
  ├── customers
  │ └── index.php
  └── notifications
  └── index.php