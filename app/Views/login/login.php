<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>LOGIN</title>
      <link rel="stylesheet" href="<?= base_url() ?>css_login/login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Login Form</header>

<!--isi login form-->
            <form action="proses_login" method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="email" required placeholder="Email or Phone">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key" name="password" required placeholder="Password">
                  <span class="show">SHOW</span>
               </div>
               <div class="field">
                  <input type="submit" value="LOGIN">
               </div>
            </form>

 <!--bagian bawah card login form-->
           
            <div class="signup">
             Belum punya akun?
               <a href="register">Signup Now</a>
            </div>
         </div>
      </div>

      <script>
         const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
          }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
          }
         });
      </script>

<script src="<?= base_url() ?>jquery/jquery.slim.min.js"></script>

<script src="<?= base_url() ?>popper/popper.js"></script>
<script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>sweetalert/alert.js"></script>
<script>
  $(function() {
     <?php if (session()->has("success")) { ?>
        Swal.fire({
           icon: 'success',
           title: 'Berhasil Login',
           text: '<?= session("success") ?>'
        })
     <?php } ?>
  });
</script>
<script>
  $(function() {
     <?php if (session()->has("info")) { ?>
        Swal.fire({
           icon: 'info',
           title: 'Info',
           text: '<?= session("info") ?>'
        })
     <?php } ?>
  });
</script>
   </body>
</html>