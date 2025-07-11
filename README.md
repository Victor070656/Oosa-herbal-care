# Oosa Herbal Ventures: E-commerce Platform

**Oosa Herbal Ventures** is a single_category ecommerce application built with PHP. This project includes a functional Paystack payment gateway and a robust routing system, making it a suitable solution for small to medium-sized retail businesses that sell herbal care products online.

## Features

- **Product Catalog**: Display and manage product listings.
- **Payment Integration**: Secure payments powered by Paystack.
- **User Authentication**: Registration, login, and profile management.
- **Shopping Cart & Wishlist**: Add, modify, and track products in the cart or wishlist.
- **Order Management**: Track orders and manage order details.
- **Search and Filters**: Efficient search and filter functionalities for better product discovery.

## Getting Started

### Prerequisites

Ensure you have the following installed:

- PHP >= 7.0
- MySQL >= 5.7
- Web Server (e.g. Apache, Nginx)

### Installation

1. **Clone the repository:**

   ```
   git clone https://github.com/yourusername/oosa-herbal-care.git
   cd oosa-herbal-care
   ```

2. **Set Up Environment Variables:**
   Make a copy of the example environment file provided and update it with your configuration:

   ```
   cp .env.example .env
   ```

3. **Database Setup:**
   Import the SQL dump file located at the root of the project:

   ```
   mysql -u root -p < oosa.sql
   ```

4. **Configure Paystack (Optional):**

   - Go to your Paystack dashboard and get your API keys.
   - Update your `.env` file with Paystack public and secret keys:
     ```
     PAYSTACK_PUBLIC_KEY="your_public_key"
     PAYSTACK_SECRET_KEY="your_secret_key"
     ```

5. **Configure Web Server:**

   - Configure your web server root directory to point to the `/opt/lampp/htdocs/oosa/` folder.
   - Enable necessary Apache modules if needed.

6. **Run the Application:**
   ```
   php -S localhost:18000
   Visit the application at http://localhost:18000
   ```

### Folder Structure

- **/assets/:** Contains all CSS, JS, fonts, and image files.
- **/manager/:** Backend management area for managing users, products, and orders.
- **/uploads/:** Directory for user-uploaded files.
- **/components/:** Shared components like headers and footers for the site.
- **/.** .php files:\*\* Various front-end application pages.

### Contributing

Feel free to fork and submit pull requests. For major changes, please open an issue first to discuss what you would like to change.

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

### License

Distributed under the MIT License. See `LICENSE` for more information.
