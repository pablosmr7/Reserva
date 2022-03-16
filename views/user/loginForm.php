<?php

if (isset($data['errorMsg'])) {
    echo "<p style='color:red'>" . $data['errorMsg'] . "</p>";
}
if (isset($data['infoMsg'])) {
    echo "<p style='color:blue'>" . $data['infoMsg'] . "</p>";
}
/*
echo "<form action='index.php'>
        Email:<input type='text' name='username'><br>
        Contraseña:<input type='password' name='password'><br>
        <input type='hidden' name='controller' value='UserController'>
        <input type='hidden' name='action' value='processLoginForm'>
        <input type='submit'>
      </form>";*/

echo"<section class='vh-100 gradient-custom'>
<div class='container py-0.5 h-100'>
  <div class='row d-flex justify-content-center align-items-center h-100'>
    <div class='col-12 col-md-8 col-lg-6 col-xl-5'>
      <div class='card bg-dark text-white' style='border-radius: 1rem;'>
        <div class='card-body p-5 text-center'>

          <div class='mb-md-5 mt-md-4 pb-5'>

            <form action='index.php'>

            <h2 class='fw-bold mb-2 text-uppercase'>Inicia Sesión</h2>
            </br>

            <div class='form-outline form-white mb-4'>
              <input type='text' id='typeEmailX' name='username' class='form-control form-control-lg' />
              <label class='form-label' for='typeEmailX'>Email</label>
            </div>

            <div class='form-outline form-white mb-4'>
              <input type='password' id='typePasswordX' name='password' class='form-control form-control-lg' />
              <label class='form-label' for='typePasswordX'>Password</label>
            </div>

            <p class='small mb-5 pb-lg-2'><a class='text-white-50' href='#!'>¿Olvidaste tu contraseña?</a></p>

            <input type='hidden' name='controller' value='UserController'>
            <input type='hidden' name='action' value='processLoginForm'>
            <button class='btn btn-outline-light btn-lg px-5' type='submit'>Login</button>


          </div>

          <div>
            <p class='mb-0'>Contactar Administrador <a href='#!' class='text-white-50 fw-bold'>Sign Up</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
</form>
</section>";