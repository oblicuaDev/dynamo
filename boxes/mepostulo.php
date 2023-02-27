<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">ME POSTULO PARA ESTE CARGO</h2>
  <h3><?=$_GET["vacanteName"]?></h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Usa este formulario únicamente para postularte a un cargo.</strong
      >
    </p>
    <p>
      Si tienes dudas
      <a href=""> contáctanos </a>
      o visita nuestra sección de
      <a href=""> preguntas frecuentes. </a>
    </p>
  </div>
  <form action="/set/senForm.php" method="POST" id="mepostulo">
    <hr />
    <p>
      La revisión y el estudio de tu postulación puede tardar unos días. Si nos
      gusta tu perfil, nos pondremos en contacto.
    </p>
    <div class="flex">
      <span>
        <label for="name"> Nombres* </label>
        <input type="text" id="name" name="name" />
      </span>
      <span>
        <label for="lastname"> Apellidos* </label>
        <input type="text" id="lastname" name="lastname" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="type">Tipo de documento*</label>
        <div class="c-select custom-select">
          <select name="plan" id="plan">
            <option value="0">Selecciona una opción</option>
            <option value="cc">Cédula de ciudadania</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
      <span>
        <label for="cc">Número de documento*</label>
        <input type="text" id="cc" name="cc" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="email"> Correo electrónico* </label>
        <input type="text" id="email" name="email" />
      </span>
      <span>
        <label for="phone"> Teléfono* </label>
        <input type="text" id="phone" name="phone" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="address"> Dirección* </label>
        <input type="text" id="address" name="address" />
      </span>
      <span>
        <label for="city"> Ciudad* </label>
        <input type="text" id="city" name="city" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="country"> País* </label>
        <input type="text" id="country" name="country" />
      </span>
      <span>
        <label for="file"> Hoja de vida* </label>
        <input type="file" id="file" name="file" />
        <div class="recomm">
          <small class="OpenSans">Un único documento en formato PDF</small>
          <label for="file"> ADJUNTAR </label>
        </div>
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="linkedin"> LinkedIn (enlace)* </label>
        <input type="text" id="linkedin" name="linkedin" />
      </span>
      <span>
        <label for="portafolio"> Portafolio* </label>
        <input type="file" id="portafolio" name="portafolio" />
        <div class="recomm">
          <small class="OpenSans">Un único documento en formato PDF</small>
          <label for="portafolio"> ADJUNTAR </label>
        </div>
      </span>
    </div>
    <div class="flex">
      <span> </span>
      <span>
        <label for="why"> ¿Por qué te postulas a esta vacante? </label>
        <textarea name="why" id="why" cols="30" rows="10"></textarea>
      </span>
    </div>
    <hr />
    <div class="checkbox">
      <div class="politics_checkbox">
        <input type="checkbox" name="politics" id="politics" checked />
        <span class="politics_checkbox_mark"></span>
        <label for="politics"
          >Acepto los
          <a href="" target="_blank">términos y condiciones.</a></label
        >
      </div>
      <div class="politics_checkbox">
        <input type="checkbox" name="politics" id="politics" checked />
        <span class="politics_checkbox_mark"></span>
        <label for="politics"
          >Autorizo a DYNAMO PRODUCCIONES S.A. a realizar el tratamiento y
          manejo de mis datos personales conforme a su
          <a href="">Política de tratamiento de datos personales.</a>
        </label>
      </div>
    </div>

    <input type="hidden" name="type_for" id="type_for" value="5">
    <input type="hidden" name="type_parent" id="type_parent" value="<?=$_GET["vacante"]?>">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "mepostulo",
  {
    name: { required: true },
    lastname: { required: true },
    plan: { required: true },
    cc: { required: true },
    email: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
    country: { required: true },
    linkedin: { required: true },
    why: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    plan: { required: "Campo obligatorio*" },
    cc: { required: "Campo obligatorio*" },
    email: { required: "Campo obligatorio*" },
    phone: { required: "Campo obligatorio*" },
    address: { required: "Campo obligatorio*" },
    city: { required: "Campo obligatorio*" },
    country: { required: "Campo obligatorio*" },
    linkedin: { required: "Campo obligatorio*" },
    why: { required: "Campo obligatorio*" },
  }
);
</script>

