# Travel and Reservation Management App

This application is designed to manage travel bookings and reservations for a travel agency. It allows users to view available trips, make reservations, and manage existing bookings.

## Features

1. **Trip Management:**
   - View a list of available trips.
   - See trip details with related reservations.
   - Each trip has 3 different status depending on number of travelers booked at the moment: 'no confirmado' less than 8 travelers, 'confirmado' more than 8 travelers, 'completo' fully booked. No more places available.
   - Create, edit, and delete trips.

2. **Reservation Management:**
   - Make reservations for available trips with available places.
   - Each reservation can have more than one traveler
   -  Reservations can only add travelers to a trip up to this trip places availability.
   - View existing reservations with status: booked or paid.
   - Edit and cancel reservations.


## Technologies Used

- **Laravel:** Laravel is used as the primary framework for building the application.
- **MySQL:** MySQL database is used for data storage.
- **Bootstrap:** Bootstrap is used for front-end design and layout.
- **JavaScript:** JavaScript is used for client-side scripting for dynamic features.

## Restrictions

1. **Validation:**
- Input fields are validated to ensure that required fields are filled and data entered is in the correct format.
- Reservation numbers cannot exceed the maximum available seats for a trip.
- Dates for trips and reservations must be valid and in the future.

2. **Error Handling:**
- The application handles errors displaying user-friendly error messages when something goes wrong.

3. **Security:**
- Proper measures are taken to prevent common security threats such as SQL injection and cross-site scripting (XSS) attacks.

4. **Data Integrity:**
- Database relationships and constraints are used to maintain data integrity, ensuring that trip and reservation data remain consistent and accurate.

5. **User Experience:**
- The application is designed with a user-friendly interface to provide a smooth and intuitive experience for users when browsing trips, making reservations, and managing bookings.
