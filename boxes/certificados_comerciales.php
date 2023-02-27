<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">CERTIFICADO COMERCIAL</h2>
  <h3>Solicítalo aquí.</h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Este formulario solo es para asuntos relacionados con certificados
        laborales por proyecto. No es para hacer consultas de comunicación o
        sobre producciones.</strong
      >
    </p>
    <p>
      Si tienes dudas
      <a href=""> contáctanos </a>
      o visita nuestra sección de
      <a href=""> preguntas frecuentes. </a>
    </p>
  </div>
  <form action="/s/senForm/" method="POST" id="certificados_comerciales">
    <hr />
    <p>
      La respuesta a esta solicitud puede tomar hasta tres (3) días hábiles.
    </p>
    <div class="flex">
      <span>
        <label for="name"> Nombre / Razón social* </label>
        <input type="text" id="name" name="name" />
      </span>
      <span>
        <label for="cc"> Cédula / NIT* </label>
        <input type="text" id="cc" name="cc" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="email"> Correo electrónico* </label>
        <input type="text" id="email" name="email" />
      </span>
      <span>
        <label for="phone"> Teléfono de contacto* </label>
        <input type="text" id="phone" name="phone" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="project"> Proyecto en el que trabajó* </label>
        <input type="text" id="project" name="project" />
      </span>
      <span>
        <label for="honorarios"> Servicio prestado* </label>
        <input type="text" id="honorarios" name="honorarios" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="initial"> Periodo* </label>
        <input type="text" id="initial" name="initial" />
      </span>
      <span>
        <label for="final"> Ciudad* </label>
        <input type="text" id="final" name="final" />
      </span>
    </div>
    <div class="flex">
      <span> </span>
      <span>
        <label for="doc"> Adjuntar formato a diligenciar </label>
        <input type="file" id="file" name="file" data-after="" />
        <div class="recomm">
          <small class="OpenSans">(Si se requiere)</small>
          <label for="file"> ADJUNTAR </label>
        </div>
      </span>
    </div>
    <hr />
    <div class="politics_checkbox">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        >Acepto los
        <a href="" target="_blank">términos y condiciones.</a></label
      >
    </div>
    <input type="hidden" name="type_for" id="type_for" value="1">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>
$("#file").on("change", function () {
  let val = JSON.stringify(this.value).split("\\");
  $(this).attr("data-after", val[val.length - 1]); //anything is the 'content' value
});
grecaptcha.enterprise.ready(function() {
    grecaptcha.enterprise.execute('6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt', {action: 'submit'}).then(function(token) {
      validateForms(
        "certificados_comerciales",
        {
          name: { required: true },
          lastname: { required: true },
          cc: { required: true },
          proyecto: { required: true },
          cargo: { required: true },
          honorarios: { required: true },
          initial: { required: true },
          final: { required: true },
        },
        {
          name: { required: "Campo obligatorio*" },
          lastname: { required: "Campo obligatorio*" },
          cc: { required: "Campo obligatorio*" },
          proyecto: { required: "Campo obligatorio*" },
          cargo: { required: "Campo obligatorio*" },
          honorarios: { required: "Campo obligatorio*" },
          initial: { required: "Campo obligatorio*" },
          final: { required: "Campo obligatorio*" },
        }
      );
    });
});


</script>