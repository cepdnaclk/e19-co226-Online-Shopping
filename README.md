# Online Shopping Website

This repository contains the code and files for an online shopping website. The website provides a platform for users to browse and purchase various products conveniently from the comfort of their own homes.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Technologies](#Technologies)

## Features

The online shopping website includes the following features:

1. **User Registration and Authentication**: Users can create accounts, log in, and log out. This ensures secure access to user-specific information and allows users to view their order history.

2. **Product Catalog**: The website provides a comprehensive catalog of products available for purchase. Users can browse products by categories, search for specific items, and view detailed product information including images, descriptions, and prices.

3. **Shopping Cart**: Users can add products to their shopping cart and manage the quantities of items. The shopping cart allows users to review their selected items, update quantities, and remove products before proceeding to checkout.

4. **Checkout Process**: The website includes a streamlined checkout process. Users can review their order summary, provide shipping and billing information, and select a preferred payment method. After completing the checkout process, users receive confirmation of their purchase via email.

5. **Order Management**: The website includes an order management system for administrators. Admins can view and process orders, update order statuses, and generate reports to track sales and inventory.

6. **User Reviews and Ratings**: Users can leave reviews and ratings for products they have purchased. This feature provides valuable feedback to other users and helps them make informed purchasing decisions.

## Installation
1. Clone or download this repository to your local machine.
2. Install XAMPP by following the instructions provided on the official XAMPP website.
3. Locate the htdocs directory in your XAMPP installation directory (usually C:\xampp\htdocs\ on Windows or /opt/lampp/htdocs/ on Linux).
4. Move the downloaded repository folder into the htdocs directory.

## Database Setup
1. Launch XAMPP Control Panel and start the Apache and MySQL services.
2. Open a web browser and navigate to http://localhost/phpmyadmin/ to access phpMyAdmin.
3. Create a new database named website_database.
4. Inside the repository's sql folder, you will find SQL scripts to create necessary tables in the database. Execute these scripts using phpMyAdmin or any MySQL client tool.

## Usage
1. Open a web browser and enter http://localhost/website-folder-name/ in the address bar.
2. You will be directed to the homepage of the website.

## Technologies Used

The online shopping website is built using the following technologies:

- **Front-end**  : HTML, CSS, JavaScript
- **Database**   : MySQL
- **Back-end**   : PHP
