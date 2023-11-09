<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro">
    <style>
      :root {
        --primary-color: #fff8f0;
        --secondary-color: #92140c;
        --black: #1e1e24;
      }
      
      * {
        padding: 0;
        margin: 0;
      }
      body {
        font-family: 'Crimson Pro', serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        
      }
      .background {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        z-index: -1;
      }
      .background img {
        height: 100vh;
        width: 100vw;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        filter: blur(4px);
        border: none;
        position: absolute;
      }

      .form {
  background-color: var(--primary-color);
  display: block;
  margin: auto;
  padding: 2rem;
  max-width: 350px;
  border-radius: 0.5rem;
  border: 1px solid rgba(0, 0, 0, 0.1);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  position: relative;
  animation: professionalAnimation 1s ease-out;
}

@keyframes professionalAnimation {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
      .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: var(--black);
      }

      .input-container {
        position: relative;
      }

      .input-container input,
      .form button {
        outline: none;
        border: 1px solid #e5e7eb;
        margin: 8px 0;
      }

      .input-container input {
        background-color: var(--primary-color);
        padding: 1rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
      }

      .input-container span {
        display: grid;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        padding-left: 1rem;
        padding-right: 1rem;
        place-content: center;
      }

      .input-container span svg {
        color: #9ca3af;
        width: 1rem;
        height: 1rem;
      }

      .submit {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: var(--secondary-color);
        color: #ffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.5rem;
        text-transform: uppercase;
        cursor: pointer;
      }

      .signup-link {
        color: var(--black);
        font-size: 0.875rem;
        line-height: 1.25rem;
        text-align: center;
      }
      .error {
	color: #ff0000;
  background-color: #ffeaea;
  border: 1px solid #ff0000;
	padding: 5px;
	text-align: center;
	width: 20%;
	border-radius: 5px;;
	position: absolute;
  margin-top: -20%;
  animation: fade-in 0.5s, fade-out 0.5s 2.5s forwards;
  -webkit-animation: fade-in 2s, fade-out 1.5s 2.5s forwards;
  z-index: 9999;
 }
 @keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @-webkit-keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @-webkit-keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
      }
    </style>
  </head>
  <body>
    <div class="background">
      <img src="./adminloginbg.jpg" alt="">
    </div>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    <form class="form" action="process-login-admin.php" method="POST">
      <p class="form-title">Sign in to your account</p>
      <div class="input-container">
        <input placeholder="Enter username" type="text" name="username" autocomplete="off">
        <span>
          <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
          </svg>
        </span>
      </div>
      <div class="input-container">
        <input placeholder="Enter password" type="password" name="password" autocomplete="off">
        <span>
          <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
          </svg>
        </span>
      </div>
      <button class="submit" type="submit">
        Sign in
      </button>

      <p class="signup-link">
        No account? Contact Admin
      </p>
    </form>
  </body>
</html>
