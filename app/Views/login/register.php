

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Register</title>
      <link rel="stylesheet" href="<?= base_url() ?>css_login/register.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Register Form</header>
            

               <!-- script sweetalert -->
               <script src="<?= base_url() ?>sweetalert/alert.js"></script>
               
<!--isi card register form-->
<form action="<?= base_url() ?>proses_register" method="post">
  <div class="field">
    <span class="fa fa-user"></span>
    <input type="text" name="username" required placeholder="Username">
  </div>
  <div class="field">
    <span class="fa fa-envelope"></span>
    <input type="text" name="email" required placeholder="Email">
  </div>
  <div class="field">
    <span class="fa fa-user-circle"></span>
    <input type="text" name="nama_lengkap" required placeholder="Nama Lengkap">
  </div>
  <div class="field">
    <span class="fa fa-map-marker"></span>
    <input type="text" name="alamat" required placeholder="Alamat">
  </div>
  <div class="field space">
    <span class="fa fa-key"></span>
    <input type="password" class="pass-key" name="password" required placeholder="Password">
    <span class="show">SHOW</span>
  </div>
  <div class="field">
    <input type="submit" Register>
  </div>
</form>
           
            
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
      <script>
		$(function() {
			<?php if (session()->has("INFO")) { ?>
				Swal.fire({
					icon: 'INFO',
					title: 'Berhasil',
					text: '<?= session("INFO") ?>'
				})
			<?php } ?>
		});
	</script>
   </body>
</html>