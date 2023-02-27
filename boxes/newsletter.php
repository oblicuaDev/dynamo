<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">BOLETÍN DE NOVEDADES</h2>
  <h3>Suscríbete.</h3>
  <p>
    Recibe en tu correo electrónico las novedades de Dynamo: estrenos, noticias,
    vacantes y más.
  </p>
  <form action="/set/senForm.php" method="POST" id="newsletter">
    <hr />
    <span>
      <label for="name"> Nombres* </label>
      <input type="text" id="name" name="name" />
    </span>
    <span>
      <label for="name"> Apellidos* </label>
      <input type="text" id="lastname" name="lastname" />
    </span>
    <span>
      <label for="email"> Correo electrónico* </label>
      <input type="text" id="email" name="email" />
    </span>
    <hr />
    <div class="politics_checkbox full">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        >He leído y acepto la política de tratamiento de datos
        personales.</label
      >
    </div>
    <div class="politics_checkbox full">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        >Estoy interesado en recibir información sobre vacantes
        laborales.</label
      >
    </div>
    <input type="hidden" name="type_for" id="type_for" value="6">
    <button class="btn orange-bg full" type="submit">Enviar información</button>
  </form>
</div>

<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "newsletter",
  {
    name: { required: true },
    lastname: { required: true },
    email: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    email: { required: "Campo obligatorio*" },
  }
);
</script>

