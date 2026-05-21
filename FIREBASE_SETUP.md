# Firebase Setup Guide

## 1. Create Firebase Project

1. Go to [Firebase Console](https://console.firebase.google.com/)
2. Click "Add project" → Enter project name → Follow wizard
3. Enable **Email Link (Passwordless)** authentication:
   - Go to **Authentication** → **Sign-in method**
   - Click "Email/Password"
   - Enable **Email link (passwordless sign-in)**
   - Save

## 2. Get Frontend Config

1. Go to **Project Settings** (gear icon)
2. Scroll to "Your apps" section
3. Click web icon (</>) to add a web app
4. Register app with nickname
5. Copy the `firebaseConfig` values:

```javascript
const firebaseConfig = {
  apiKey: "...",
  authDomain: "...",
  projectId: "...",
  storageBucket: "...",
  messagingSenderId: "...",
  appId: "..."
};
```

## 3. Get Backend Credentials

1. Go to **Project Settings** → **Service accounts**
2. Click "Generate new private key"
3. Save the JSON file as `backend/firebase/service-account.json`

## 4. Configure Environment Variables

### Frontend (.env)
```
VITE_FIREBASE_API_KEY=your_api_key
VITE_FIREBASE_AUTH_DOMAIN=your_project.firebaseapp.com
VITE_FIREBASE_PROJECT_ID=your_project_id
VITE_FIREBASE_STORAGE_BUCKET=your_project.appspot.com
VITE_FIREBASE_MESSAGING_SENDER_ID=your_sender_id
VITE_FIREBASE_APP_ID=your_app_id
```

### Backend (.env)
```
FIREBASE_CREDENTIALS=firebase/service-account.json
```

## 5. Add Authorized Domains

In Firebase Console:
1. Go to **Authentication** → **Settings**
2. Add your domain to "Authorized domains":
   - `localhost` (for development)
   - `your-production-domain.com`

## 6. Testing

1. Start backend: `cd backend && php artisan serve`
2. Start frontend: `cd frontend && npm run dev`
3. Go to `/login` and enter an email
4. Check browser console for the magic link (or email in production)

## Troubleshooting

### "Link not valid" error
- Make sure `handleCodeInApp: true` is set
- Check that the URL callback matches your authorized domains

### "Token not valid" error (backend)
- Verify `FIREBASE_CREDENTIALS` path is correct
- Make sure `service-account.json` is valid

### Email not received
- Check spam folder
- Verify the sender email in Firebase console