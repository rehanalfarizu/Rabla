# Business Logic Recommendations - Project Rabla

## 1. Order Flow (Alur Pesanan)

### Flow Diagram
```
User Checkout
     │
     ▼
Create Order (Pending) ──→ Reserve Stock
     │
     ▼
Payment Process ──→ [Success] ──→ Confirm Order ──→ Process Order
     │                                    │
     │                                    ▼
     │                              Notify User
     │                                    │
     ▼                                    ▼
[Failed] ──→ Cancel Order ──→ Release Stock
```

### Status Flow
```
pending → confirmed → processing → shipped → delivered
    │         │            │          │
    ▼         ▼            ▼          ▼
 cancelled  cancelled    cancelled   returned
```

## 2. Stock Management

### Reservation System
```php
// Saat checkout, stock di-reserve
Product::reserve($productId, $quantity);

// Saat payment success, stock di-confirm
Product::confirmReservation($productId, $quantity);

// Saat timeout/cancelled, stock di-release
Product::releaseReservation($productId, $quantity);
```

### Low Stock Alert
- Trigger notifikasi saat stock ≤ low_stock_threshold
- Otomatis set product sebagai "out of stock" saat stock = 0

## 3. Pricing & Discount Logic

### Price Calculation
```php
$price = $product->price;
$discount = $promotion->calculate($price);
$finalPrice = $price - $discount;
```

### Promotion Priority
1. Buy One Get One (BOGO)
2. Percentage Discount
3. Fixed Discount
4. Free Shipping

Jika multiple promotions aktif, gunakan yang paling menguntungkan user.

## 4. Authentication & Verification

### OTP Flow
```
Register → Send OTP → Verify OTP → Create User → Login
```

### Token Structure
```php
// JWT or Session-based
{
  user_id,
  email,
  is_admin,
  exp: timestamp
}
```

## 5. Cart Logic

### Cart Persistence
- Simpan cart di localStorage (guest)
- Migrate ke database saat login

### Stock Validation
- Validasi stock saat checkout
- Warning jika stock < quantity yang dipesan

## 6. Review & Rating Logic

### Verified Purchase Requirement
- Hanya user yang pernah order bisa memberikan review
- Review harus di-approve admin sebelum tampil

### Auto-Review Reminder
- Kirim notifikasi 7 hari setelah delivered
- Incentive: discount untuk next order

## 7. Shipping Calculation

### Shipping Cost Rules
```php
// Free shipping conditions
if ($subtotal >= FREE_SHIPPING_THRESHOLD) {
    $shippingCost = 0;
}

// Based on weight
if ($totalWeight > 1) {
    $shippingCost += WEIGHT_RATE * ($totalWeight - 1);
}
```

## 8. Recommended Business Rules

### Order
- **Maximum order value:** Rp 50.000.000
- **Order timeout:** 24 jam (pending → auto cancel)
- **Cancellation deadline:** Before shipped

### Product
- **Minimum stock alert:** 10 units
- **Maximum images:** 8 per product
- **Featured products:** Max 20

### Promotion
- **Stackable:** Tidak (hanya 1 promo per order)
- **Auto-apply:** Promo public otomatis
- **Code-based:** Promo private perlu kode

### User
- **Password requirements:** Min 8 chars, 1 uppercase, 1 number
- **OTP expiry:** 5 minutes
- **Max address:** 5 per user

## 9. Recommended Features

### Must Have (MVP)
- User registration & login
- Product catalog & search
- Shopping cart
- Checkout & payment
- Order tracking
- Admin dashboard

### Should Have (Phase 2)
- Product reviews & ratings
- Wishlist
- Promotion/coupon system
- Email notifications
- Stock management

### Nice to Have (Phase 3)
- Multi-vendor support
- Advanced analytics
- Loyalty points system
- Social login (Google, Facebook)
- Mobile app (React Native)

## 10. Data Seeding Recommendations

### Sample Data untuk Development
```php
// Categories
- Clothing (T-shirt, Jacket, Pants)
- Shoes (Sneakers, Boots, Sandals)
- Accessories (Bags, Watches, Hats)

// Products per category
- 10-20 products each
- Mix of price ranges
- Varied stock levels

// Users
- 5 admin accounts
- 50 customer accounts
- Sample addresses

// Orders
- Various statuses
- Mix of payment methods
- Sample reviews
```

## 11. API Endpoints Recommendations

### Authentication
```
POST /api/auth/register
POST /api/auth/login
POST /api/auth/logout
POST /api/auth/verify-otp
POST /api/auth/forgot-password
```

### Products
```
GET /api/products
GET /api/products/{id}
GET /api/products/category/{slug}
GET /api/products/search?q=
```

### Cart
```
GET /api/cart
POST /api/cart/add
PUT /api/cart/update
DELETE /api/cart/remove
```

### Orders
```
POST /api/orders
GET /api/orders
GET /api/orders/{id}
PUT /api/orders/{id}/cancel
POST /api/orders/{id}/confirm
```

### Reviews
```
POST /api/reviews
GET /api/products/{id}/reviews
PUT /api/reviews/{id}
```

## 12. Security Recommendations

### Input Validation
- Sanitize all user inputs
- Validate file uploads (image only, max 2MB)
- Rate limiting on API endpoints

### Admin Access
- Separate admin routes
- Role-based access control
- Activity logging for all admin actions

### Payment
- Never store payment details
- Use third-party payment gateway
- Validate payment webhook signatures