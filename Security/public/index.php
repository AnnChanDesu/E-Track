<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Tracking System - Auth</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '<?php echo COLOR_PRIMARY; ?>',
            primaryLight: '<?php echo COLOR_PRIMARY_LIGHT; ?>',
            primaryDark: '<?php echo COLOR_PRIMARY_DARK; ?>',
          }
        }
      }
    }
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  <style>
    .card-shadow{ box-shadow: 0 10px 30px rgba(0,0,0,.1);} 
    .gradient-header{ background: linear-gradient(180deg, <?php echo COLOR_PRIMARY; ?>, <?php echo COLOR_PRIMARY_LIGHT; ?>);} 
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[<?php echo COLOR_PRIMARY_LIGHT; ?>] bg-opacity-40">
  <div class="w-full max-w-3xl bg-white/95 rounded-2xl card-shadow">
    <div class="gradient-header text-white rounded-t-2xl p-6 text-center">
      <h1 class="text-3xl font-extrabold">Document Tracking System</h1>
    </div>
    <div class="p-6">
      <div class="flex gap-3 justify-center mb-6">
        <button id="tab-login" class="px-5 py-2 rounded-lg border text-white bg-[<?php echo COLOR_PRIMARY; ?>] border-[<?php echo COLOR_PRIMARY; ?>]">Login</button>
        <button id="tab-signup" class="px-5 py-2 rounded-lg border text-[<?php echo COLOR_PRIMARY; ?>] border-[<?php echo COLOR_PRIMARY; ?>]">Sign Up</button>
      </div>

      <div id="login-panel">
        <h2 class="text-2xl font-semibold text-center mb-6">Login to Your Account</h2>
        <form id="login-form" class="space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-user text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Username</label>
            <input name="username" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[<?php echo COLOR_PRIMARY; ?>]" />
          </div>
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-lock text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Password</label>
            <div class="relative">
              <input type="password" id="login-password" name="password" class="w-full border rounded-lg p-3 pr-10 focus:outline-none focus:ring-2 focus:ring-[<?php echo COLOR_PRIMARY; ?>]" />
              <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500" onclick="toggleVisibility('login-password', this)"><i class="fa-regular fa-eye"></i></button>
            </div>
          </div>
          <div class="flex items-center justify-between">
            <label class="inline-flex items-center gap-2 text-sm"><input type="checkbox" name="remember" class="h-4 w-4"> Remember me</label>
            <button id="forgot-btn" type="button" class="text-sm text-[<?php echo COLOR_PRIMARY_DARK; ?>]">Forgot Password?</button>
          </div>
          <button class="w-full bg-[<?php echo COLOR_PRIMARY; ?>] text-white font-semibold py-3 rounded-lg hover:bg-[<?php echo COLOR_PRIMARY_DARK; ?>]">Login</button>
        </form>
        <p id="login-msg" class="mt-3 text-center text-sm"></p>
      </div>

      <div id="signup-panel" class="hidden">
        <h2 class="text-2xl font-semibold text-center mb-6">Create Your Account</h2>
        <form id="signup-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-user text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> First Name</label>
            <input name="first_name" value="" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[<?php echo COLOR_PRIMARY; ?>]">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Last Name</label>
            <input name="last_name" value="" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[<?php echo COLOR_PRIMARY; ?>]">
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-location-dot text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Address</label>
            <textarea name="address" class="w-full border rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-[<?php echo COLOR_PRIMARY; ?>]"></textarea>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-id-card text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> ID Number</label>
            <input name="id_number" class="w-full border rounded-lg p-3">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-building text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Department</label>
            <input name="department" class="w-full border rounded-lg p-3">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-calendar text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Year</label>
            <select name="year" class="w-full border rounded-lg p-3">
              <option value="">Select Year</option>
              <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
            </select>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-envelope text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Email</label>
            <div class="flex gap-2">
              <input name="email" class="flex-1 border rounded-lg p-3" placeholder="name@example.com">
              <button id="send-otp" type="button" class="px-4 rounded-lg border text-[<?php echo COLOR_PRIMARY; ?>] border-[<?php echo COLOR_PRIMARY; ?>] hover:bg-[<?php echo COLOR_PRIMARY_LIGHT; ?>]">Send Code</button>
            </div>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-user-gear text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Username</label>
            <input name="username" id="username" class="w-full border rounded-lg p-3" minlength="6" maxlength="12" pattern="^[A-Za-z]{4}[A-Za-z0-9]{2,8}$" title="6-12 chars, start with 4 letters, remaining letters or numbers" disabled>
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1"><i class="fa-solid fa-lock text-[<?php echo COLOR_PRIMARY_DARK; ?>]"></i> Password (8-12 characters)</label>
            <div class="relative">
              <input type="password" id="signup-password" name="password" class="w-full border rounded-lg p-3 pr-10" minlength="8" maxlength="12" pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,12}" title="8-12 chars with letters, numbers and special character" disabled>
              <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500" onclick="toggleVisibility('signup-password', this)"><i class="fa-regular fa-eye"></i></button>
            </div>
            <p class="text-xs text-gray-500 mt-1">Must include letters, numbers, and special characters</p>
          </div>
          <div class="md:col-span-2">
            <button id="signup-submit" disabled class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed">Sign Up</button>
          </div>
        </form>
        <p id="signup-msg" class="mt-3 text-center text-sm"></p>
      </div>
    </div>
  </div>

  <!-- OTP Modal -->
  <div id="otp-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center">
    <div class="bg-white w-full max-w-xl rounded-xl overflow-hidden">
      <div class="gradient-header p-6 text-center text-white">
        <h3 class="text-2xl font-bold">Welcome to Document Tracking System</h3>
        <p class="opacity-90">Email Verification Required</p>
      </div>
      <div class="p-6">
        <h4 class="text-xl font-semibold text-purple-900 mb-2">Verify Your Email Address</h4>
        <p class="text-gray-600 mb-4">Please use the following 6-digit code to verify your email:</p>
        <input id="otp-input" maxlength="6" class="w-full text-center text-3xl font-extrabold text-[<?php echo COLOR_PRIMARY_DARK; ?>] border-2 border-[<?php echo COLOR_PRIMARY; ?>] rounded-xl p-6 tracking-widest" />
        <div class="mt-4 flex justify-between">
          <button id="otp-resend" class="px-4 py-2 rounded-lg border text-[<?php echo COLOR_PRIMARY; ?>] border-[<?php echo COLOR_PRIMARY; ?>]">Resend Code</button>
          <button id="otp-submit" class="px-5 py-2 rounded-lg bg-[<?php echo COLOR_PRIMARY; ?>] text-white">Verify</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Reset Password Modal -->
  <div id="reset-modal" class="fixed inset-0 bg-black/40 hidden items-center justify-center">
    <div class="bg-white w-full max-w-xl rounded-xl overflow-hidden">
      <div class="gradient-header p-6 text-center text-white">
        <h3 class="text-2xl font-bold">Password Reset</h3>
      </div>
      <div class="p-6 space-y-3">
        <p class="text-sm text-gray-600">Enter your registered email to receive a reset code.</p>
        <input id="reset-email" class="w-full border rounded-lg p-3" placeholder="name@example.com" />
        <button id="reset-send" class="px-4 py-2 rounded-lg bg-[<?php echo COLOR_PRIMARY; ?>] text-white">Send Code</button>
        <div id="reset-step2" class="hidden space-y-3">
          <input id="reset-code" maxlength="6" class="w-full border rounded-lg p-3" placeholder="6-digit code" />
          <input id="reset-pass" type="password" class="w-full border rounded-lg p-3" placeholder="New password" />
          <input id="reset-pass2" type="password" class="w-full border rounded-lg p-3" placeholder="Confirm password" />
          <button id="reset-confirm" class="px-4 py-2 rounded-lg bg-emerald-600 text-white">Reset Password</button>
        </div>
        <p id="reset-msg" class="text-sm"></p>
      </div>
    </div>
  </div>

  <script>
    let emailVerified = false;
    const loginPanel = document.getElementById('login-panel');
    const signupPanel = document.getElementById('signup-panel');
    const tabLogin = document.getElementById('tab-login');
    const tabSignup = document.getElementById('tab-signup');
    tabLogin.addEventListener('click', () => { loginPanel.classList.remove('hidden'); signupPanel.classList.add('hidden'); tabLogin.classList.add('text-white','bg-[<?php echo COLOR_PRIMARY; ?>]'); tabSignup.classList.remove('text-white','bg-[<?php echo COLOR_PRIMARY; ?>]'); });
    tabSignup.addEventListener('click', () => { loginPanel.classList.add('hidden'); signupPanel.classList.remove('hidden'); tabSignup.classList.add('text-white','bg-[<?php echo COLOR_PRIMARY; ?>]'); tabLogin.classList.remove('text-white','bg-[<?php echo COLOR_PRIMARY; ?>]'); });

    function toggleVisibility(id, btn){
      const input = document.getElementById(id);
      if(input.type === 'password'){ input.type = 'text'; btn.innerHTML = '<i class="fa-regular fa-eye-slash"></i>'; }
      else { input.type = 'password'; btn.innerHTML = '<i class="fa-regular fa-eye"></i>'; }
    }

    document.getElementById('send-otp').addEventListener('click', async () => {
      const form = document.getElementById('signup-form');
      const email = new FormData(form).get('email');
      if(!email){ alert('Enter email first'); return; }
      const res = await fetch('../server/send_otp.php', { method: 'POST', body: new URLSearchParams({ email }) });
      const data = await res.json();
      const msg = document.getElementById('signup-msg');
      if(data.success){ msg.textContent = 'OTP sent to your email'; msg.className = 'mt-3 text-center text-sm text-green-600'; document.getElementById('otp-modal').classList.remove('hidden'); document.getElementById('otp-modal').classList.add('flex'); }
      else { msg.textContent = data.error || 'Failed to send OTP'; msg.className = 'mt-3 text-center text-sm text-red-600'; }
    });

    document.getElementById('otp-submit').addEventListener('click', async () => {
      const email = new FormData(document.getElementById('signup-form')).get('email');
      const code = document.getElementById('otp-input').value;
      const res = await fetch('../server/verify_otp.php', { method: 'POST', body: new URLSearchParams({ email, code })});
      const data = await res.json();
      const msg = document.getElementById('signup-msg');
      if(data.success){
        emailVerified = true;
        msg.textContent = 'Email verified. Complete your username and password to finish.';
        msg.className = 'mt-3 text-center text-sm text-green-600';
        document.getElementById('otp-modal').classList.add('hidden');
        // Lock all fields except username and password
        const form = document.getElementById('signup-form');
        const lockNames = ['first_name','last_name','address','id_number','department','year','email'];
        lockNames.forEach(n=>{
          const el = form.querySelector(`[name="${n}"]`);
          if(!el) return;
          // For select elements, keep a hidden mirror so value submits
          if(el.tagName === 'SELECT'){
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = el.name;
            hidden.value = el.value;
            el.after(hidden);
            el.setAttribute('disabled','disabled');
            el.setAttribute('data-locked','1');
            el.classList.add('bg-gray-100','opacity-70','pointer-events-none');
          } else {
            el.setAttribute('readonly','readonly');
            el.classList.add('bg-gray-100','opacity-70','pointer-events-none');
          }
        });
        document.getElementById('username').removeAttribute('disabled');
        document.getElementById('signup-password').removeAttribute('disabled');
        document.getElementById('signup-submit').removeAttribute('disabled');
      }
      else { msg.textContent = data.error || 'Invalid code'; msg.className = 'mt-3 text-center text-sm text-red-600'; }
    });
    document.getElementById('otp-resend').addEventListener('click', async () => {
      const email = new FormData(document.getElementById('signup-form')).get('email');
      if(!email){ return; }
      const res = await fetch('../server/send_otp.php', { method: 'POST', body: new URLSearchParams({ email }) });
      const data = await res.json();
      const msg = document.getElementById('signup-msg');
      if(data.success){ msg.textContent = 'OTP re-sent to your email'; msg.className = 'mt-3 text-center text-sm text-green-600'; }
      else { msg.textContent = data.error || 'Failed to resend'; msg.className = 'mt-3 text-center text-sm text-red-600'; }
    });

    document.getElementById('signup-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      if(!emailVerified){
        const msg = document.getElementById('signup-msg');
        msg.textContent = 'Please verify your email first.';
        msg.className = 'mt-3 text-center text-sm text-red-600';
        return;
      }
      const form = new FormData(e.target);
      const res = await fetch('../server/register.php', { method: 'POST', body: new URLSearchParams([...form]) });
      const data = await res.json();
      const msg = document.getElementById('signup-msg');
      if(data.success){ msg.textContent = 'Registration successful. You can login now.'; msg.className = 'mt-3 text-center text-sm text-green-600'; tabLogin.click(); }
      else { msg.textContent = data.error || 'Registration failed'; msg.className = 'mt-3 text-center text-sm text-red-600'; }
    });

    document.getElementById('login-form').addEventListener('submit', async (e) => {
      e.preventDefault();
      const form = new FormData(e.target);
      // Pass remember me value
      form.set('remember', e.target.querySelector('input[name="remember"]').checked ? 'on' : '');
      const res = await fetch('../server/login.php', { method: 'POST', body: new URLSearchParams([...form]) });
      const data = await res.json();
      const msg = document.getElementById('login-msg');
      if(data.success){ msg.textContent = 'Login success.'; msg.className = 'mt-3 text-center text-sm text-green-600'; }
      else { msg.textContent = data.error || 'Invalid credentials'; msg.className = 'mt-3 text-center text-sm text-red-600'; }
    });

    // Forgot password flow
    document.getElementById('forgot-btn').addEventListener('click', () => {
      document.getElementById('reset-modal').classList.remove('hidden');
      document.getElementById('reset-modal').classList.add('flex');
    });
    document.getElementById('reset-send').addEventListener('click', async () => {
      const email = document.getElementById('reset-email').value.trim();
      if(!email){ return; }
      const res = await fetch('../server/send_reset_otp.php', { method: 'POST', body: new URLSearchParams({ email })});
      const data = await res.json();
      const msg = document.getElementById('reset-msg');
      if(data.success){
        msg.textContent = 'Code sent. Check your email.'; msg.className='text-green-600 text-sm';
        document.getElementById('reset-step2').classList.remove('hidden');
      } else { msg.textContent = data.error || 'Failed to send'; msg.className='text-red-600 text-sm'; }
    });
    document.getElementById('reset-confirm').addEventListener('click', async () => {
      const email = document.getElementById('reset-email').value.trim();
      const code = document.getElementById('reset-code').value.trim();
      const new_password = document.getElementById('reset-pass').value;
      const confirm_password = document.getElementById('reset-pass2').value;
      const res = await fetch('../server/reset_password.php', { method: 'POST', body: new URLSearchParams({ email, code, new_password, confirm_password })});
      const data = await res.json();
      const msg = document.getElementById('reset-msg');
      if(data.success){ msg.textContent = 'Password updated. You can login now.'; msg.className='text-green-600 text-sm'; setTimeout(()=>{ document.getElementById('reset-modal').classList.add('hidden'); }, 1200); }
      else { msg.textContent = data.error || 'Failed to reset'; msg.className='text-red-600 text-sm'; }
    });
  </script>
</body>
</html>


