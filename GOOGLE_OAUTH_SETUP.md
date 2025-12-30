# Google OAuth Setup Instructions

## ✅ What Has Been Configured

1. **Laravel Socialite Package** - Installed
2. **Google Login Button** - Added to login page
3. **Routes** - Created for Google OAuth flow
4. **AuthController** - Updated with Google login methods
5. **Database** - Added `google_id` column to users table
6. **User Model** - Updated to allow `google_id` in fillable fields

## 🔧 Next Steps: Get Google OAuth Credentials

### Step 1: Create Google OAuth App

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select an existing one
3. Navigate to **APIs & Services** > **Credentials**
4. Click **Create Credentials** > **OAuth client ID**
5. If prompted, configure the OAuth consent screen:
    - User Type: External
    - App name: Beacon Villa
    - User support email: Your email
    - Developer contact: Your email
    - Click Save and Continue through the scopes and test users sections

### Step 2: Configure OAuth Client

1. Application type: **Web application**
2. Name: Beacon Villa Login
3. Authorized JavaScript origins:
    ```
    http://localhost
    http://localhost:8000
    ```
4. Authorized redirect URIs:
    ```
    http://localhost/auth/google/callback
    http://localhost:8000/auth/google/callback
    ```
5. Click **Create**
6. Copy the **Client ID** and **Client Secret**

### Step 3: Update .env File

Add these lines to your `.env` file:

```env
GOOGLE_CLIENT_ID=your_client_id_here
GOOGLE_CLIENT_SECRET=your_client_secret_here
GOOGLE_REDIRECT_URL=http://localhost/auth/google/callback
```

**Important:** Replace `your_client_id_here` and `your_client_secret_here` with the actual values from Google Cloud Console.

If you're running on a different port (e.g., 8000), update the redirect URL accordingly:

```env
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

### Step 4: Clear Config Cache

After updating .env, run:

```bash
php artisan config:clear
```

## 🚀 How It Works

1. User clicks "Continue with Google" button on login page
2. User is redirected to Google's OAuth consent screen
3. After approval, Google redirects back to `/auth/google/callback`
4. The system finds or creates a user account with the Google email
5. User is automatically logged in
6. User is redirected to the dashboard

## 📝 Notes

-   Users who sign up with Google will have a randomly generated password
-   The `google_id` field stores the unique Google user ID
-   If a user already exists with the same email, their account will be linked with Google
-   Email addresses from Google are pre-verified

## 🔒 Security

-   Never commit your `.env` file or expose your Client Secret
-   Use HTTPS in production
-   Update authorized redirect URIs when deploying to production

## 🐛 Troubleshooting

**Error: "redirect_uri_mismatch"**

-   Make sure the redirect URI in Google Console exactly matches the one in your .env file

**Error: "Client ID not found"**

-   Double-check your GOOGLE_CLIENT_ID in .env
-   Run `php artisan config:clear`

**Error: "This app is blocked"**

-   Make sure your OAuth consent screen is properly configured
-   Add test users in Google Console if using External user type
