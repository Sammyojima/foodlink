const fs = require('fs');
const path = require('path');

// Create dist directory
if (!fs.existsSync('dist')) {
  fs.mkdirSync('dist');
}

// Copy static files
const staticFiles = [
  'index.html',
  'login.html', 
  'register.html',
  'dashboard.html',
  'donate.html',
  'view_donations.html',
  'checkout.html',
  'css/style.css',
  'js/app.js'
];

staticFiles.forEach(file => {
  const srcPath = path.join(__dirname, file);
  const destPath = path.join(__dirname, 'dist', file);
  
  // Create directory if it doesn't exist
  const destDir = path.dirname(destPath);
  if (!fs.existsSync(destDir)) {
    fs.mkdirSync(destDir, { recursive: true });
  }
  
  if (fs.existsSync(srcPath)) {
    fs.copyFileSync(srcPath, destPath);
    console.log(`Copied ${file}`);
  }
});

// Copy bolt demo files
const boltFiles = [
  'bolt/index.php',
  'bolt/donations.php', 
  'bolt/payments.php',
  'bolt/db.php',
  'bolt/pay.php',
  'bolt/callback.php',
  'bolt/bolt/db.php'
];

boltFiles.forEach(file => {
  const srcPath = path.join(__dirname, file);
  const destPath = path.join(__dirname, 'dist', file);
  
  const destDir = path.dirname(destPath);
  if (!fs.existsSync(destDir)) {
    fs.mkdirSync(destDir, { recursive: true });
  }
  
  if (fs.existsSync(srcPath)) {
    fs.copyFileSync(srcPath, destPath);
    console.log(`Copied ${file}`);
  }
});

console.log('Build completed successfully!');