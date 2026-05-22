# Project Rabla

E-commerce application dengan architecture Laravel + Vue.js. Project terpisah menjadi `frontend` dan `backend`.

## Folder Structure

```
/Users/macbookpro/Documents/Rabla/
├── frontend/          # Vue 3 SPA
├── backend/          # Laravel 12 API
├── FIREBASE_SETUP.md # Firebase setup guide
├── README.md         # Project documentation
├── Dockerfile        # Docker container (Heroku)
└── docker-compose.yml # Docker compose file
```

## Frontend

**Tech Stack:**
- Vue 3 (Composition API)
- Vite
- Tailwind CSS v4
- Vue Router 4
- ApexCharts
- Firebase SDK

**Folder Structure:**
```
frontend/src/
├── pages/             # Vue pages (20+ files)
├── components/       # Reusable components
│   └── home/         # Homepage section components
├── layouts/          # Layout components
├── router/           # Vue Router config
├── assets/           # Static assets
├── main.js           # Entry point
├── App.vue           # Root component
├── style.css         # Global styles
├── api.js            # Axios configuration
└── firebase.js      # Firebase configuration
```

**Key Pages:**
- `/` - Homepage
- `/products` - Product listing
- `/products/:id` - Product detail
- `/cart` - Shopping cart (auth required)
- `/checkout` - Checkout page (auth required)
- `/order-history` - Order history (auth required)
- `/order-track` - Track order (auth required)
- `/login` - Login page (3 methods: password, Google/Firebase, OTP)
- `/register` - Registration page (2 methods: manual, Google/Firebase)
- `/profile` - User profile (auth required)
- `/complete-profile` - Complete profile with password setup (auth required)
- `/admin` - Admin dashboard (auth required)
- `/admin/products` - Manage products (auth required)
- `/admin/customers` - Manage customers (auth required)
- `/admin/orders` - Manage orders (auth required)
- `/admin/promotions` - Manage promotions (auth required)

**Commands:**
```bash
cd frontend
npm run dev      # Development server (port 5173)
npm run build    # Production build
```

## Backend

**Tech Stack:**
- Laravel 12
- MongoDB Atlas (cloud database)
- Filament Admin Panel
- jenssegers/mongodb package
- Firebase PHP SDK (kreait/firebase-php)
- JWT authentication

**Folder Structure:**
```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/   # API controllers
│   │   │   ├── AuthController.php    # Login, register, logout
│   │   │   ├── OtpController.php     # OTP login (backup)
│   │   │   ├── ProfileController.php # Profile management
│   │   │   ├── ProductController.php  # Products API
│   │   │   └── Admin/                # Admin controllers
│   │   └── Middleware/
│   │       └── AuthenticateApiToken.php  # Auth middleware
│   ├── Models/               # Eloquent models (MongoDB)
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Category.php
│   │   ├── Order.php
│   │   ├── Address.php
│   │   └── etc.
│   └── Providers/
│       └── AppServiceProvider.php  # Firebase setup
├── firebase/                 # Firebase credentials
│   └── service-account.json
├── config/                   # Laravel configs
│   └── firebase.php
├── routes/
│   └── api.php              # API routes
├── database/
│   └── seeders/             # Database seeders
├── public/                   # Public entry point
└── vendor/                  # Composer dependencies
```

**Commands:**
```bash
cd backend
php artisan serve             # Start server (port 8000)
php artisan config:clear      # Clear config cache
composer run dev              # Run all services concurrently
```

## Authentication System

### Login Page (`/login`)
User bisa login dengan 3 cara:
1. **Email & Password** - Login manual dengan email + password
2. **Google (Firebase)** - Button "Masuk dengan Google" → kirim magic link ke email
3. **OTP** - Kirim kode OTP ke email (backup method)

### Register Page (`/register`)
User bisa register dengan 2 cara:
1. **Manual** - Input nama + email + password + konfirmasi password
2. **Google (Firebase)** - Button "Daftar dengan Google" → kirim verification link

### Registration Flow
1. User register (manual atau Firebase)
2. Langsung login dan redirect ke homepage (`/`)
3. User bisa melengkapi profil di `/complete-profile` untuk set password

### Firebase Authentication Flow
1. User input email → Firebase kirim email link
2. User klik link di email → Firebase verify token
3. Backend verifikasi Firebase token → buat/update user di MongoDB
4. Generate session token → login berhasil

### OTP Login Flow (Backup)
1. User input email
2. Backend generate 6-digit OTP → save ke user document
3. OTP expires dalam 10 menit
4. User input OTP → backend verify → login berhasil

## API Endpoints

### Auth Routes (`/api/auth/*`)
```
POST /api/auth/register       # Register new user
POST /api/auth/login          # Login with email/password
POST /api/auth/logout          # Logout (auth required)
GET  /api/auth/user            # Get current user (auth required)
POST /api/auth/send-otp        # Send OTP to email (for backup login)
POST /api/auth/verify-login-otp # Verify OTP and login
POST /api/auth/firebase-login  # Login via Firebase token
POST /api/auth/firebase-register # Register via Firebase token
```

### Product Routes (`/api/products/*`)
```
GET  /api/products             # List products (paginated)
GET  /api/products/featured    # Featured products
GET  /api/products/:id         # Get product detail (by _id or numeric_id)
```

### Profile Routes (`/api/profile/*`)
```
GET  /api/profile             # Get user profile (auth required)
PUT  /api/profile            # Update profile (auth required)
```

### Cart Routes (`/api/cart/*`) - Auth required
```
GET    /api/cart              # Get cart items
POST   /api/cart              # Add item to cart
PUT    /api/cart/:id          # Update cart item
DELETE /api/cart/:id          # Remove item from cart
DELETE /api/cart              # Clear cart
```

### Admin Routes (`/api/admin/*`) - Auth + Admin required
```
GET    /api/admin/products    # List all products
POST   /api/admin/products    # Create product
GET    /api/admin/products/:id # Get product
PUT    /api/admin/products/:id # Update product
DELETE /api/admin/products/:id # Delete product
# ... orders, customers, promotions CRUD
```

## Database Schema (MongoDB)

### Collections:
- `users` - User accounts with auth data
- `products` - Product catalog with `numeric_id` for frontend mapping
- `categories` - Product categories
- `orders` - Order transactions
- `order_items` - Order line items
- `promotions` - Discounts and promotions
- `addresses` - User addresses
- `reviews` - Product reviews
- `wishlists` - User wishlists

### User Document Structure:
```json
{
  "_id": "ObjectId",
  "name": "John Doe",
  "email": "john@example.com",
  "password": "$2y$12$...",
  "phone": "08123456789",
  "avatar": "url",
  "firebase_uid": "firebase-uid",
  "is_verified": true,
  "is_admin": false,
  "gender": "male",
  "birth_date": "1990-01-01",
  "api_token": "hashed-token",
  "verification_token": "otp-code",
  "verification_expires": "datetime",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### Product Document Structure:
```json
{
  "_id": "ObjectId",
  "numeric_id": 1,
  "slug": "product-slug",
  "name": "Product Name",
  "category_id": "ObjectId",
  "brand": "Brand Name",
  "price": "Decimal128",
  "compare_price": "Decimal128",
  "stock": 100,
  "rating": 4.5,
  "images": ["url1", "url2"],
  "colors": ["black", "white"],
  "sizes": ["S", "M", "L"],
  "description": "Product description",
  "is_active": true,
  "is_featured": true,
  "is_new": false,
  "views_count": 0,
  "sold_count": 0
}
```

## Environment Configuration

### Backend (.env)
```env
APP_NAME=Rabla
APP_ENV=local
APP_KEY=base64:...
APP_URL=http://localhost:8000

DB_CONNECTION=mongodb
MONGODB_URI=mongodb+srv://user:password@cluster0.rbltdtu.mongodb.net/rabla?appName=Cluster0&authSource=admin
MONGODB_DATABASE=rabla

FIREBASE_CREDENTIALS=firebase/service-account.json
```

### Frontend (.env)
```env
VITE_API_URL=http://localhost:8000
VITE_FIREBASE_API_KEY=...
VITE_FIREBASE_AUTH_DOMAIN=...
VITE_FIREBASE_PROJECT_ID=...
VITE_FIREBASE_STORAGE_BUCKET=...
VITE_FIREBASE_MESSAGING_SENDER_ID=...
VITE_FIREBASE_APP_ID=...
```

## Development

1. **Start Backend:**
   ```bash
   cd backend
   php artisan serve
   ```

2. **Start Frontend:**
   ```bash
   cd frontend
   npm run dev
   ```

3. **MongoDB Connection:**
   - Cluster: `cluster0.rbltdtu.mongodb.net`
   - Database: `rabla`
   - Uses direct connection with `appName=Cluster0` parameter

4. **Auth Storage:**
   - Token stored in `localStorage` as `auth_token`
   - User data stored in `localStorage` as `user` (JSON)

## Deployment Architecture

```
┌─────────────────────────────────────────┐
│            Heroku (1 Container)          │
│  ┌─────────────────────────────────┐    │
│  │     Laravel (API + Static)      │    │
│  │  └── Vue (built, served via      │    │
│  │      Laravel public/)           │    │
│  └─────────────────────────────────┘    │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│            MongoDB Atlas                │
│  └── Cluster: cluster0.rbltdtu.mongodb.net
└─────────────────────────────────────────┘
```

## Firebase Setup

1. Create project di [Firebase Console](https://console.firebase.google.com/)
2. Enable **Authentication** → **Sign-in method** → **Email link**
3. Get frontend config untuk `frontend/.env`
4. Download service account JSON → save ke `backend/firebase/service-account.json`
5. Add authorized domains: `localhost` (dev), production domain (prod)

Lihat `FIREBASE_SETUP.md` untuk detail lengkap.

## Admin Panel

- **Filament** untuk admin dashboard
- Accessible via `/admin` route (auth + admin required)
- Connect ke MongoDB Atlas via Eloquent
- Features: CRUD tables, forms, filters, metrics

## Database Monitoring

Monitoring dilakukan via MongoDB Atlas Dashboard:
- Performance metrics (query latency, connections)
- Operations tracker (slow queries)
- Alerts (disk usage, connection limits)
- Access: https://cloud.mongodb.com

## Troubleshooting

### MongoDB Connection Issues
- Pastikan IP whitelist di Atlas sudah include IP kamu
- Gunakan `appName=Cluster0` di connection string
- Test connection: `mongosh "mongodb+srv://user:pass@cluster0.rbltdtu.mongodb.net/?appName=Cluster0"`

### Firebase Auth Issues
- Check quota: Firebase free tier punya batas daily
- Gunakan OTP backup jika Firebase quota exceeded
- Pastikan service account JSON valid

### Product Quick View 404
- Products di frontend punya numeric ID (1, 2, 3...)
- MongoDB products punya `numeric_id` untuk mapping
- Jika tidak match, update dengan script `backend/update_products.js`

## Packages

### Backend:
```bash
composer require jenssegers/mongodb
composer require filament/filament
composer require kreait/firebase-php firebase/php-jwt
```

### Frontend:
```bash
npm install firebase axios vue-router
```

## Notes

- Auth token format: standard Laravel token untuk manual auth
- Firebase users store `firebase_uid` untuk tracking
- OTP valid 10 menit, setelah itu harus request baru
- Product `numeric_id` sync dengan frontend dummy data untuk quick view

## Deployment Architecture

### Current Setup (Hybrid)
```
Frontend: Cloudflare Pages (https://rabla.pages.dev / https://rabla.me)
    ↓ API calls
Backend: Heroku (https://rabla-shop-04a33f9a0b9f.herokuapp.com)
    ↓
Database: MongoDB Atlas
```

### Environment Variables
- **Cloudflare Pages**:
  - `VITE_API_URL` = Heroku backend URL
  - Firebase config vars
- **Heroku**:
  - `MONGODB_URI` = MongoDB connection string
  - `FIREBASE_CREDENTIALS_BASE64` = encoded service account JSON

### CORS Configuration
HandleCors middleware di `backend/app/Http/Middleware/HandleCors.php` allow origins:
- `https://rabla.me`
- `https://www.rabla.me`
- `https://rabla.pages.dev`
- `http://localhost:5173`
- `http://localhost:8000`

### API Authentication Flow
1. User login via `/api/auth/login`
2. Backend return `token` (64 char random string)
3. Frontend store token di localStorage `auth_token`
4. Setiap request, Axios interceptor inject `Authorization: Bearer <token>`
5. Backend middleware hash token dengan SHA256 dan check di database