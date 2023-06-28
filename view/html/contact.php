<link rel="stylesheet" href="view/css/contact.css">
<title>Contacto</title>

<div class="contac-container">
  <h1>Contactos</h1>
  <div class="contact-us">
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam facere, debitis esse repellat autem aut ipsa alias mollitia perferendis natus voluptatibus incidunt velit cumque doloribus! Dolorem, ex. Non harum alias sed nesciunt velit atque a, laudantium, nulla quae rem commodi neque quas necessitatibus quaerat rerum, ab excepturi placeat perspiciatis dignissimos!</p>
      <div>
        <h4>Follow us:</h5>
        <ul>
            <li><i class="fa-brands fa-square-facebook"></i></li>
            <li><i class="fa-brands fa-square-twitter"></i></li>
            <li><i class="fa-brands fa-square-instagram"></i></li>
        </ul>
      </div>
  </div>
  
  <ul class="list-contacts">
      <li><i class="fa-regular fa-envelope"></i>info@example.com</li>
      <li><i class="fa-solid fa-phone"></i>000-000-000-00</li>
      <li><i class="fa-solid fa-location-dot"></i>Barranquilla - Atlántico #00-00</li>
  </ul>
</div>

<iframe id="location-map" class="location-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125331.46715983223!2d-74.83901635!3d10.992906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef42c5022d41139%3A0x7777c8d5cf47bec!2sBarranquilla%2C%20Atl%C3%A1ntico!5e0!3m2!1ses-419!2sco!4v1687562953828!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<div class="form-container">
    <h4>Ponte en contacto con nosotros</h1> 
    <p class="require-field">Requerido *</p>
    <form method="post">
      <input type="text" id="username" name="name" placeholder="Nombre">
      <input type="email" name="email" placeholder="Email *" required>
      <?php 
        $defaultMessage = '';
        if(isset($_POST["message_footer"])) {
          $defaultMessage = $_POST["message_footer"];
        }
      ?>
      <textarea name="message" placeholder="Mensaje *" required><?php echo $defaultMessage ?></textarea>
      <input type="submit" value="Enviar">
    </form>

    <?php
      $contact = FormsController::ctrContactMessage();
      if($contact == true) {
        echo "<script>
            if (window.history.replaceState) {
                window.history.replaceState(null,null,window.location.href);
            }
            alert('El mensaje se ha enviado exitosamente');
        </script>";
      }
    ?>
</div>